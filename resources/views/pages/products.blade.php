@extends('layouts.app')

@section('title', 'Produk')
@section('description', 'Daftar paket WiFi Tivi Internet dari 10 hingga 500 Mbps untuk rumahan, streaming & gaming, serta bisnis.')

@section('content')

<header class="page-bg relative pb-20 pt-14 text-white">
    <div class="container-x relative z-10">
        <nav aria-label="breadcrumb" class="mb-2 text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-sky-300 hover:underline">Beranda</a> <span class="mx-1">/</span> <span>Produk</span>
        </nav>
        <h1 class="mb-2 text-3xl !text-white sm:text-4xl">Produk Paket WiFi</h1>
        <p class="max-w-2xl text-white/85">Pilih paket sesuai kebutuhan Anda. Klik <em>Lihat Detail</em>, lalu <em>Pasang Sekarang</em> untuk mendaftar.</p>
    </div>
    <div class="absolute inset-x-0 -bottom-px leading-[0]"><div class="[&>svg]:block [&>svg]:h-12 [&>svg]:w-full">@include('partials.wave')</div></div>
</header>

<section class="section pt-6">
    <div class="container-x">

        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-sm muted">
                Halaman <strong class="text-sea-900">{{ $products->currentPage() }}</strong> dari {{ $products->lastPage() }}
                · {{ $products->total() }} paket tersedia
            </div>

            {{-- Legenda gradasi: makin gelap = makin cepat --}}
            <div class="flex items-center gap-3 text-xs font-semibold text-slate-500">
                <span>Lebih lambat</span>
                <span class="h-3 w-40 rounded-full border border-white shadow-inner" style="background-image: linear-gradient(90deg, #8fd3f4, #0b5a94, #020f1f);"></span>
                <span>Lebih cepat</span>
            </div>
        </div>

        <div class="pkg-grid">
            @forelse ($products as $product)
                <div>@include('partials.product-card', ['product' => $product])</div>
            @empty
                <div class="card-soft w-full p-10 text-center">
                    <i class="bi bi-wifi-off text-5xl text-slate-400"></i>
                    <h2 class="mt-3 text-lg">Belum ada paket</h2>
                    <p class="muted text-sm">Jalankan <code>php artisan db:seed</code> untuk mengisi contoh data.</p>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-12">{{ $products->links() }}</div>
        @endif
    </div>
</section>

@foreach ($products as $product)
    @include('partials.product-modal', ['product' => $product])
@endforeach

@endsection
