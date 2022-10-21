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

        <h1 class="card-header text-center title">Modifier le mot de passe</h1>
        <h3 class="text-center">{{ $user->firstname }} {{ $user->lastname }}</h3>

        <div class="card-body">
            <form action="{{ route('users.updatePass', $user) }}" method="post" class="form">
                @method('PUT')
                @csrf
                <div class="form-floating mb-3">
                    <input placeholder="Nouveau mot de passe" class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password">
                    <label for="password" class="form-label form-required">Nouveau mot de passe</label>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-floating mb-1">
                    <input placeholder="Confirmation du nouveau mot de passe" class="form-control" id="password_confirmation" type="password" name="password_confirmation">
                    <label for="password_confirmation" class="form-label form-required">Confirmation du nouveau mot de passe</label>

                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>

    </container>


@endsection
