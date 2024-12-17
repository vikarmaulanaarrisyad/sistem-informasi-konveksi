@extends('frontend.main_master')

@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    @include('frontend.common.user_sidebar')
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Change Password</span>
                        </h3>

                        <form action="{{ route('user.update.password') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input id="current_password" class="form-control" type="password" name="current_password">
                            </div>
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input id="password" class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input id="password_confirmation" class="form-control" type="password"
                                    name="password_confirmation">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
