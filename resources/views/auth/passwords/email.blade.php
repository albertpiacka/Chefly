@extends('layouts.app')

@section('content')
<div class="form-wrapper" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="my-form">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row justify-content-center">
                        <div class="offset-md-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="offset-md-4">
                            <b-button type="submit" pill variant="primary">
                                {{ __('Send Password Reset Link') }}
                            </b-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
