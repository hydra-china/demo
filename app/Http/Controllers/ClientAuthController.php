<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

class ClientAuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::query()->where('username', $request->username)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Tài khoản không tồn tại']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không đúng']);
        }

        backpack_auth()->loginUsingId($user->id);

        return redirect()->to('/');
    }

    public function registerView()
    {
        return view('register');
    }

    /**
     * @throws ValidationException
     */
    public function register(): RedirectResponse
    {
        $this->validate(request(), [
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::query()->create([
            'username' => request('username'),
            'name' => request('username'),
            'password' => Hash::make(request('password')),
        ]);

        backpack_auth()->loginUsingId($user->id);

        return redirect()->to('/');
    }

    public function logout()
    {
        backpack_auth()->logout();
        return redirect('/');
    }

    public function notSupport()
    {
        $agent = new Agent();

        if ($agent->isAndroidOS()) {
            return redirect('/');
        }
        return view("not-support");
    }
}
