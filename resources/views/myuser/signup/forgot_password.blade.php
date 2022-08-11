@extends('myuser.layouts.view')
@section('title', 'Register')
@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-form-col">
                    @include('myuser.layouts.session_message')
                    <h1>Recover Password</h1>

                    <form action="{{ url('forgot-password') }}" class="login-form" name="cform" method="post">
                        @csrf
                        <div class="form-group">
                            <p class="contact-form-name">
                                <label>Email*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter email" value="{{ old('email') }}">
                            </p>
                            @error('email')
                                <p class="formError emailId">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="common-btn w-100" id="quote-submit"
                                value="Recover Password">
                        </div>

                        <div class="form-disclaimer">*Please fill in mandatory fields.</div>

                    </form>

                </div>
            </div>


        </div>
    </div>
@endsection
