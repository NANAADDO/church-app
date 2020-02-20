@extends('layouts.auth')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image login-html" style="background-color: #3258c7e8;">
                             <img src="{{asset('general/img/ep.png')}}" style="height: 270px; width: 260px; margin: auto;
position: relative;top: 18%; left: 20%;">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="user" >
                                        @csrf
                                        {!! HtmlEntities::get_dynamic_form_type_input(['text','username','form-control form-control-user','exampleInputEmail','',$errors,'Enter Staff username...']) !!}

                                        {!! HtmlEntities::get_dynamic_form_type_input(['password','password','form-control form-control-user','exampleInputPassword','',$errors,'Enter Password...']) !!}

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block"
                                           value="Login"/>


                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<style>

    .login-html {

        background: rgba(40,57,101,.9);
    }
</style>
@endsection

