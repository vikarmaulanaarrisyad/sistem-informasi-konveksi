@extends('frontend.main_master')

@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <br>
                    <img src="card-img-top mb-3" style="border-radius: 50%" height="100%" width="100"5 alt=""
                        src="{{ Storage::url($user->profile_photo_path) }}">
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
                            <strong>{{ Auth::user()->name }}</strong> Edit Profile
                        </h3>

                        <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" class="form-control" type="text" name="name"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" type="email" name="email"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="numberphone">Nomor Hp</label>
                                <input id="numberphone" class="form-control" type="number" name="numberphone"
                                    value="{{ $user->numberphone }}">
                            </div>
                            <div class="form-group">
                                <label for="profile_photo_path">Nomor Hp</label>
                                <input id="profile_photo_path" class="form-control" type="file" name="profile_photo_path"
                                    value="{{ $user->profile_photo_path }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
