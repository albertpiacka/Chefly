@extends('layouts.app', ['class' => 'Register'])

@section('content')
<div class="form-wrapper">
    <div class="title" data-aos="fade-right" data-aos-delay="300">
        Register for free
    </div>

    <div class="row justify-content-center">

        <div class="my-form" data-aos="fade-up">

            <div class="form-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="p-3">
                            <b-button 
                            pill 
                            variant="primary"
                            type="submit"
                            >
                                {{ __('Register') }}
                            </b-button>

                            or 

                            <b-button 
                            pill 
                            variant="outline-primary"
                            href="{{ route('login') }}"
                            >
                                {{ __('Login') }}
                            </b-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
    </div>
</div>
@endsection
