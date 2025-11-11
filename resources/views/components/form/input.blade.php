@props([
    'id',
    'name',
    'label',
    'type' => 'text',
    'default' => '',
    'value' => null
])

<label for="{{ $id ?? $name }}">{{ $label }}</label>
<input id="{{ $id ?? $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value ?? $default) }}">

@error($name)
    {{ $message }}
@enderror
