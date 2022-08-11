<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class SignUp extends Controller
{
    public function register()
    {
        return view('myuser.signup.register');
    }
    public function signIn(Request $request)
    {
        $post = $request->input();
        $firstName = !empty($post['firstName']) ? $post['firstName'] : '';
        $lastName = !empty($post['lastName']) ? $post['lastName'] : '';
        $username = !empty($post['username']) ? $post['username'] : '';
        $emailId = !empty($post['emailId']) ? $post['emailId'] : '';
        $password = !empty($post['password']) ? $post['password'] : '';
        $sEncPwd = !empty($password) ? Crypt::encryptString($password) : '';
        $zipCode = !empty($post['zipCode']) ? $post['zipCode'] : '';
        $denomination = !empty($post['denomination']) ? $post['denomination'] : '';
        $church = !empty($post['church']) ? $post['church'] : '';
        /*--------------------- check user already exists ---------------------*/
        $isExists = DB::table('users')->where([['email', $emailId], ['is_deleted', N]])->first();

        if (!empty($isExists)) {
            echo json_encode(['status' => 'failure', 'msg' => 'Email is already exists']);
            exit();
        }
        /*--------------------- check user already exists ---------------------*/
        $fullName = $firstName . '_*_' . $lastName;
        /*------------------- get current date time -------------------*/
        $sCurrentDateTime = getCurrentLocalDateTime();
        /*------------------- get current date time -------------------*/
        $aData = [
            'name' => $fullName,
            'email' => $emailId,
            'username'=>$username,
            'password' => $sEncPwd,
            'zip_code' => $zipCode,
            'denomination' => $denomination,
            'church' => $church,
            'created_at' => $sCurrentDateTime,
        ];
        $iId = DB::table('users')->insertGetId($aData);
        if ($iId) {
            $sFullName = $firstName .' '. $lastName;
            Mail::send('myuser.mail_template.signup_mail', ['sFullName' => $sFullName], function ($message) use ($emailId) {
                $message->to($emailId)
                    ->subject(SITE_NAME . ' Sign Up')
                    ->from(MAIL_FROM_ADDRESS);
            });
            echo json_encode(['status' => 'success', 'msg' => 'You have registered successfully']);
            exit();
        } else {
            echo json_encode(['status' => 'failure', 'msg' => 'You have not registered. Please try again']);
            exit();
        }
    }
    public function login(Request $request)
    {
        /*--------------- if user already logged in then redirect to home page -------------*/
        $isUserLoggedIn = Session('isUserLoggedIn');
        if (!empty($isUserLoggedIn)) {
            return redirect('/');
        }
        $userCookieDtl = Cookie::get('userGlowDtl');
        $userGlowDtl = !empty($userCookieDtl) ? explode('__*__', $userCookieDtl) : '';
        /*--------------- if user already logged in then redirect to home page -------------*/
        $post = $request->input();
        if (!empty($post)) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ],
                [
                    'email.required' => 'Email is required',
                    'password.required' => 'Password is required',
                ]
            );

            $email = !empty($post['email']) ? $post['email'] : '';
            $password = !empty($post['password']) ? $post['password'] : '';
            $isRememberMe = !empty($post['isRememberMe']) ? $post['isRememberMe'] : '';
            $aDetail = DB::table('users')
                          ->where([['email', $email], ['is_deleted', N]])
                          ->orWhere([['is_deleted', N]])
                          ->where([['username', $email]])
                          ->first();
            if (!empty($aDetail)) {
                $status = !empty($aDetail->status) ? $aDetail->status : '';
                if ($status && $status == ACTIVE) {
                    $sDecPassword = !empty($aDetail->password) ? Crypt::decryptString($aDetail->password) : '';
                    if (!empty($sDecPassword) && !empty($password) && $password == $sDecPassword) {
                        /*------------------ set session --------------*/
                        $request->session()->put('isUserLoggedIn', $aDetail);
                        /*------------------ set session --------------*/

                        /*------------------ set cookie --------------*/
                        $isCookieSet = Cookie::get('userGlowDtl');
                        if (!empty($isRememberMe) && $isRememberMe == Y) {

                            if (empty($isCookieSet)) {

                                $sEmailIdPassword = $email . '__*__' . $password;
                                $sEncEmailIdPassword = $sEmailIdPassword;
                                $expire = 30 * 24 * 3600;
                                Cookie::queue('userGlowDtl', $sEncEmailIdPassword, $expire);
                            }

                        } else {
                            Cookie::queue(Cookie::forget('userGlowDtl'));
                        }
                        /*------------------ set cookie --------------*/

                        $request->session()->flash('successMsg', 'You have logged in successfully');
                        return redirect('/');
                    } else {
                        return redirect()->back()->withInput($request->all())->with('failureMsg', 'Invalid credentials');
                    }
                } else {
                    return redirect()->back()->withInput($request->all())->with('failureMsg', 'Your account has inactivated');
                }
            } else {
                return redirect()->back()->withInput($request->all())->with('failureMsg', 'Invalid credentials');
            }
        }
        return view('myuser.signup.login', ['userGlowDtl' => $userGlowDtl]);
    }

    public function forgotPassword(Request $request)
    {
        $post = $request->input();
        if (!empty($post)) {
            $request->validate([
                'email' => 'required|email',
            ],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'Please enter valid email id',
                ]
            );

            $email = !empty($post['email']) ? $post['email'] : '';
            $aDetail = DB::table('users')->where([['email', $email], ['is_deleted', N]])->first();

            if (!empty($aDetail)) {
                $status = !empty($aDetail->status) ? $aDetail->status : '';
                if ($status && $status == ACTIVE) {
                    $sDecPassword = !empty($aDetail->password) ? Crypt::decryptString($aDetail->password) : '';
                    $sName = !empty($aDetail->name) ? explode('_*_', $aDetail->name) : '';
                    $sFullName = !empty($sName) ? implode(' ', $sName) : '';
                    Mail::send('myuser.mail_template.forgot_mail', ['sFullName' => $sFullName, 'password' => $sDecPassword], function ($message) use ($email) {
                        $message->to($email)
                            ->subject(SITE_NAME . ' Forgot Password')
                            ->from(MAIL_FROM_ADDRESS);
                    });

                    $request->session()->flash('status', 'success');
                    $request->session()->flash('successMsg', 'Your password has been sent to your registered mail id');
                    return redirect('/login');
                } else {
                    return redirect()->back()->withInput($request->all())->with('failureMsg', 'Your account has inactivated');
                }
            } else {
                return redirect()->back()->withInput($request->all())->with('failureMsg', 'Invalid credentials');
            }
        }
        return view('myuser.signup.forgot_password');
    }
    public function userLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $aDetail = DB::table('users')->where('google_unique_id', $user->id)->first();
            if ($aDetail) {
                /*------------------ set session --------------*/
                session(['isUserLoggedIn' => $aDetail]);
                /*------------------ set session --------------*/
                return redirect('/');

            } else {
                $iId = DB::table('users')->insertGetId([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_unique_id' => $user->id,
                ]);
                $aDetail = DB::table('users')->where('id', $iId)->first();
                /*------------------ set session --------------*/
                session(['isUserLoggedIn' => $aDetail]);
                /*------------------ set session --------------*/
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFB()
    {
        return Socialite::driver('facebook')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
     
            $user = Socialite::driver('facebook')->user();
            $aDetail = DB::table('users')->where('facebook_unique_id', $user->id)->first();
            if($aDetail){
      
                /*------------------ set session --------------*/
                session(['isUserLoggedIn' => $aDetail]);
                /*------------------ set session --------------*/
                return redirect('/');
      
            }else{
                $iId = DB::table('users')->insertGetId([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_unique_id' => $user->id,
                ]);
                $aDetail = DB::table('users')->where('id', $iId)->first();
                /*------------------ set session --------------*/
                session(['isUserLoggedIn' => $aDetail]);
                /*------------------ set session --------------*/
                return redirect('/'); 
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToInsta()
    {
        $appId = config('services.instagram.client_id');
        $redirectUri = urlencode(config('services.instagram.redirect'));
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }
    public function handleInstagramCallback(Request $request)
    {
                $code = $request->code;
                if (empty($code)) return redirect('/')->with('error', 'Failed to login with Instagram.');

                $appId = config('services.instagram.client_id');
                $secret = config('services.instagram.client_secret');
                $redirectUri = config('services.instagram.redirect');

                $client = new Client();

                // Get access token
                $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
                    'form_params' => [
                        'app_id' => $appId,
                        'app_secret' => $secret,
                        'grant_type' => 'authorization_code',
                        'redirect_uri' => $redirectUri,
                        'code' => $code,
                    ]
                ]);

                if ($response->getStatusCode() != 200) {
                    return redirect('/')->with('error', 'Unauthorized login to Instagram.');
                }

                $content = $response->getBody()->getContents();
                $content = json_decode($content);

                $accessToken = $content->access_token;
                $userId = $content->user_id;
                
                // Get user info
                $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");

                $content = $response->getBody()->getContents();
                $oAuth = json_decode($content);

                // Get instagram user name 
                  $username = $oAuth->username;
                // do your code here
                $aDetail = DB::table('users')->where('instagram_unique_id', $userId)->first();
                if($aDetail) {
        
                    /*------------------ set session --------------*/
                    session(['isUserLoggedIn' => $aDetail]);
                    /*------------------ set session --------------*/
                    return redirect('/');
        
                } else {
                        $iId = DB::table('users')->insertGetId([
                            'username' => $username,
                            'instagram_unique_id' => $userId,
                        ]);
                        $aDetail = DB::table('users')->where('id', $iId)->first();
                        /*------------------ set session --------------*/
                        session(['isUserLoggedIn' => $aDetail]);
                        /*------------------ set session --------------*/
                        return redirect('/');
                }
          }
}