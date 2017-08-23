@if (!empty($breadcrumbs))
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $link => $title)
            @if ($loop->last)
                <li class="active">{{$title}}</li>
            @else
                <li><a href="{{$link}}">{{$title}}</a></li>
            @endif
        @endforeach
    </ol>
@endif

