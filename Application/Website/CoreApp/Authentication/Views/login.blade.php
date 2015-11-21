<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Stylesheets -->
    <link href="{{ Request::root() }}/assets/admin_theme_css/bootstrap.css" rel="stylesheet">
    <link href="{{ Request::root() }}/assets/admin_theme_css/font-awesome.css" rel="stylesheet">
    <link href="{{ Request::root() }}/assets/admin_theme_css/style.css" rel="stylesheet">


    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>

<body>

<!-- Form area -->
<div class="admin-form">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <!-- Widget starts -->
                <div class="widget">
                    <!-- Widget head -->
                    <div class="widget-head">
                        <i class="icon-lock"></i> Login
                    </div>

                    <!--Error and success messages  -->
                    <br />

                    @if( Session::has('login_errors') )

                        <div class="alert alert-danger">
                            {{trans('login.invalid_credentials')}}
                        </div>

                    @endif

                    @foreach( $errors->all() as $e )

                        <div class='alert alert-danger'>{{ $e }}</div>

                    @endforeach


                    <!-- End error and success messages -->

                    <div class="widget-content">
                        <div class="padd">
                            <!-- Login form -->
                            {{ Form::open(array('url'=>'login', 'class'=>'form-horizontal')) }}

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="inputEmail">Email</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="inputPassword">Password</label>
                                    <div class="col-lg-9">
                                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                                    </div>
                                </div>
                                <!-- sign in button -->
                                <div class="col-lg-9 col-lg-offset-3">
                                    <button type="submit" class="btn btn-danger">Sign in</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                                <br />
                            </form>

                        </div>
                    </div>

                    <div class="widget-foot">
                           <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- JS -->
<script src="{{ Request::root() }}/assets/admin_theme_js/jquery.js"></script>
<script src="{{ Request::root() }}/assets/admin_theme_js/bootstrap.js"></script>

</body>
</html>