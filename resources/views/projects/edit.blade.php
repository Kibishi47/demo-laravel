@extends('layouts.app')

@section('content')
    <form action="{{ route('projects.update', $project) }}" method="post">
        @method('PUT')
        @csrf

        <x-form.input name="name" label="Name" :value="$project->name"/>
        <x-form.input name="slug" label="Slug" :value="$project->slug"/>

        <label for="description">Description</label>
        <textarea name="description">{{ old('description', $project->description) }}</textarea>

        <label>Actif ?</label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" @checked($project->is_active)>
        @error('is_active')
            {{ $message }}
        @enderror

        <button type="submit">Submit</button>
    </form>
@endsection
