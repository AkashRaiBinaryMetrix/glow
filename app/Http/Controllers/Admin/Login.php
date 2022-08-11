<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Login extends Controller
{
    public function pwd()
    {
        $pwd = Crypt::encryptString('Admin@123?#');
    }
    public function index(Request $request)
    {
        /*---------- if user is logged in than redirect to dashboard ------------*/
        $isAdminLoggedIn = session('isAdminLoggedIn') ?? '';
        if (!empty($isAdminLoggedIn)) {
            return redirect('admin/dashboard');
        }
        /*---------- if user is logged in than redirect to dashboard ------------*/

        $post = $request->input();
        if (!empty($post)) {
            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'Please enter valid email',
                    'password.required' => 'Password is required',
                ]
            );
            $email = $post['email'] ?? '';
            $password = $post['password'] ?? '';
            $aDetails = DB::table('system_users')->where('email', $email)->first();
            if (!empty($aDetails)) {
                $status = $aDetails->status ?? '';
                if ($status && $status == ACTIVE) {
                    $encPassword = $aDetails->password ?? '';
                    $decPassword = !empty($encPassword) ? Crypt::decryptString($encPassword) : '';
                    if (!empty($decPassword) && !empty($password) && $password == $decPassword) {
                        /*------------------ set session -----------*/
                        session(['isAdminLoggedIn' => $aDetails]);
                        return redirect('/admin/dashboard');
                        /*------------------ set session -----------*/
                    } else {
                        return redirect()->back()->withInput($request->input())->with('failureMsg',
                            'Invalid credentials');
                    }
                } else {
                    return redirect()->back()->withInput($request->input())->with('failureMsg',
                        'Your account is inactivated');
                }

            } else {
                return redirect()->back()->withInput($request->input())->with('failureMsg',
                    'Invalid credentials');
            }
        }
        return view('admin.login.index');
    }
    public function forgotPassword(Request $request)
    {
        $post = $request->input();
        if (!empty($post)) {
            $request->validate(
                [
                    'email' => 'required|email',
                ],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'Please enter valid email',
                ]
            );
            $email = $post['email'] ?? '';
            $aDetails = DB::table('system_users')->where('email', $email)->first();

            if (!empty($aDetails)) {
                $status = $aDetails->status ?? '';
                if ($status && $status == ACTIVE) {
                    $sFullName = $aDetails->name ?? '';
                    $encPassword = $aDetails->password ?? '';
                    $decPassword = !empty($encPassword) ? Crypt::decryptString($encPassword) : '';

                    Mail::send('admin.mail_template.forgot_mail', ['sFullName' => $sFullName, 'password' => $decPassword], function ($message) use ($email) {
                        $message->to($email)
                            ->subject(SITE_NAME . ' Forgot Password')
                            ->from(MAIL_FROM_ADDRESS);
                    });

                    $request->session()->flash('status', 'success');
                    $request->session()->flash('successMsg', 'Your password has been sent to your registered mail id');
                    return redirect('/login');
                } else {
                    return redirect()->back()->withInput($request->input())->with('failureMsg',
                        'Your account is inactivated');
                }

            } else {
                return redirect()->back()->withInput($request->input())->with('failureMsg',
                    'Invalid credentials');
            }
        }
        return view('admin.forgot_password.index');
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin');
    }
}