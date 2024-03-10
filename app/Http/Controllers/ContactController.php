<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Facades\Agent;

class ContactController extends Controller
{
    public function contactCSKH(): RedirectResponse
    {
        $userId = backpack_user()->id;

        $staff = Staff::query()->whereHas('Users', function (Builder $builder) use ($userId) {
            $builder->where('users.id', $userId);
        })->first();

        if (!$staff) {
            $staff = Staff::query()->inRandomOrder()->first();

            DB::table('user_staff')->insert([
                'user_id' => $userId,
                'staff_id' => $staff->id
            ]);
        }

        Loan::query()->where('user_id', $userId)->update([
            'staff_id' => $staff['id']
        ]);

        $agent = new \Jenssegers\Agent\Agent();

        if ($agent->isiOS()) {
            $link = $staff->{'link_ios'};
        } else {
            $link = $staff->{'link_android'};
        }

        return redirect()->to('/')->with('redirect', $link);
    }
}
