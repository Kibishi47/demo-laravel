@extends('layouts.app')

@section('content')
    <div>
        @php($emailName = 'email')

        <a href="{{ route('login') }}">Ahh bah si</a>

        <form action="{{ route('registerSubmit') }}" method="post">
            @csrf
            <x-form.input :name="$emailName" label="Email" default="example@gmail.com" />
            <x-form.input name="name" label="Name" />
            <x-form.input name="password" label="Password" type="password" />
            <x-form.input name="password_confirmation" label="Password confirmation" type="password" />

            @error('login')
                {{ $message }}
            @enderror

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
