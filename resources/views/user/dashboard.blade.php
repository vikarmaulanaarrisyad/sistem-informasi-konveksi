@extends('frontend.main_master')

@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <br>
                    <img src="card-img-top mb-3" style="border-radius: 50%" height="100%" width="100"5 alt="">
                    <li class="list-group list-group-flush">
                        <a href="{{ url('/') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block">Profile
                            Update</a>
                        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change
                            Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </li>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi...</span>
                            <strong>{{ Auth::user()->name }}</strong> Selamat Datang di {{ config('app.name') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
