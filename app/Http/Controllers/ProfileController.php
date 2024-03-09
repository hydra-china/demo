<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Loan;
use App\Models\Profile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        $hasProfile = true;

        if (!$profile) {
            $hasProfile = false;
        }

        return view('profile', [
            'hasProfile' => $hasProfile,
            'profile' => $profile,
        ]);
    }

    public function detail(): View
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        if (!$profile) {
            abort(404);
        }

        return view('user-detail', [
            'profile' => $profile,
        ]);
    }

    public function contract($back = false, $next = false): View|RedirectResponse
    {
        $contract = Config::query()->where('key', 'contract')->firstOrFail();

        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        $loan = Loan::query()->where('user_id', backpack_user()->id)->first();

        if (!$contract) {
            abort(404);
        }

        if (!$profile || !$loan) {
            return redirect()->back()->with('error', 'Chưa có khoản vay nào');
        }

        $value = $contract->getAttributeValue('value');

        $this->mapVariable($value, '$name', $profile['name']);
        $this->mapVariable($value, '$cmnd', $profile['uuid']);
        $this->mapVariable($value, '$amount', number_format($loan['amount']) . ' đ');
        $this->mapVariable($value, '$months', $loan['months']);
        $this->mapVariable($value, '$month', $loan['months']);

        $contract->setAttribute('value', $value);

        return \view('contract', [
            'contract' => $contract,
            'signature'=> $loan['signature'],
            'back' => $back,
            'next' => $next
        ]);
    }

    private function mapVariable(&$value, string $variableName, $variableData)
    {
        $variableData = "<b class='text-dark'>" . $variableData . "</b>";

        $value = str_replace($variableName, $variableData, $value);
    }
}
