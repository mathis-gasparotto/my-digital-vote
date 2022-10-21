@extends('layout')

@section('link')
    <a href="{{ route('index') }}" class="btn title" title="Accéder à la page d'accueil">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="58" viewBox="0 0 50 58" class="before">
            <path id="Polygone_7" data-name="Polygone 7" d="M22.08,11.931a8,8,0,0,1,13.84,0L51.032,37.986A8,8,0,0,1,44.112,50H13.888a8,8,0,0,1-6.92-12.014Z" transform="translate(0 58) rotate(-90)" fill="#fff"/>
        </svg>
        Accueil
    </a>
@endsection

@section('content')


    <container class="card card-form">

        <h1 class="card-header text-center title">Modifier un utilisateur</h1>
        <h3 class="text-center">{{ $user->firstname }} {{ $user->lastname }}</h3>

        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="post" class="form">
                @method('PUT')
                @csrf
                <div class="form-floating mb-3">
                    <input placeholder="Prénom" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{ old('firstname', $user->firstname) }}" type="text" name="firstname">
                    <label for="firstname" class="form-label form-required">Prénom</label>
                    @error('firstname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <input placeholder="Nom" class="form-control @error('lastname') is-invalid @enderror" id="lastname" value="{{ old('lastname', $user->lastname) }}" type="text" name="lastname">
                    <label for="lastname" class="form-label form-required">Nom</label>
                    @error('lastname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <input placeholder="Email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $user->email) }}" type="email" name="email">
                    <label for="email" class="form-label form-required">Email</label>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="role" class="form-label form-required">Rôle :</label>
                    <select class="form-select @error('role') is-invalid @enderror" aria-label="Default select example" id="role" name="role">
                        @foreach(\App\Enums\RoleEnum::cases() as $case )
                            <option value="{{ $case->value }}" @if($user->role === $case->value) selected @endif>{{ __("role.$case->name") }}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>

    </container>


@endsection
