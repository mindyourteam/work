@extends('layouts.app')

@section('content')
<div class="uk-container">

    <article class="uk-article uk-margin-top uk-margin-bottom">

        <h1 class="uk-article-title">Fragen zur Teamkultur</h1>

        <div class="uk-card uk-card-default uk-margin-top uk-card-body">
        @foreach ($topics as $topic)
            <div class="uk-flex uk-flex-between uk-margin-small-bottom">
                <div class="uk-text-lead">{{$topic->title}}</div>
                <div class="uk-flex" style="min-width:160px">
                    <form class="" title="läuft super" action="{{ route('topic.hide', [$topic]) }}" method="POST">
                        {{ csrf_field() }}
                        <button class="uk-button" uk-icon="heart"></button>
                    </form>
                    <form class="" title="kriegen wir gar nicht hin" action="{{ route('topic.count', [$topic]) }}" method="POST">
                        {{ csrf_field() }}
                        <button class="uk-button" uk-icon="bolt"></button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>

        <article class="uk-margin-top">
            <h2>Was ist das hier?</h2>
                <p>
                    Diese kleine App zeigt zufällig jeweils drei der Themen aus unserer <em>Definition of Work</em>.</p>
                <p>
                    Es gibt zwei Taster pro Thema: <i uk-icon="heart"></i> versteckt
                    das Thema für dich. <i uk-icon="bolt"></i> zählt den Schmerzfaktor des Themas
                    hoch. Wir könnten uns in jeder Retro die Themen mit den höchsten Schmerzen ansehen.
                </p>
                <p>
                    Es gibt eine <a href="{{ route('topic.index') }}">eine einfache Verwaltung der Themen</a>. 
                    Dort kann jedes Team-Mitglied neue Themen hinzufügen. Das Löschen ist für den Augenblick deaktiviert.
                </p>
        </article>
    </div>
</div>
@endsection
