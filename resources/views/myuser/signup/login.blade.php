@extends('myuser.layouts.view')
@section('title', 'Register')
@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-form-col">
                    @include('myuser.layouts.session_message')
                    <h1>Sign in</h1>

                    <form action="{{ url('login') }}" class="login-form" name="cform" id="loginForm" method="post">
                        @csrf
                        <div class="form-social-ico">
                            <a href="javascript:void(0)" class="applelogin"><img
                                    src="{{ asset('images/apple-icon.png') }}" alt=""
                                    data-pagespeed-url-hash="2450801669"
                                    onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                            <a href="{{ url('auth-google') }}" class="gmaillogin"><img
                                    src="{{ asset('images/google-icon.png') }}" alt=""
                                    data-pagespeed-url-hash="854500134"
                                    onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                            <a href="{{ url('auth-facebook') }}" class="fblogin" title="Facebook"><i class="lab la-facebook-f"></i></a>
                            <a href="javascript:void(0)" class="instalogin" title="Instagram"><i class="lab la-instagram"></i></a>
                        </div>

                        <div class="ortxt"><span>OR</span></div>

                        <div class="form-group">
                            <p class="contact-form-name">
                                <label>Email / Username*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Email / Username" value="{{ old('email') }}">
                                @error('email')
                                <p class="formError emailId">{{ $message }}</p>
                                @enderror

                            </p>
                        </div>

                        <div class="form-group">
                            <p class="contact-form-email">
                                <label>Password*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter password" value="{{ old('password') }}">
                            <div class="show-pass">Show Password</div>
                            @error('password')
                                <p class="formError password">{{ $message }}</p>
                            @enderror

                            </p>
                        </div>

                        <div class="form-footer">
                            <div class="custom-control custom-checkbox ml-0">
                                <input type="checkbox" class="custom-control-input" id="rememberMe"
                                    {{ (old('isRememberMe') == Y ? 'checked' : !empty($userGlowDtl)) ? 'checked' : '' }}>
                                <label class="custom-control-label form-footer-right" for="rememberMe">Remember
                                    me</label>
                                <input type="hidden" id="isRememberMe" value="{{ !empty($userGlowDtl) ? 'y' : 'n' }}">
                            </div>
                            <div class="form-footer-right">
                                <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="login"><input type="submit" id="loginBtn" name="submit" class="common-btn w-100"
                                    id="quote-submit" value="Sign In"></div>

                            <div class="text-center">
                                <div class="login-bottom">
                                    <p>Don’t have an Account?</p><a href="{{ url('sign-up') }}" class="reg-link">Create
                                        account</a>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>


        </div>
    </div>
    <script>
        /*------------------ remember me ----------------------*/
        $('#rememberMe').on('click', function() {
            if ($(this).prop('checked') == true) {
                $('#isRememberMe').val('y');
            } else {
                $('#isRememberMe').val('n');
            }
        });
        /*------------------ remember me ----------------------*/
        $(function() {
            let sAnyError = "{{ Session::has('failureMsg') ? Session::get('failureMsg') : '' }}";

            if (sAnyError != '' && sAnyError != undefined && sAnyError != null) {
                $('.failure').show();
                $('.failure').toast('show');
                $('.failure .toast-body').html(`${sAnyError}`);
            }
            let sStatus = "{{ Session::has('status') ? Session::get('status') : '' }}";
            let successMsg =
                "{{ Session::has('successMsg') ? Session::get('successMsg') : '' }}";
            if (sStatus != '' && sStatus != undefined && sStatus != null) {
                $('.success').show();
                $('.success').toast('show');
                $('.success .toast-body').html(`${successMsg}`);
            }
        });
        
    </script>
@endsection
