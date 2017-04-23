<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Response;
use App\Http\Requests\UserLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->userRepository = $userRepository;
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        return $this->login($request);
    }

    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'confirmed' => config('common.user.confirmed.is_confirm')], $request->has('remember'))) {
            if (Auth::user()->isAdmin()) {
                return redirect('/admin_home');
            }
            return redirect('/');
        } else {
            return redirect()->back()->withErrors(trans('message.login_error'));
        }
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        return $this->register($request);
    }

    public function register(RegisterRequest $request)
    {
        $confirmationCode = str_random(config('common.user.confirmation_code.length'));
        $input = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'confirmed' => config('common.user.confirmed.not_confirm'),
            'confirmation_code' => $confirmationCode,
        ];

        $sendMailData = [
            'email' => $request->email,
            'name' => $request->name,
            'confirmation_code' => $confirmationCode,
        ];

        try {
            $user = $this->userRepository->create($input, $sendMailData);
        } catch (Exception $e) {
            return redirect('/')->withError($e->getMessage());
        }

        return redirect()->back()->withErrors(trans('message.register_active'));;
    }

    public function confirm($confirmationCode)
    {
        try {
            $user = $this->userRepository->updateConfirm($confirmationCode);
            Auth::login($user);

            if (Auth::user()->isAdmin()) {
                return redirect('/admin_home');
            }

            return redirect('/');
        } catch (Exception $e) {
            return redirect('/')->withError($e->getMessage());
        }
    }
}
