@extends('layouts.app')

@section('content')
    <div>
        @php($emailName = 'email')

        <a href="{{ route('register') }}">Pas de compte ??</a>

        <form action="{{ route('authenticate') }}" method="post">
            @csrf
            <x-form.input :name="$emailName" label="Email" />
            <x-form.input name="password" label="Password" type="password" />

            @error('login')
                {{ $message }}
            @enderror

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
