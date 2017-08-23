@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Definition of Work</strong></div>

                    <div class="panel-body dow"><ul>
                        @foreach ($topics as $topic)
                            <li>
                                <form class="pull-right" action="{{ route('topic.hide', [$topic]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn ctn-default"><i class="glyphicon glyphicon-scissors"></i></button>
                                </form>
                                <form class="pull-right" action="{{ route('topic.count', [$topic]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn ctn-default"><i class="glyphicon glyphicon-fire"></i></button>
                                </form>
                                {{$topic->title}}</li>
                        @endforeach
                        </ul></div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <h2>Was ist das hier?</h2>
                <p>
                    Wir hatten uns am 23.08.2017 eine <em>Definition of Work</em> gegeben.
                    Diese kleine App zeigt zufällig jeweils drei der Themen daraus.</p>
                <p>
                    Es gibt zwei Taster pro Thema: <i class="glyphicon glyphicon-scissors"></i> versteckt
                    das Thema für dich. <i class="glyphicon glyphicon-fire"></i> zählt den Schmerzfaktor des Themas
                    hoch. Wir könnten uns in jeder Retro die Themen mit den höchsten Schmerzen ansehen.
                </p>
                <p>
                    Im Dropdown-Menü unter deinem Namen liegt <a href="{{ route('topic.index') }}">eine einfache Verwaltung der Themen</a>. Dort kann jeder neue
                    Themen hinzufügen. Das Löschen ist für den Augenblick deaktiviert.
                </p>
            </div>
        </div>
    </div>
@endsection
