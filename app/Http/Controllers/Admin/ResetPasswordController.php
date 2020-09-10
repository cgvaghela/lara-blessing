<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

    use ResetsPasswords;
    
    /**
     * override default properties
     *
     */
    protected $redirectTo = '/admin';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        \Config::set("auth.defaults.passwords","admin");
        $this->middleware('guest.admin');
    }

}
