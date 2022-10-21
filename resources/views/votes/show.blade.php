@extends('layout')

@section('link')
    @if($vote->status === "in_progress")
        <a href="{{ route('index') }}#{{ $vote->id }}" class="btn title" title="Accéder aux référendums en cours">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="58" viewBox="0 0 50 58" class="before">
                <path id="Polygone_7" data-name="Polygone 7" d="M22.08,11.931a8,8,0,0,1,13.84,0L51.032,37.986A8,8,0,0,1,44.112,50H13.888a8,8,0,0,1-6.92-12.014Z" transform="translate(0 58) rotate(-90)" fill="#fff"/>
            </svg>
            En cours
        </a>
    @else
        <a href="{{ route('votes.archives') }}#{{ $vote->id }}" class="btn title" title="Accéder aux référendums archivés">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="58" viewBox="0 0 50 58" class="before">
                <path id="Polygone_7" data-name="Polygone 7" d="M22.08,11.931a8,8,0,0,1,13.84,0L51.032,37.986A8,8,0,0,1,44.112,50H13.888a8,8,0,0,1-6.92-12.014Z" transform="translate(0 58) rotate(-90)" fill="#fff"/>
            </svg>
            Archives
        </a>
    @endif
@endsection

@section('content')
    <div class="vote-show-container">
        <h1 class="title vote-show-title">{{ $vote->title }}</h1>
        <p class="vote-show-description text">{{ $vote->description }}</p>
        @if($vote->status === "in_progress")
            @if(\Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::Delegate->value || \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::Student->value)
                @if($vote->votings->isEmpty())
                    <div class="vote-show-choice">
                        <form action="{{route('votes.yes', $vote)}}" class="btn-choice btn-choice-yes" method="post">
                            @csrf
                            <button type="submit" class="btn">Oui</button>
                        </form>
                        <form action="{{route('votes.no', $vote)}}" class="btn-choice btn-choice-no" method="post">
                            @csrf
                            <button type="submit" class="btn">Non</button>
                        </form>
                    </div>
                @endif
            @endif
        @else
            @if($vote->yes+$vote->no)
                <div class="vote-results">
                    <div class="yes-bar result-bar"></div>
                    <div class="no-bar result-bar" style="width: {{ ($vote->no/($vote->no+$vote->yes))*100 }}%"></div>
                    <div class="yes-text choice-text">Oui ({{ number_format(($vote->yes/($vote->no+$vote->yes))*100, 0) }}%)</div>
                    <div class="no-text choice-text">Non ({{ number_format(($vote->no/($vote->no+$vote->yes))*100, 0) }}%)</div>
                </div>
            @endif
        @endif
        <div class="vote-show-count text">Nombre de votants : {{ $vote->yes + $vote->no }}</div>
        @php
            $date = date_create($vote->final_date);
        @endphp
        <div class="vote-show-date text">Date de fin : {{ $date->format('d.m.Y - G:i') }}</div>
        <div class="vote-show-status text">État : <span class="{{ $vote->status }}">{{ __("status.$vote->status") }}</span></div>
        @if($vote->status !== "in_progress")
            @if(\Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::Admin->value || \Illuminate\Support\Facades\Auth::user()->role === "super_admin")
                <div class="admin">
                    <form action="{{route('votes.accept', $vote)}}" class="inline-block" method="post">
                        @csrf
                        <button type="submit" class="btn btn-infos actions">Accepter</button>
                    </form>
                    <form action="{{route('votes.decline', $vote)}}" class="inline-block" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning actions">Rejeter</button>
                    </form>
                </div>
            @endif
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->role === "super_admin")
            <div class="super_admin">
                <a href="{{route('votes.edit', $vote)}}" class="btn btn-infos actions">Modifier</a>
                <form action="{{route('votes.destroy', $vote)}}" class="inline-block" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger actions">Supprimer</button>
                </form>
                <form action="{{route('votes.finish', $vote)}}" class="inline-block" method="post">
                    @csrf
                    <button type="submit" class="btn btn-warning actions">Arrêter le référendum</button>
                </form>
            </div>
        @endif
    </div>





@endsection
