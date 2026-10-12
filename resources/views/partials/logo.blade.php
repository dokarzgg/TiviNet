{{-- Logo Tivi. Param: $uid (id unik gradient), $size.
     Untuk memakai logo sendiri: simpan file di public/images/logo.png (otomatis dipakai). --}}
@php($uid = $uid ?? 'logo')
@php($size = $size ?? 40)
@if (file_exists(public_path('images/logo.png')))
    <img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('company.name') }}" height="{{ $size }}" style="height: {{ $size }}px; width: auto;">
@else
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Logo {{ config('company.name') }}">
        <defs>
            <linearGradient id="{{ $uid }}-g" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0" stop-color="#0a4f82"/>
                <stop offset="1" stop-color="#38a8e0"/>
            </linearGradient>
        </defs>
        <rect width="48" height="48" rx="12" fill="url(#{{ $uid }}-g)"/>
        <g fill="none" stroke="#fff" stroke-width="3.4" stroke-linecap="round">
            <path d="M9 21c8.5-8 21.5-8 30 0" opacity=".55"/>
            <path d="M14.5 27c5.5-5 14.5-5 19 0" opacity=".8"/>
            <path d="M20 33c2.5-2.2 5.5-2.2 8 0"/>
        </g>
        <circle cx="24" cy="39" r="2.6" fill="#fff"/>
    </svg>
@endif
