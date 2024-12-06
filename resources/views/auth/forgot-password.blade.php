@extends('frontend.main_master')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>Lupa Password</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div>

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <div class="col-md-12 col-sm-12 sign-in">
                        <h4 class="">Lupa Password</h4>
                        <p class="">Silahkan masukkan email anda</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="email">Email <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input"
                                    id="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Request Reset
                                Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')

            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
    </div>
@endsection
