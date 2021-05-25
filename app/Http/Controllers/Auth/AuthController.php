<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        //* @return View

        return view('login.login_form');

    }

    /**
     * @param App\Http\Requests\LoginFormRequest $request
     * */
    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('email', 'password');

        $user = User::where('email','=',$credentials['email'])
            ->first();

        if (!is_null($user))
        {
            if ($user->lock_flg === 1)
            {
                return back()->withErrors([
                    'danger' => 'アカウントがロックされています',
                ]);
            }
            if (Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                if ($user->error_count > 0)
                {
                    $user->error_count = 0;
                    $user->save();
                }
                return redirect()->route('home')->with('success','ログイン成功しました');
            }

            $user->error_count += 1;

            if ($user->error_count > 3)
            {
                $user->lock_flg = 1;
                $user->save();
                return back()->withErrors([
                    'danger' => 'アカウントがロックされました',
                ]);

            }
            $user->save();

        }

        return back()->withErrors([
            'danger' => 'メールアドレスかパスワードが間違っています',
        ]);
    }

    /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show')
            ->with('danger','ログアウトしました');
    }


}
