@extends('myuser.layouts.view')
@section('title', 'Register')
@section('content')
    <div class="inner-page">
        <div class="container">

            <div class="login-wrapper">
                <div class="login-form-col">
                    @include('myuser.layouts.message')
                    <h1>Create Account</h1>

                    <form class="login-form" name="cform" id="signUpForm" method="post">
                        @csrf
                        <div class="form-social-ico">
                            <a href="javascript:void(0)" class="applelogin"><img src="{{ asset('images/apple-icon.png') }}"
                                    alt="" data-pagespeed-url-hash="2450801669"
                                    onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                            <a href="{{ url('auth-google') }}" class="gmaillogin"><img
                                    src="{{ asset('images/google-icon.png') }}" alt=""
                                    data-pagespeed-url-hash="854500134"
                                    onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                            <a href="{{ url('auth-facebook') }}" class="fblogin" title="Facebook"><i class="lab la-facebook-f"></i></a>
                            <a href="javascript:void(0)" class="instalogin" title="Instagram"><i class="lab la-instagram"></i></a>
                        </div>

                        <div class="ortxt"><span>OR</span></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="contact-form-name">
                                        <label>First Name*</label>
                                        <input type="text" size="30" maxlength="30" name="firstName" id="firstName"
                                            class="form-control" placeholder="Enter first name" >
                                    <p class="formError firstName"></p>
                                    </p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="contact-form-name">
                                        <label>Last Name*</label>
                                        <input type="text" size="30" maxlength="30" name="lastName" id="lastName"
                                            class="form-control" placeholder="Enter last name">
                                    <p class="formError lastName"></p>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <p class="contact-form-name">
                              <label>Username</label>  
                              <input type="text" maxlength="50" name="username" id="username" class="form-control" placeholder="Username">
                            </p>
                        </div>

                        <div class="form-group">
                            <p class="contact-form-name">
                                <label>Email*</label>
                                <input type="email" name="emailId" id="emailId" class="form-control"
                                    placeholder="Enter email" size="50" maxlength="50">
                            <p class="formError emailId"></p>
                            </p>
                        </div>

                        <div class="form-group">
                            <p class="contact-form-email">
                                <label>Password*</label>
                                <input type="password" size="50" maxlength="50" name="password" id="password" class="form-control"
                                    placeholder="Create password">
                            <div class="show-pass">Show Password</div>
                            <p class="formError password"></p>
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p class="contact-form-name">
                                        <label>Zip Code*</label>
                                        <input type="text" size="6" maxlength="6" name="zipCode" id="zipCode" class="form-control"
                                            placeholder="Enter zip code">
                                    <p class="formError zipCode"></p>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <p class="contact-form-name">
                                        <label>Denomination*</label>
                                        <select name="denomination" id="denomination" class="form-control">
                                            <option value="">Select denomination</option>
                                            <option value="Roman Catholic">Roman Catholic</option>
                                            <option value="Protestant">Protestant</option>
                                            <option value="Baptist">Baptist</option>
                                            <option value="Lutheran">Lutheran</option>
                                            <option value="Orthodox">Orthodox</option>
                                            <option value="Unaffiliated Christian">Unaffiliated Christian</option>
                                            <option value="Evangelical">Evangelical</option>
                                            <option value="Pentecostal/Charismatic">Pentecostal/Charismatic</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    <p class="formError denomination"></p>
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <p class="contact-form-email">
                                <label>Other Nonprofit Organization / Schools / Others</label>
                                <input type="text" size="80" maxlength="50" name="church" id="church" class="form-control"
                                    placeholder="Currently attending or member">
                            <p class="formError church"></p>
                            </p>
                            <p><small><strong>Note:</strong> Selected Church or Nonprofit Organization will receive 10% donation from GLOW net income at the end of every year</small></p>
                        </div>


                        <div class="form-footer">
                            <div class="custom-control custom-checkbox ml-0">
                                <input type="checkbox" name="terms_condition" class="custom-control-input"
                                    id="lost-password">
                                <label class="custom-control-label create-terms" for="lost-password">I have read and
                                    agree to the <a href="javascript:void(0)">Terms and Condions</a></label>
                            </div>
                            <p class="formError terms_condition_error"></p>
                        </div>

                        <div class="form-group">
                            <div id="register"><input type="button" name="submit" class="common-btn w-100"
                                    id="signUp" value="Sign In"></div>

                            <div class="text-center">
                                <div class="login-bottom">Already have an Account? <a href="{{ url('login') }}"
                                        class="reg-link">Log In</a>
                                </div>
                            </div>

                        </div>

                        <div class="form-disclaimer">*Please fill in mandatory fields.</div>

                    </form>

                </div>
            </div>


        </div>
    </div>
    <script>
        $('#firstName').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(strigChar)) {
                return true;
            }
            return false
        });

        $('#lastName').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(strigChar)) {
                return true;
            }
            return false
        });

        $("#zipCode").keypress(function (e) {
            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
        });

        let firstNameError = 0,
            lastNameError = 0,
            emailIdError = 0,
            passwordError = 0,
            zipCodeError = 0,
            denominationError = 0;
            checkboxError = 0;
        $('#signUp').on('click', function() {
            const re =
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let username = $('#username').val();
            let emailId = $('#emailId').val();
            let password = $('#password').val();
            let zipCode = $('#zipCode').val();
            let denomination = $('#denomination').val();
            let church = $('#church').val();
            if (firstName == '' || firstName == undefined || firstName == null) {
                $('.firstName').html(`First name is required`);
                firstNameError++;
            } else {
                $('.firstName').html(``);
                firstNameError = 0;
            }
            if (lastName == '' || lastName == undefined || lastName == null) {
                $('.lastName').html(`Last name is required`);
                lastNameError++;
            } else {
                $('.lastName').html(``);
                lastNameError = 0;
            }
            if (emailId == '' || emailId == undefined || emailId == null) {
                $('.emailId').html(`Email is required`);
                emailIdError++;
            } else if (emailId != '' && emailId != undefined && emailId != null && !re.test(emailId)) {
                $('.emailId').html(`Please enter valid email`);
                return false;
            } else {
                $('.emailId').html(``);
                emailIdError = 0;
            }
            if (password == '' || password == undefined || password == null) {
                $('.password').html(`Password is required`);
                passwordError++;
            } else if (password && password.length < 6) {
                $('.password').html(`Password must have contain atleast six character`);
                passwordError++;
            } else {
                $('.password').html(``);
                passwordError = 0;
            }
            if (zipCode == '' || zipCode == undefined || zipCode == null) {
                $('.zipCode').html(`Zip code is required`);
                zipCodeError++;
            } else {
                $('.zipCode').html(``);
                zipCodeError = 0;
            }
            if (denomination == '' || denomination == undefined || denomination == null) {
                $('.denomination').html(`Denomination is required`);
                denominationError++;
            } else {
                $('.denomination').html(``);
                denominationError = 0;
            }
            if (firstNameError > 0 || lastNameError > 0 || emailIdError > 0 || passwordError > 0 ||
                zipCodeError > 0 || denominationError > 0) {
                return false;
            } else if(!($('#lost-password').is(':checked'))){
                $('.terms_condition_error').html(`Please click on terms and condition`).show();
                checkboxError++;
            }else {
                $('#register').html(`<i class = "fa fa-circle-o-notch fa-spin" style = "font-size:24px"> 
                    </i>`);
                $.ajax({
                    url: sBASEURL + "signIn",
                    type: "POST",
                    data: {
                        firstName,
                        lastName,
                        username,
                        emailId,
                        password,
                        zipCode,
                        denomination,
                        church,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        let result = JSON.parse(response);
                        if (result.status == 'success') {
                            $('.success').show();
                            $('.success').toast('show');
                            $('.success .toast-body').html(`${result.msg}`);
                            $('.terms_condition_error').hide();
                            $('#signUpForm')[0].reset();
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 2000);
                        } else {
                            $('.failure').show();
                            $('.failure').toast('show');
                            $('.failure .toast-body').html(`${result.msg}`);
                        }
                        $('#register').html(
                            `<input type="button" name="submit" class="common-btn w-100"
                                    id="signUp" value="Sign In">`
                        );
                    }
                });
            }
        });
    </script>
@endsection
