@extends('layouts.app')

@section('title', 'Tentang Kami')
@section('description', 'Profil, visi, misi, nilai, dan lokasi Tivi Internet — penyedia layanan internet WiFi.')

@section('content')

<header class="page-bg relative pb-20 pt-14 text-white">
    <div class="container-x relative z-10">
        <nav aria-label="breadcrumb" class="mb-2 text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-sky-300 hover:underline">Beranda</a> <span class="mx-1">/</span> <span>Tentang Kami</span>
        </nav>
        <h1 class="mb-2 text-3xl !text-white sm:text-4xl">Tentang Kami</h1>
        <p class="max-w-2xl text-white/85">Mengenal {{ config('company.name') }} dan komitmen kami menghadirkan internet yang cepat dan stabil.</p>
    </div>
    <div class="absolute inset-x-0 -bottom-px leading-[0]"><div class="[&>svg]:block [&>svg]:h-12 [&>svg]:w-full">@include('partials.wave')</div></div>
</header>

{{-- Profil --}}
<section class="section pt-8">
    <div class="container-x">
        <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-14">
            <div>
                <span class="eyebrow">Profil Perusahaan</span>
                <h2 class="section-title mb-4">Bergerak di bidang layanan internet WiFi</h2>
                <p class="muted mb-3">
                    {{ config('company.name') }} adalah penyedia layanan internet yang menghadirkan koneksi WiFi cepat, stabil, dan terjangkau untuk rumah tangga, kos-kosan, pelaku usaha, hingga perkantoran.
                </p>
                <p class="muted">
                    Kami menyediakan paket dari 10 hingga 500 Mbps agar pelanggan dapat memilih sesuai kebutuhan. Mulai dari pendaftaran, survei lokasi, pemasangan oleh teknisi, hingga bantuan setelah terpasang — semuanya kami dampingi.
                </p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([
                    ['bi-speedometer2', 'Cepat & stabil', 'Koneksi yang nyaman untuk bekerja, belajar, dan hiburan.'],
                    ['bi-tools', 'Pemasangan rapi', 'Teknisi kami memasang dan memastikan WiFi siap dipakai.'],
                    ['bi-cash-coin', 'Harga transparan', 'Paket dan harga jelas, tanpa biaya yang membingungkan.'],
                    ['bi-headset', 'Bantuan cepat', 'Hubungi kami lewat WhatsApp kapan pun ada kendala.'],
                ] as [$icon, $title, $text])
                    <div class="card-soft p-5">
                        <span class="icon-tile icon-tile-soft mb-3 !size-12 !text-xl"><i class="bi {{ $icon }}"></i></span>
                        <h3 class="mb-1 text-base">{{ $title }}</h3>
                        <p class="muted text-sm">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Visi & Misi --}}
<section class="section section-tint">
    <div class="container-x">
        <div class="grid gap-6 lg:grid-cols-12">
            <div class="card-soft p-7 lg:col-span-5 lg:p-9">
                <span class="icon-tile mb-4"><i class="bi bi-eye"></i></span>
                <h2 class="mb-2 text-2xl">Visi</h2>
                <p class="muted">Menjadi penyedia layanan internet yang dipercaya masyarakat dan pelaku usaha, dengan koneksi yang cepat, stabil, dan terjangkau.</p>
            </div>
            <div class="card-soft p-7 lg:col-span-7 lg:p-9">
                <span class="icon-tile mb-4"><i class="bi bi-flag"></i></span>
                <h2 class="mb-2 text-2xl">Misi</h2>
                <ul class="muted grid list-disc gap-2 pl-5">
                    <li>Menyediakan paket internet WiFi yang beragam sesuai kebutuhan pelanggan.</li>
                    <li>Menjaga kualitas koneksi yang stabil dan dapat diandalkan.</li>
                    <li>Memberikan pemasangan dan layanan bantuan yang cepat dan ramah.</li>
                    <li>Mempermudah pendaftaran melalui website dan WhatsApp.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Nilai --}}
<section class="section">
    <div class="container-x">
        <div class="mx-auto mb-12 max-w-xl text-center">
            <span class="eyebrow">Nilai Kami</span>
            <h2 class="section-title">Prinsip yang kami pegang</h2>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Kepercayaan', 'Bekerja jujur dan terbuka kepada setiap pelanggan.'],
                ['Kecepatan', 'Respons dan pemasangan yang cepat.'],
                ['Kualitas', 'Koneksi stabil menjadi prioritas utama kami.'],
                ['Kepedulian', 'Mendengar dan membantu setiap kendala pelanggan.'],
            ] as $i => [$title, $text])
                <div class="card-soft card-hover p-6 text-center">
                    <span class="step-num mb-3">{{ $i + 1 }}</span>
                    <h3 class="mb-1 text-lg">{{ $title }}</h3>
                    <p class="muted text-sm">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Lokasi --}}
<section class="section section-tint">
    <div class="container-x">
        <div class="card-soft grid items-center gap-8 p-7 lg:grid-cols-12 lg:p-10">
            <div class="lg:col-span-7">
                <span class="eyebrow">Lokasi Kami</span>
                <h2 class="section-title mb-6">Kunjungi atau hubungi kami</h2>
                <ul class="grid gap-5">
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-geo-alt"></i></span>
                        <div><strong class="block text-sea-900">Alamat</strong><span class="muted">{{ config('company.address') }}</span></div>
                    </li>
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-whatsapp"></i></span>
                        <div><strong class="block text-sea-900">WhatsApp</strong><span class="muted">{{ config('company.whatsapp_display') }}</span></div>
                    </li>
                    <li class="flex gap-4">
                        <span class="icon-tile icon-tile-soft"><i class="bi bi-clock"></i></span>
                        <div><strong class="block text-sea-900">Jam layanan</strong><span class="muted">{{ config('company.hours') }}</span></div>
                    </li>
                </ul>
            </div>
            <div class="lg:col-span-5 lg:text-center">
                <a href="{{ config('company.maps_url') }}" target="_blank" rel="noopener" class="btn btn-primary btn-lg"><i class="bi bi-map"></i> Buka di Google Maps</a>
            </div>
        </div>
    </div>
</section>

<section class="py-14">
    <div class="container-x">
        <div class="hero-bg rounded-3xl px-8 py-12 text-center text-white">
            <h2 class="mb-2 text-2xl !text-white sm:text-3xl">Siap memasang WiFi di tempat Anda?</h2>
            <p class="mb-6 text-white/70">Pilih paket dan daftar sekarang, kami yang urus pemasangannya.</p>
            <a href="{{ route('products.index') }}" class="btn btn-sky btn-lg">Lihat Produk</a>
        </div>
    </div>
</section>

@endsection
