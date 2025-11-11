@extends('layouts.app')

@section('content')
    @auth
        @foreach($user->projects as $project)
            {{ $project->name }}
        @endforeach
    @endauth
@endsection
