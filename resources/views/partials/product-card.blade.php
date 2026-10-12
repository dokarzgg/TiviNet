{{-- Kartu paket WiFi. Param: $product.
     Warna gradasi biru makin GELAP untuk paket dengan Mbps lebih tinggi (lihat Product::getCardGradientAttribute). --}}
@php
    $g    = $product->card_gradient;
    $dark = $g['dark'];
@endphp
<div class="relative flex h-full flex-col overflow-hidden rounded-3xl border border-white/40 p-5 text-center shadow-lg shadow-sea-700/15 transition duration-200 hover:-translate-y-1 hover:shadow-2xl hover:shadow-sea-700/30 {{ $dark ? 'text-white' : 'text-sea-900' }}"
     style="{{ $g['style'] }}" data-speed="{{ $product->speed_mbps }}">

    @if ($product->is_popular)
        <span class="absolute right-3 top-3 rounded-full bg-white px-2.5 py-0.5 text-[.65rem] font-bold uppercase tracking-wide text-sea-700 shadow">Terlaris</span>
    @endif

    <i class="bi {{ $product->icon }} text-3xl leading-none {{ $dark ? 'text-sky-300' : 'text-sea-700' }}"></i>

    <div class="mt-2 text-5xl font-extrabold leading-none tracking-tighter">
        {{ $product->speed_mbps }}<span class="ml-1 text-base font-bold tracking-normal {{ $dark ? 'text-sky-300' : 'text-sea-700' }}">Mbps</span>
    </div>

    <span class="mx-auto mt-3 rounded-full px-3 py-1 text-xs font-semibold {{ $dark ? 'bg-white/15 text-white' : 'bg-white/60 text-sea-700' }}">{{ $product->category_label }}</span>

    <h3 class="mt-3 text-base font-extrabold {{ $dark ? 'text-white' : 'text-sea-900' }}">{{ $product->name }}</h3>
    <p class="mt-1 text-lg font-extrabold">{{ $product->price_rupiah }}<small class="text-xs font-semibold {{ $dark ? 'text-white/70' : 'text-sea-700/70' }}">/bulan</small></p>
    <p class="mt-2 grow text-sm {{ $dark ? 'text-white/75' : 'text-sea-800/80' }}">{{ $product->summary }}</p>

    <button type="button" data-modal-open="detail-{{ $product->id }}"
            class="btn mt-4 w-full {{ $dark ? 'bg-white text-sea-900 hover:bg-sky-100' : 'bg-sea-700 text-white hover:bg-sea-900' }}">
        Lihat Detail <i class="bi bi-arrow-right"></i>
    </button>
</div>
