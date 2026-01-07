@extends('layouts.app')
@section('content')
    <h1>About Function of Pages Controller</h1>
    {{-- @unless (empty($name))
        <h2> This is not empty:{{ $name }}</h2>
    @endunless
    @switch($name)
        @case('Duong')
            <h2>This is Duong</h2>
            @break
        @case('Admin')
            <h2>This is Admin</h2>
            @break
        @default
            <h2>No one selected</h2>
    @endswitch

    @for($i = 0;$i<10;$i++)
        <h3> The number is: {{ $i }}</h3>
    @endfor --}}

    {{-- @foreach($names as $n)
        <h3>Name: {{ $n }}</h3>
    @endforeach --}}

    @php $i = 0; @endphp
    
    @while($i < 10)
        <h3> The number is: {{ $i }}</h3>
        @php $i++;@endphp
    @endwhile
@endsection
