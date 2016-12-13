<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SignupAdminController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/signup/events';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Override view file.
     */
    public function showLoginForm()
    {
        return view('signup/login', [
            'pageTitle' => 'Login',
        ]);
    }

    /**
     * Override username.
     */
    public function username()
    {
        return 'name';
    }

    /**
     * Override logout redirect url.
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($this->redirectTo);
    }
}
