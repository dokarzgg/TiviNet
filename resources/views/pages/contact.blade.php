@extends('layouts.app')

@section('title', 'Kontak')
@section('description', 'Hubungi Tivi Internet untuk bertanya tentang paket WiFi dan pemasangan.')

@section('content')

<header class="page-bg relative pb-20 pt-14 text-white">
    <div class="container-x relative z-10">
        <nav aria-label="breadcrumb" class="mb-2 text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-sky-300 hover:underline">Beranda</a> <span class="mx-1">/</span> <span>Kontak</span>
        </nav>
        <h1 class="mb-2 text-3xl !text-white sm:text-4xl">Hubungi Kami</h1>
        <p class="max-w-2xl text-white/85">Punya pertanyaan seputar paket atau pemasangan? Kirim pesan atau chat WhatsApp kami.</p>
    </div>
    <div class="absolute inset-x-0 -bottom-px leading-[0]"><div class="[&>svg]:block [&>svg]:h-12 [&>svg]:w-full">@include('partials.wave')</div></div>
</header>

<section class="section pt-8">
    <div class="container-x">
        <div class="grid gap-8 lg:grid-cols-12">

            {{-- Form --}}
            <div class="card-soft p-6 lg:col-span-7 lg:p-9">
                <h2 class="mb-6 text-xl">Kirim pesan</h2>

                @if (session('success'))
                    <div class="mb-5 flex gap-2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="alert">
                        <i class="bi bi-check-circle-fill"></i><div>{{ session('success') }}</div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">Mohon periksa kembali isian Anda.</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" novalidate class="grid gap-4 sm:grid-cols-2">
                    @csrf
                    <div>
                        <label for="name" class="label">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="field {{ $errors->has('name') ? 'field-error' : '' }}">
                        @error('name') <p class="error-text">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="label">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="field {{ $errors->has('email') ? 'field-error' : '' }}">
                        @error('email') <p class="error-text">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="phone" class="label">Nomor telepon</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="field {{ $errors->has('phone') ? 'field-error' : '' }}">
                        @error('phone') <p class="error-text">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="subject" class="label">Subjek <span class="text-red-500">*</span></label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="field {{ $errors->has('subject') ? 'field-error' : '' }}">
                        @error('subject') <p class="error-text">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="label">Pesan <span class="text-red-500">*</span></label>
                        <textarea id="message" name="message" rows="6" required placeholder="Tuliskan pertanyaan atau kebutuhan internet Anda…" class="field {{ $errors->has('message') ? 'field-error' : '' }}">{{ old('message') }}</textarea>
                        @error('message') <p class="error-text">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-send"></i> Kirim Pesan</button>
                    </div>
                </form>
            </div>

            {{-- Info --}}
            <div class="card-soft h-fit p-6 lg:col-span-5 lg:p-9">
                <h2 class="mb-6 text-xl">Informasi kontak</h2>
                <ul class="grid gap-6">
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-geo-alt"></i></span>
                        <div>
                            <strong class="block text-sea-900">Alamat</strong>
                            <span class="muted">{{ config('company.address') }}</span>
                            <a href="{{ config('company.maps_url') }}" target="_blank" rel="noopener" class="block text-sm font-semibold text-sea-700 hover:underline">Buka di Google Maps</a>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-whatsapp"></i></span>
                        <div>
                            <strong class="block text-sea-900">WhatsApp</strong>
                            <a href="https://wa.me/{{ config('company.whatsapp') }}" target="_blank" rel="noopener" class="font-semibold text-sea-700 hover:underline">{{ config('company.whatsapp_display') }}</a>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-envelope"></i></span>
                        <div><strong class="block text-sea-900">Email</strong><span class="muted">{{ config('company.email') }}</span></div>
                    </li>
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-clock"></i></span>
                        <div><strong class="block text-sea-900">Jam layanan</strong><span class="muted">{{ config('company.hours') }}</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
