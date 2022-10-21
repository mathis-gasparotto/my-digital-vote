@extends('../layout')

@section('content')
    <container class="card card-form">
        <h1 class="card-header text-center">Reset Password</h1>
        <p class="text-center mt-3">Enter your new password.</p>
        <div class="card-body">
            <form method="POST" action="{{ route('password.update', $token) }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <input type="hidden" name="email" value="{{ $email }}">

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end form-required">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end form-required">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </container>



@endsection

