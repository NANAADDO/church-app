@extends('layouts.cover')

@section('content')

    <section id="intro">
        <div class="intro-container wow fadeIn">
            <div class="card col-md-8" style="top: -30px;background-color: #ffffffa8;">
                <div class="card-body">
                    <img src="{{asset('coverpage/img/apple-touch-icon.png')}}" height="120px" width="120px"
                    style="border-radius: 50%; margin-top: -90px;"/>



                    <hr>
                    <div class="text-center" style="margin-top: 50px;">
                        <h4 class=" text-uppercase text-center"
                            style="font-family: 'Pacifico', cursive; color: white;">E.P CHURCH MANAGER</h4>
<a href="{{url('/login')}}" role="button" class="btn btn-custon-rounded-four btn-success btn-sm btn-block" style="margin-top: 50px;
border-radius: 20px;">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">


                    </div>
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-3">

                    </div>
                </div>
            </div>
        </section>

@endsection


