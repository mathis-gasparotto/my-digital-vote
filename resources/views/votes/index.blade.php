@extends('layout')

@section('link')
    @if($status === "in_progress")
        <a href="{{ route('votes.archives') }}" class="btn title" title="Accéder aux archives">
            Archives
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="70" viewBox="0 0 60 70" class="after">
                <path id="Polygone_2" data-name="Polygone 2" d="M26.362,14.808a10,10,0,0,1,17.276,0l17.59,30.154A10,10,0,0,1,52.59,60H17.41A10,10,0,0,1,8.773,44.961Z" transform="translate(60) rotate(90)" fill="#fff"/>
            </svg>
        </a>
    @elseif($status === "not_in_progress")
        <a href="{{ route('index') }}" class="btn title" title="Accéder aux référendums en cours">
            En cours
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="70" viewBox="0 0 60 70" class="after">
                <path id="Polygone_2" data-name="Polygone 2" d="M26.362,14.808a10,10,0,0,1,17.276,0l17.59,30.154A10,10,0,0,1,52.59,60H17.41A10,10,0,0,1,8.773,44.961Z" transform="translate(60) rotate(90)" fill="#fff"/>
            </svg>
        </a>
    @endif
@endsection

@section('content')

    <div class="title-list-container @if($votes->isEmpty()) list-null @endif">
        <h1 class="title-list title">
            @if($status === "in_progress")
                Derniers référendums
            @elseif($status === "not_in_progress")
                Archives de référendum
            @endif
            @if($status === "in_progress")
                @if(\Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::Delegate->value || \Illuminate\Support\Facades\Auth::user()->role === "super_admin")
                    <a href="{{ route('votes.create') }}" class="btn-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29.25" height="29.25" viewBox="0 0 29.25 29.25">
                            <path id="Icon_ionic-ios-add-circle" data-name="Icon ionic-ios-add-circle" d="M18,3.375A14.625,14.625,0,1,0,32.625,18,14.623,14.623,0,0,0,18,3.375Zm6.363,15.75H19.125v5.238a1.125,1.125,0,0,1-2.25,0V19.125H11.637a1.125,1.125,0,0,1,0-2.25h5.238V11.637a1.125,1.125,0,0,1,2.25,0v5.238h5.238a1.125,1.125,0,0,1,0,2.25Z" transform="translate(-3.375 -3.375)" fill="#fff"/>
                        </svg>
                    </a>
                @endif
            @endif
        </h1>
    </div>
    @if(!$votes->isEmpty())
        <div class="list list-striped list-vote">
            <div class="list-content">
                @foreach($votes as $vote)
                    <div class="list-content-container" id="{{ $vote->id }}">
                        <div class="list-content-left">
                            <a href="{{ route('votes.show', $vote) }}" title="Voir plus sur le référendum">

                                <div class="item-title">{{ $vote->title }}@if(!$vote->votings->isEmpty()) - <span class="voted">Voté</span>@endif @if($vote->status !== "in_progress") - <span class="{{ $vote->status }}">{{ __("status.$vote->status") }}</span>@endif</div>
                                @if($vote->status !== "in_progress" && $vote->yes+$vote->no)
                                    <div class="vote-results">
                                        <div class="yes-bar result-bar"></div>
                                        <div class="no-bar result-bar" style="width: {{ ($vote->no/($vote->no+$vote->yes))*100 }}%"></div>
                                        <div class="yes-text choice-text">Oui ({{ number_format(($vote->yes/($vote->no+$vote->yes))*100, 0) }}%)</div>
                                        <div class="no-text choice-text">Non ({{ number_format(($vote->no/($vote->no+$vote->yes))*100, 0) }}%)</div>
                                    </div>
                                @endif
                                <div class="item-infos">
                                    <div class="item-infos-left">Nombre de votes : {{ $vote->yes + $vote->no }}</div>
                                    @php
                                        $date = date_create($vote->final_date);
                                    @endphp
                                    <div class="item-infos-right">Date de fin : {{ $date->format('d.m.Y - G:i') }}</div>
                                </div>
                            </a>
                        </div>
                        <div class="list-content-right">
                            <a href="{{ route('votes.show', $vote) }}" title="Voir plus sur le référendum">
                                <div class="vote-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="70" viewBox="0 0 60 70">
                                        <path id="Polygone_2" data-name="Polygone 2" d="M26.362,14.808a10,10,0,0,1,17.276,0l17.59,30.154A10,10,0,0,1,52.59,60H17.41A10,10,0,0,1,8.773,44.961Z" transform="translate(60) rotate(90)" fill="#fff"/>
                                    </svg>
                                </div>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        @if($status === "in_progress")
            <div class="alert alert-secondary mt-3 m-auto">Il n'y a aucun référendum d'enregistré.</div>
        @elseif($status === "not_in_progress")
            <div class="alert alert-secondary mt-3 m-auto">Il n'y a aucun référendum d'archivé.</div>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::Delegate->value || \Illuminate\Support\Facades\Auth::user()->role === "super_admin")
            <a href="{{ route('votes.create') }}" class="btn btn-primary actions mt-5">Ajouter un nouveau référendum</a>
        @endif
    @endif

@endsection
