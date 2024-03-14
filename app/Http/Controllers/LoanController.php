<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Loan;
use App\Models\Profile;
use App\Models\Staff;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManagerStatic as Image;

class LoanController extends Controller
{
    public function verifyView()
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        if ($profile) {
            return redirect('/')->with('error', 'Đã tồn tại khoản vay');
        }

        return view('verify');
    }

    public function index()
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        $loan = Loan::query()->where('user_id', backpack_user()->id)->where('valid', 1)->first();

        if ($profile && $loan) {
            return redirect('/')->with('error', 'Đã tồn tại khoản vay');
        }

        return view('vay');
    }

    public function store(Request $request)
    {
        Loan::query()->where('user_id', backpack_user()->id)->delete();

        $this->validate($request, [
            'amount' => 'required|numeric|min:20000000|max:1000000000',
            'months' => 'required|numeric|min:6|max:60',
        ]);

        $loan = Loan::query()->create([
            'amount' => $request->amount,
            'months' => $request->months,
            'user_id' => backpack_user()->id,
            'valid' => 0
        ]);

        $existContact = DB::table('user_staff')->where('user_id',backpack_user()->id)->first();

        if (! $existContact) {
            $staff = Staff::query()->orderBy('customer_count', 'ASC')->first();

            DB::table('user_staff')->insert([
                'user_id' => $loan['user_id'],
                'staff_id' => $staff->id
            ]);

            $staff->update([
                'customer_count' => $staff['customer_count'] += 1
            ]);

            Loan::query()->where('user_id', backpack_user()->id)->update([
                'staff_id' => $staff['id']
            ]);
        }

        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        if (!$profile) {
            return redirect()->to('verify');
        }

        return redirect('/confirm');
    }

    public function verify(Request $request)
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        if ($profile) {
            return redirect('/')->with('error', 'Đã tồn tại khoản vay');
        }

        $this->validate($request, [
            'name' => 'required',
            'uuid' => 'required',
            'birthday' => 'nullable',
            'gender' => 'nullable',
            'job' => 'required',
            'salary' => 'required',
            'in_order_to' => 'required',
            'address' => 'required',
            'alt_phone' => 'nullable',
            'alt_relation' => 'nullable',
            'bank_account' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
            'front-card' => 'required',
            'back-card' => 'required',
            'verify-photo' => 'required',
        ]);

        $files = $request->file();

        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        if ($profile) {
            $profile->update([
                'name' => $request->name,
                'uuid' => $request->uuid,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'job' => $request->job,
                'salary' => $request->salary,
                'in_order_to' => $request->in_order_to,
                'address' => $request->address,
                'alt_phone' => $request->alt_phone,
                'alt_relation' => $request->alt_relation,
                'bank_account' => $request->bank_account,
                'account_name' => $request->account_name,
                'bank_name' => $request->bank_name,
            ]);
        } else {
            $profile = Profile::query()->create([
                'user_id' => backpack_user()->id,
                'uuid' => $request->uuid,
                'name' => $request->name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'job' => $request->job,
                'salary' => $request->salary,
                'in_order_to' => $request->in_order_to,
                'address' => $request->address,
                'alt_phone' => $request->alt_phone,
                'alt_relation' => $request->alt_relation,
                'bank_account' => $request->bank_account,
                'account_name' => $request->account_name,
                'bank_name' => $request->bank_name,
            ]);
        }

        $profile->update([
            'front-card' => $files['front-card']->store('profile'),
            'back-card' => $files['back-card']->store('profile'),
            'verify-photo' => $files['verify-photo']->store('profile'),
        ]);

        Wallet::query()->updateOrCreate([
            'user_id' => backpack_user()->id,
        ], [
            'user_id' => backpack_user()->id,
            'account_bank' => $request->bank_account,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
            'amount' => 0
        ]);

        $loan = Loan::query()->where('user_id', backpack_user()->id)->where('valid', 0)->first();

        if ($loan) {
            return redirect()->to('/confirm');
        }

        return redirect()->to('/')->with('success', 'Thành công');
    }

    public function confirmView()
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->firstOrFail();

        $loan = Loan::query()->where('valid', 0)->where('user_id', backpack_user()->id)->firstOrFail();

        $contract = Config::query()->where('key', 'contract')->firstOrFail();

        $value = $contract->getAttributeValue('value');

        $this->mapVariable($value, '$name', $profile['name']);
        $this->mapVariable($value, '$cmnd', $profile['uuid']);
        $this->mapVariable($value, '$amount', number_format($loan['amount']) . ' ');
        $this->mapVariable($value, '$months', $loan['months']);
        $this->mapVariable($value, '$month', $loan['months']);
        $this->mapVariable($value, '$code', $loan->getTimestampAttribute());
        $this->mapVariable($value, '$datetime', Carbon::parse($loan->created_at)->isoFormat('hh:mm:ss DD/MM/YYYY'));

        $contract->setAttribute('value', $value);

        return view('confirm', [
            'contract' => $contract
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function confirm(Request $request)
    {
        $this->validate($request, [
            'signature' => 'required'
        ]);

        $loan = Loan::query()->where('user_id', backpack_user()->id)->first();

        if (!$loan) {
            return redirect()->to('/')->with('error', 'Có lỗi xảy ra');
        }
        /**
         * @var Loan $loan
         * @var Profile $profile
         */
        $profile = $loan->Profile();

        $signature = $request->get('signature');

        $image = saveImgBase64($signature, 'signatures');

        $loan->update([
            'signature' => $image,
            'valid' => 1
        ]);

        Wallet::query()->updateOrCreate([
            'user_id' => $loan['user_id']
        ], [
            'user_id' => $loan['user_id'],
            'amount' => 0,
            'account_bank' => $profile['bank_account'],
            'account_name' => $profile['account_name'],
            'bank_name' => $profile['bank_name']
        ]);


        if (DB::table('user_staff')->where('user_id', $loan['user_id'])->exists()) {
            return response()->json(['path' => $image]);
        }

        return response()->json(['path' => $image]);
    }

    public function calculateLoan(
        $amount,
        $months
    ): RedirectResponse
    {
        $loanAmount = $amount; // Số tiền vay
        $monthlyInterestRate = 0.01; // Lãi suất hàng tháng
        $numberOfMonths = $months; // Số tháng

        $payments = $this->calculatePayments($loanAmount, $monthlyInterestRate, $numberOfMonths);

        return redirect()->back()->with('data', [
            'amount' => $amount,
            'months' => $months,
            'payments' => $payments
        ]);
    }

    /**
     * @param $loanAmount
     * @param $monthlyInterestRate
     * @param $numberOfMonths
     * @return array
     */
    private function calculatePayments($originalLoan, $rate, $months): array
    {
        $originByMonth = $originalLoan / $months;

        $month = 1;

        $currentDate = now();

        $payments = [];

        while ($month <= $months) {
            $total = $originByMonth + ($originalLoan * $rate);
            $payments[] = [
                'date' => $currentDate->copy()->addMonths($month)->format('Y-m-d'),
                'amount' => $total
            ];

            $originalLoan = $originalLoan - $originByMonth;

            $month += 1;
        }

        return $payments;
    }

    private function mapVariable(&$value, string $variableName, $variableData)
    {
        $variableData = "<b class='text-black'>" . $variableData . "</b>";

        $value = str_replace($variableName, $variableData, $value);
    }
}
