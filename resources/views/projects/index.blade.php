@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('projects.create') }}">Create</a>
        @forelse($projects as $project)
            @can('update', $project)
                <a href="{{ route('projects.edit', $project) }}">{{ $project->name }}</a>
            @else
                {{ $project->name }}: {{ $project->owner->name }}
            @endcan

            @if($project->trashed())
                <form action="{{ route('projects.restore', $project) }}" method="post">
                    @csrf
                    <button type="submit">Restore</button>
                </form>
            @else
                <form action="{{ route('projects.destroy', $project) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            @endif

        @empty
            PAS DE PROJETS
        @endforelse
    </div>
@endsection
