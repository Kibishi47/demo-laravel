@extends('layouts.app')

@section('content')
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <x-form.input name="name" label="Name" />
        <x-form.input name="slug" label="Slug" />
        <label for="description">Description</label>
        <textarea name="description">{{ old('description', '') }}</textarea>
        <button type="submit">Submit</button>
    </form>
@endsection
