@extends('../layout')

@section('content')

    <container class="card card-form">

        <h1 class="card-header text-center">Reset Password</h1>
        <p class="text-center mt-3">Please enter your email address.<br/>
            If an account is associated with this email address,<br/>
            A link to change your password will be sent to you.</p>

        <div class="card-body">
            <form action="{{ route('password.forgotten') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label form-required">Email:</label>
                    <input class="form-control @error('email') is-invalid @enderror @if (session('status')) is-valid @endif" id="email" value="{{ old('email') }}" type="email" name="email" required>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>



    </container>



@endsection
