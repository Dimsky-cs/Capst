@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => '
        border-gray-300
        focus:border-primary
        focus:ring-primary
        rounded-lg
        shadow-sm
        px-4 py-2
        placeholder-gray-400
        text-gray-900
        leading-tight
        block
        w-full
        bg-white
        transition
        duration-150
        ease-in-out
    ',
]) !!}>
