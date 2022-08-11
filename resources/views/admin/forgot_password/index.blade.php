<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('images/logo.png') }}" alt="logo">
                            </div>
                            <h6 class="font-weight-light">Forgot Password</h6>
                            @include('admin.layouts.session_message')
                            <form action="{{ url('admin/forgot-password') }}" method="post" class="pt-3">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email"
                                        id="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">

                                    </div>
                                    <a href="{{ url('/admin') }}" class="auth-link text-black">Back
                                        to Login</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/settings.js') }}"></script>
    <script src="{{ asset('backend/js/todolist.js') }}"></script>
    <!-- endinject -->
    <script>
        $(function() {
            let sAnyError = "{{ Session::has('failureMsg') ? Session::get('failureMsg') : '' }}";
            if (sAnyError != '' && sAnyError != undefined && sAnyError != null) {
                $('.failure').show();
                $('.failure').toast('show');
                $('.failure .toast-body').html(`${sAnyError}`);
            }
        });
    </script>
</body>

</html>
