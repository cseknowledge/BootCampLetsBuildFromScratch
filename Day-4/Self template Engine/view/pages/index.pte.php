@extends('layouts.main-layout')

@section('content')
    @include('partials.test')

    <div>
        For Loop Test:

        @for ($i = 0; $i < 10; $i++)
            The current value is {{ $i }}
        @endfor

        For Each Test:
        <ul>
            @foreach($items as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endsection