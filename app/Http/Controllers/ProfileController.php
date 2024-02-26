<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Loan;
use App\Models\Profile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        $hasProfile = true;

        if (! $profile) {
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

        if (! $profile) {
            abort(404);
        }

        return view('user-detail', [
            'profile' => $profile,
        ]);
    }

    public function contract($back = false, $next = false): View
    {
        $contract = Config::query()->where('key', 'contract')->firstOrFail();

        $profile = Profile::query()->where('user_id', backpack_user()->id)->first();

        $loan = Loan::query()->where('user_id', backpack_user()->id)->first();

        $value = $contract->getAttributeValue('value');

//        $value = str_replace('$name', $profile['name'], $value);
//
//        $value = str_replace('$cmnd', $profile['uuid'], $value);
//        $value = str_replace('$amount', number_format($loan['amount']), $value);
//        $value = str_replace('$months', $loan['month'], $value);
        $this->mapVariable($value, '$name', $profile['name']);
        $this->mapVariable($value, '$cmnd', $profile['uuid']);
        $this->mapVariable($value, '$amount', number_format($loan['amount']) . ' đ');
        $this->mapVariable($value, '$months', $loan['month']);

        $contract->setAttribute('value', $value);

        return \view('contract', [
            'contract' => $contract,
            'back' => $back,
            'next' => $next
        ]);
    }

    private function mapVariable(&$value, string $variableName, $variableData)
    {
        $variableData = "<b class='text-danger'>" . $variableData . "</b>";

        $value = str_replace($variableName, $variableData, $value);
    }
}
