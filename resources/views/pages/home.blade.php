@extends('layouts.app')

@section('description', 'Tivi Internet — penyedia internet WiFi cepat, stabil, dan terjangkau. Pilih paket 10 hingga 500 Mbps, daftar online, teknisi kami yang memasang.')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero-bg relative overflow-hidden pb-36 pt-16 text-white lg:pb-40 lg:pt-24">
    <span class="cloud cloud-1"></span>
    <span class="cloud cloud-2"></span>
    <span class="cloud cloud-3"></span>

    <div class="container-x relative z-10">
        <div class="grid items-center gap-12 lg:grid-cols-12">
            <div class="lg:col-span-7">
                <span class="eyebrow !text-sky-300">Penyedia Layanan Internet</span>
                <h1 class="mb-4 text-4xl leading-[1.12] !text-white sm:text-5xl">Internet WiFi cepat & stabil untuk rumah dan usaha Anda</h1>
                <p class="mb-8 max-w-xl text-lg text-white/85">
                    Pilih paket 10 hingga 500 Mbps sesuai kebutuhan. Daftar online dalam hitungan menit, lalu teknisi {{ config('company.short_name') }} yang memasang di lokasi Anda.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-sky btn-lg">Lihat Produk <i class="bi bi-arrow-right"></i></a>
                    <button type="button" class="btn btn-outline-light btn-lg" data-modal-open="installModal"><i class="bi bi-wifi"></i> Pasang WiFi Baru</button>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 backdrop-blur">
                    <p class="mb-4 text-xs font-semibold uppercase tracking-widest text-white/60">Kenapa {{ config('company.short_name') }}?</p>
                    <div class="grid gap-3">
                        @foreach ([
                            ['bi-infinity', 'Tanpa batas kuota', 'Internet unlimited untuk semua paket'],
                            ['bi-tools', 'Dipasang teknisi', 'Instalasi rapi langsung di lokasi Anda'],
                            ['bi-whatsapp', 'Bantuan via WhatsApp', 'Tanya paket dan pemasangan kapan saja'],
                        ] as [$icon, $title, $text])
                            <div class="flex items-center gap-4 rounded-2xl bg-white/10 px-4 py-3.5 font-semibold">
                                <i class="bi {{ $icon }} text-2xl text-sky-300"></i>
                                <span>{{ $title }}<small class="block font-normal text-white/70">{{ $text }}</small></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute inset-x-0 -bottom-px leading-[0]"><div class="[&>svg]:block [&>svg]:h-20 [&>svg]:w-full">@include('partials.wave')</div></div>
</section>

{{-- ============ 5 PAKET WIFI ============ --}}
<section class="section pt-6">
    <div class="container-x">
        <div class="mx-auto mb-12 max-w-2xl text-center">
            <span class="eyebrow">Paket WiFi</span>
            <h2 class="section-title mb-3">Pilih kecepatan yang pas untuk Anda</h2>
            <p class="muted">Lima pilihan kecepatan paling diminati. Makin tinggi Mbps, makin pekat biru kartunya. Klik <em>Lihat Detail</em> untuk melihat isi paket dan langsung mendaftar.</p>
        </div>

        <div class="pkg-grid">
            @forelse ($featured as $product)
                <div>@include('partials.product-card', ['product' => $product])</div>
            @empty
                <div class="card-soft w-full p-6 text-center text-sm text-sky-700">Belum ada paket. Jalankan <code>php artisan db:seed</code> untuk mengisi contoh data.</div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Lihat Produk <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- ============ KEUNGGULAN ============ --}}
<section class="section section-tint">
    <div class="container-x">
        <div class="mx-auto mb-12 max-w-2xl text-center">
            <span class="eyebrow">Keunggulan</span>
            <h2 class="section-title">Internet yang nyaman dipakai sehari-hari</h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['bi-speedometer2', 'Kecepatan Terpilih', 'Dari 10 sampai 500 Mbps — pilih sesuai jumlah pengguna dan kebutuhan Anda.'],
                ['bi-infinity', 'Unlimited', 'Pakai sepuasnya tanpa khawatir kuota habis di tengah bulan.'],
                ['bi-tools', 'Pemasangan Profesional', 'Teknisi kami datang, memasang, dan memastikan WiFi siap dipakai.'],
                ['bi-headset', 'Bantuan Pelanggan', 'Ada kendala? Hubungi kami lewat WhatsApp kapan pun dibutuhkan.'],
            ] as [$icon, $title, $text])
                <div class="card-soft card-hover p-6">
                    <span class="icon-tile mb-4"><i class="bi {{ $icon }}"></i></span>
                    <h3 class="mb-1 text-lg">{{ $title }}</h3>
                    <p class="muted text-sm">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ ALUR PEMASANGAN ============ --}}
<section class="section">
    <div class="container-x">
        <div class="mx-auto mb-12 max-w-2xl text-center">
            <span class="eyebrow">Cara Pasang</span>
            <h2 class="section-title">Empat langkah mudah</h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Pilih paket', 'Lihat daftar produk dan pilih kecepatan yang sesuai.'],
                ['Isi formulir', 'Klik Pasang Sekarang lalu isi data dan alamat pemasangan.'],
                ['Survei & jadwal', 'Tim kami menghubungi Anda via WhatsApp untuk mengatur jadwal.'],
                ['WiFi menyala', 'Teknisi memasang perangkat dan Anda langsung bisa berselancar.'],
            ] as $i => [$title, $text])
                <div class="flex gap-4">
                    <span class="step-num">{{ $i + 1 }}</span>
                    <div>
                        <h3 class="mb-1 text-base">{{ $title }}</h3>
                        <p class="muted text-sm">{{ $text }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ CTA ============ --}}
<section class="pb-14">
    <div class="container-x">
        <div class="hero-bg rounded-3xl px-8 py-12 text-center text-white lg:flex lg:items-center lg:justify-between lg:text-left">
            <div class="mb-6 lg:mb-0">
                <h2 class="mb-2 text-2xl !text-white sm:text-3xl">Siap berselancar tanpa hambatan?</h2>
                <p class="text-white/70">Daftar sekarang, tim kami akan menghubungi Anda secepatnya.</p>
            </div>
            <button type="button" class="btn btn-sky btn-lg" data-modal-open="installModal"><i class="bi bi-wifi"></i> Pasang WiFi Baru</button>
        </div>
    </div>
</section>

{{-- Popup detail untuk paket di beranda --}}
@foreach ($featured as $product)
    @include('partials.product-modal', ['product' => $product])
@endforeach

@endsection
