@extends('layouts.app', ['class' => 'Login'])

@section('content')
<div class="form-wrapper">
    <div class="title" data-aos="fade-right" data-aos-delay="300">
        Login to your account
    </div>

    <div class="row justify-content-center">

        <div class="my-form" data-aos="fade-up">

            <div class="form-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        

                        <div class="col">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="pl-3">
                            <b-form-checkbox
                            id="remember"
                            v-model="status"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }}
                            >
                                {{ __('Remember Me') }}
                            </b-form-checkbox>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="pl-3">
                            <b-button 
                            type="submit"
                            pill 
                            variant="primary"
                            >
                                {{ __('Login') }}
                            </b-button>

                            @if (Route::has('password.request'))
                                <b-button 
                                pill 
                                variant="outline-secondary"
                                href="{{ route('password.request') }}"
                                >
                                    {{ __('Forgot Your Password?') }}
                                </b-button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
