{{-- Tombol WhatsApp mengambang: klik -> popup -> buka WhatsApp --}}
@php($waLink = 'https://wa.me/' . config('company.whatsapp') . '?text=' . rawurlencode('Halo ' . config('company.short_name') . ', saya ingin bertanya tentang paket WiFi.'))
<div class="fixed bottom-4 right-4 z-50 flex flex-col items-end gap-3" id="waWidget">
    <div id="waPopup" role="dialog" aria-label="Chat WhatsApp" hidden
         class="w-[min(21rem,calc(100vw-2rem))] animate-pop-in overflow-hidden rounded-2xl border border-sky-100 bg-white shadow-2xl shadow-sea-900/40 [&[hidden]]:hidden">
        <div class="flex items-center gap-3 bg-linear-to-br from-sea-900 to-sea-700 px-4 py-3.5 text-white">
            <span class="inline-flex size-10 items-center justify-center rounded-full bg-white/20 text-lg"><i class="bi bi-wifi"></i></span>
            <div class="leading-tight">
                <strong>{{ config('company.name') }}</strong>
                <small class="block text-white/75"><span class="mr-1 inline-block size-2 rounded-full bg-[#25d366]"></span>Biasanya membalas cepat</small>
            </div>
            <button type="button" id="waClose" aria-label="Tutup" class="ml-auto text-white/80 hover:text-white"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="bg-cloud-2 p-4">
            <div class="rounded-2xl rounded-tl-sm bg-white px-3.5 py-3 text-sm shadow-sm">
                Halo! 👋<br>Ada yang bisa kami bantu soal paket WiFi atau pemasangan baru?
            </div>
            <p class="mt-2 text-xs text-slate-500">{{ config('company.hours') }}</p>
        </div>
        <div class="p-4 pt-3">
            <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-wa w-full">
                <i class="bi bi-whatsapp"></i> Mulai Chat · {{ config('company.whatsapp_display') }}
            </a>
        </div>
    </div>

    <button type="button" id="waFab" aria-label="Chat WhatsApp" aria-expanded="false" aria-controls="waPopup"
            class="inline-flex size-15 animate-pulse-ring items-center justify-center rounded-full bg-[#25d366] text-3xl text-white transition hover:scale-105 motion-reduce:animate-none">
        <i class="bi bi-whatsapp"></i>
    </button>
</div>
