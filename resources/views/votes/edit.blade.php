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

        <h1 class="card-header text-center title">Modifier un référendum</h1>
        <h3 class="text-center">{{ $vote->title }}</h3>

        <div class="card-body">
            <form action="{{ route('votes.update', $vote) }}" method="post" class="form">
                @method('PUT')
                @csrf
                <div class="form-floating mb-3">
                    <input placeholder="Titre" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $vote->title) }}" type="text" name="title">
                    <label for="title" class="form-label form-required">Titre</label>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <textarea placeholder="Description" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $vote->description) }}</textarea>
                    <label for="description" class="form-label form-required">Description</label>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <input placeholder="Date et heure de fin" class="form-control @error('final_date') is-invalid @enderror" id="final_date" value="{{ strftime('%Y-%m-%dT%H:%M:%S', strtotime(old('final_date', $vote->final_date))) }}" type="datetime-local" name="final_date">
                    <label for="final_date" class="form-label form-required">Date et heure de fin</label>
                    @error('final_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>

    </container>


@endsection
