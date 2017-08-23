@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Definition of Work</strong></div>

                    <div class="panel-body">
                        @foreach ($topics as $topic)
                            <p>{{$topic->title}}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <h2>Was ist das hier?</h2>
                <p>
                    Wir hatten uns am 23.08.2017 eine <em>Definition of Work</em> gegeben.
                    Diese kleine App zeigt zufällig jeweils drei der Themen daraus.</p>
                <p>
                    Das will ich bei Gelegenheit noch um zwei Taster und ein Eingabefeld ergänzen.
                    Einen Taster zum Drücken, falls der Schmerz immer noch besteht. Einen zweiten,
                    wenn man dieses Thema nicht mehr sehen will. Über das Eingabefeld konnen weitere
                    Themen hinzugefügt werden.</p>
                <p>
                    Über die Tastendrücke kann ich dann ein Ranking machen und eine Liste der top
                    Schmerzpunkte anzeigen.
                </p>
            </div>
        </div>
    </div>
@endsection
