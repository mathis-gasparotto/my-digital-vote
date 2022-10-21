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




    <div class="title-list-container @if($users->isEmpty()) list-null @endif">
        <h1 class="title-list title">
            Liste des utilisateurs
            <a href="{{ route('users.create') }}" class="btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" width="29.25" height="29.25" viewBox="0 0 29.25 29.25">
                    <path id="Icon_ionic-ios-add-circle" data-name="Icon ionic-ios-add-circle" d="M18,3.375A14.625,14.625,0,1,0,32.625,18,14.623,14.623,0,0,0,18,3.375Zm6.363,15.75H19.125v5.238a1.125,1.125,0,0,1-2.25,0V19.125H11.637a1.125,1.125,0,0,1,0-2.25h5.238V11.637a1.125,1.125,0,0,1,2.25,0v5.238h5.238a1.125,1.125,0,0,1,0,2.25Z" transform="translate(-3.375 -3.375)" fill="#fff"/>
                </svg>
            </a>
        </h1>
    </div>
    @if(!$users->isEmpty())
        <div class="list list-striped list-user">
            <div class="list-content">
                @foreach($users as $user)
                    <div class="list-content-container" id="{{ $user->id }}">
                        <div class="list-content-left">
                            <div>
                                <div class="item-infos">
                                    <div class="item-infos-left">{{ $user->firstname }} <span class="lastname">{{ $user->lastname }}</span></div>
                                    <div class="item-infos-right">{{ __("role.$user->role") }}</div>
                                </div>
                                <div class="item-title">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="list-content-right">
                            <div>
                                <a href="{{route('users.edit', $user)}}" class="btn btn-success actions">Modifier</a>
                                <a href="{{route('users.changePass', $user)}}" class="btn btn-infos actions">Modifier son mot de passe</a>
                                <form action="{{route('users.destroy', $user)}}" class="inline-block" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger actions">Supprimer</button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="alert alert-secondary mt-3 m-auto">Il n'y a aucun utilisateur d'enregistré.</div>
        <a href="{{ route('users.create') }}" class="btn btn-primary actions mt-5">Ajouter un nouvel utilisateur</a>
        <a href="{{ route('index') }}" class="btn btn-danger actions mt-5">Retour à la page d'accueil</a>
    @endif

@endsection
