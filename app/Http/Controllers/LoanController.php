<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Profile;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function verifyView()
    {
        return view('verify');
    }

    public function index()
    {
        return view('vay');
    }

    public function store(Request $request)
    {
        Loan::query()->where('user_id', backpack_user()->id)->delete();

        $this->validate($request, [
            'amount' => 'required|numeric|min:20000000|max:1000000000',
            'months' => 'required|numeric|min:6|max:60',
        ]);

        Loan::query()->create([
            'amount' => $request->amount,
            'months' => $request->months,
            'user_id' => backpack_user()->id,
            'valid' => 0
        ]);

        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        if (!$profile) {
            return redirect()->to('verify');
        }

        Loan::query()->where('user_id', backpack_user()->id)->update([
            'valid' => 1
        ]);

        return redirect()->to('/')->with('success', 'Đăng ký vay thành công');
    }

    public function verify(Request $request)
    {
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
        ],[
            'user_id' => backpack_user()->id,
            'account_bank' => $request->bank_account,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
            'amount' => 0
        ]);

        Loan::query()->where('user_id', backpack_user()->id)->update([
            'valid' => 1
        ]);

        return redirect()->to('/')->with('success', 'Thành công');
    }

    public function calculateLoan(
        $amount,
        $months
    ): RedirectResponse
    {
        $loanAmount = $amount; // Số tiền vay
        $monthlyInterestRate = 0.008; // Lãi suất hàng tháng
        $numberOfMonths = $months; // Số tháng

        $payments = $this->calculatePayments($loanAmount, $monthlyInterestRate, $numberOfMonths);

        return redirect()->back()->with('data',[
            'amount' => $amount,
            'months' => $months,
            'payments' => $payments
        ]);
    }

    /**
     * @param $principal
     * @param $monthlyInterestRate
     * @param $numberOfMonths
     * @return array
     */
    private function calculatePayments($principal, $monthlyInterestRate, $numberOfMonths): array
    {
        $monthlyPayment = $principal * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, - $numberOfMonths));

        $payments = [];
        $currentDate = now();

        for ($i = 0; $i < $numberOfMonths; $i++) {

            $payment = $monthlyPayment;

            $payments[] = [
                'date' => $currentDate->copy()->addMonths($i)->format('Y-m-d'),
                'amount' => round($payment, 2)
            ];
        }

        return $payments;
    }
}
