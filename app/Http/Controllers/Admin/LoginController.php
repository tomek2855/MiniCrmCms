<?php

namespace App\Http\Controllers\Admin;

use App\AdminLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guest())
        {
            return $this->getLogin();
        }

        return redirect('admin');
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request, MessageBag $messageBag)
    {
        if (Auth::guard()->attempt($request->only('email', 'password'), $request->filled('remember')))
        {
            AdminLog::create([
                'login' => $request->get('email'),
                'success' => true,
                'ip' => $request->ip(),
            ]);

            return redirect('admin');
        }

        AdminLog::create([
            'login' => $request->get('email'),
            'success' => false,
            'ip' => $request->ip(),
        ]);

        $messageBag->add('credencials', 'Login lub hasło są nieprawidłowe');

        return redirect('admin/login')->withErrors($messageBag);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('admin/login');
    }
}
