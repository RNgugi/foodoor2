@extends('layouts.restaurants')

@section('content')
<section>
        <div class="block no-padding  gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner2">
                            <div class="inner-title2">
                                <h3>Login</h3>
                                <span>Keep up to date with the latest offers</span>
                            </div>
                            <div class="page-breacrumbs">
                                <ul class="breadcrumbs">
                                    <li><a href="#" title="">Home</a></li>
                                    <li><a href="#" title="">Account</a></li>
                                    <li><a href="#" title="">Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block remove-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account-popup-area signin-popup-box static">
                            <div class="account-popup">
                                <h3>Login</h3>
                                <span>Lorem ipsum dolor sit amet consectetur adipiscing elit odio duis risus at lobortis ullamcorper</span>
                                <form method="post" action="{{ route('login') }}">
                                     @csrf
                                    <div class="cfield">
                                        <input type="text" placeholder="Email" name="email" />
                                        <i class="la la-user"></i>
                                    </div>
                                    <div class="cfield">
                                        <input type="password" placeholder="********" name="password" />
                                        <i class="la la-key"></i>
                                    </div>
                                    <p class="remember-label">
                                        <input type="checkbox" name="remember" id="remember"><label for="remember">Remember me</label>
                                    </p>
                                    <a href="{{ route('password.request') }}" title="">Forgot Password?</a>
                                    <button type="submit">Login</button>
                                </form>
                                <div class="extra-login">
                                    <span>Or</span>
                                    <div class="login-social">
                                        <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                                        <a class="tw-login" href="#" title=""><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- LOGIN POPUP -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
