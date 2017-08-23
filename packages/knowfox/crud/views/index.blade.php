@extends('layouts.app')

@section('content')
    <div class="container">
        @include('crud::partials.messages')
        @include('crud::partials.breadcrumbs')

        <div class="page-header">
            <div class="pull-right">
                <a href="{{ $create['route'] }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus"></i> {{ $create['title'] }}
                </a>
            </div>
            <h1>{{$page_title}}</h1>
        </div>

        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="row">
                    @yield('context')

                    <div class="col-sm-12">
                        @if ($entities->count() == 0)
                            <p>- {{ $no_result }} -</p>
                        @else
                            <?php
                            $cols = [];
                             ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                    @foreach ($columns as $key => $column)
                                        <?php
                                        $title = is_string($column) ? $column : $column['title'];
                                        $cols[$key] = [
                                            'title' => $title,
                                            'type' => is_string($column) ? 'text' : $column['type'],
                                        ];
                                        ?>
                                        <th>{{ $title }}</th>
                                    @endforeach
                                        <th style="width:10em">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($entities as $entity)
                                    <tr>
                                        @foreach ($cols as $col => $info)
                                            <td>
                                                @if ($info['type'] == 'money')
                                                    {{ number_format($entity->{$col}, 2, ',', '.') }} €
                                                @else
                                                    {{ $entity->{$col} }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="text-right" style="white-space: nowrap">
                                            @include('crud::partials.actions', ['entity_id' => $entity->id])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="text-center">{{ $entities->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection