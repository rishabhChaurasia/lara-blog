@props(['active' => false])

<a {{ $attributes->merge(['class' => 'block px-4 py-2 hover:bg-gray-700 ' . ($active ? 'bg-gray-700 border-l-4 border-blue-500' : '')]) }}>
    {{ $slot }}
</a>
