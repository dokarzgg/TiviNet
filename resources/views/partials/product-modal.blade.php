{{-- Popup detail paket. Param: $product. Tombol "Pasang Sekarang" -> langsung buka formulir pendaftaran. --}}
@php($g = $product->card_gradient)
<dialog id="detail-{{ $product->id }}" class="modal" aria-labelledby="detail-title-{{ $product->id }}">
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="relative px-6 py-6 text-white" style="{{ $g['style'] }}">
            <button type="button" data-modal-close aria-label="Tutup"
                    class="absolute right-3 top-3 rounded-full p-1.5 text-lg {{ $g['dark'] ? 'text-white/80 hover:bg-white/15' : 'text-sea-900/70 hover:bg-black/5' }}">
                <i class="bi bi-x-lg"></i>
            </button>
            <span class="mb-2 inline-block rounded-full px-3 py-1 text-xs font-semibold {{ $g['dark'] ? 'bg-white/15 text-white' : 'bg-white/60 text-sea-700' }}">{{ $product->category_label }}</span>
            <h2 id="detail-title-{{ $product->id }}" class="text-xl {{ $g['dark'] ? '!text-white' : '' }}">{{ $product->name }}</h2>
            <div class="text-5xl font-extrabold leading-tight tracking-tighter {{ $g['dark'] ? 'text-white' : 'text-sea-900' }}">
                {{ $product->speed_mbps }}<span class="ml-1 text-lg font-bold tracking-normal {{ $g['dark'] ? 'text-sky-300' : 'text-sea-700' }}">Mbps</span>
            </div>
        </div>

        <div class="min-h-0 flex-1 overflow-y-auto p-6">
            <p class="mb-4 text-2xl font-extrabold text-sea-700">{{ $product->price_rupiah }}<small class="text-sm font-semibold text-slate-500">/bulan</small></p>

            <h3 class="mb-1 text-sm">Deskripsi</h3>
            <p class="muted mb-4 text-sm leading-relaxed">{{ $product->description }}</p>

            @if (! empty($product->features))
                <h3 class="mb-2 text-sm">Yang Anda dapatkan</h3>
                <ul class="grid gap-2 text-sm">
                    @foreach ($product->features as $feature)
                        <li class="flex gap-2"><i class="bi bi-check-circle-fill text-sky-500"></i><span>{{ $feature }}</span></li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="grid gap-2 border-t border-sky-100 p-5">
            <button type="button" class="btn btn-primary btn-lg w-full" data-modal-open="installModal" data-product-id="{{ $product->id }}">
                <i class="bi bi-wifi"></i> Pasang Sekarang
            </button>
            <button type="button" class="btn btn-ghost" data-modal-close>Tutup</button>
        </div>
    </div>
</dialog>
