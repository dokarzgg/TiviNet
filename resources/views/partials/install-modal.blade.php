{{-- Popup formulir "Pasang WiFi Baru" + popup sukses. Daftar paket ($packages) dikirim oleh AppServiceProvider. --}}
@php($err = $errors->install)
<dialog id="installModal" class="modal" aria-labelledby="installTitle" data-open-on-load="{{ $err->any() ? '1' : '0' }}">
    <form method="POST" action="{{ route('install.store') }}" novalidate class="flex min-h-0 flex-1 flex-col">
        @csrf
        <div class="modal-hero">
            <button type="button" data-modal-close aria-label="Tutup" class="absolute right-3 top-3 rounded-full p-1.5 text-lg text-white/80 hover:bg-white/15"><i class="bi bi-x-lg"></i></button>
            <span class="eyebrow !text-sky-300">Pendaftaran</span>
            <h2 id="installTitle" class="!text-white text-xl">Pasang WiFi Baru</h2>
            <p class="mt-1 text-sm text-white/70">Isi data berikut, tim kami akan menghubungi Anda via WhatsApp.</p>
        </div>

        <div class="min-h-0 flex-1 space-y-4 overflow-y-auto p-6">
            @if ($err->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm text-red-700" role="alert">Mohon periksa kembali isian Anda.</div>
            @endif

            <div>
                <label for="inst_product" class="label">Pilih paket <span class="text-red-500">*</span></label>
                <select id="inst_product" name="product_id" required class="field {{ $err->has('product_id') ? 'field-error' : '' }}">
                    <option value="">— Pilih paket —</option>
                    @foreach ($packages as $pkg)
                        <option value="{{ $pkg->id }}" @selected(old('product_id') == $pkg->id)>
                            {{ $pkg->name }} — {{ $pkg->speed_mbps }} Mbps (Rp {{ number_format($pkg->price, 0, ',', '.') }}/bln)
                        </option>
                    @endforeach
                </select>
                @if ($err->has('product_id')) <p class="error-text">{{ $err->first('product_id') }}</p> @endif
            </div>

            <div>
                <label for="inst_name" class="label">Nama lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="inst_name" name="name" value="{{ old('name') }}" required class="field {{ $err->has('name') ? 'field-error' : '' }}">
                @if ($err->has('name')) <p class="error-text">{{ $err->first('name') }}</p> @endif
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="inst_phone" class="label">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <input type="tel" id="inst_phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required class="field {{ $err->has('phone') ? 'field-error' : '' }}">
                    @if ($err->has('phone')) <p class="error-text">{{ $err->first('phone') }}</p> @endif
                </div>
                <div>
                    <label for="inst_email" class="label">Email <span class="font-normal text-slate-400">(opsional)</span></label>
                    <input type="email" id="inst_email" name="email" value="{{ old('email') }}" class="field {{ $err->has('email') ? 'field-error' : '' }}">
                    @if ($err->has('email')) <p class="error-text">{{ $err->first('email') }}</p> @endif
                </div>
            </div>

            <div>
                <label for="inst_address" class="label">Alamat pemasangan <span class="text-red-500">*</span></label>
                <textarea id="inst_address" name="address" rows="3" required placeholder="Jalan, nomor rumah, RT/RW, kelurahan, kecamatan" class="field {{ $err->has('address') ? 'field-error' : '' }}">{{ old('address') }}</textarea>
                @if ($err->has('address')) <p class="error-text">{{ $err->first('address') }}</p> @endif
            </div>

            <div>
                <label for="inst_notes" class="label">Catatan <span class="font-normal text-slate-400">(opsional)</span></label>
                <textarea id="inst_notes" name="notes" rows="2" placeholder="Misal: patokan lokasi atau jam yang cocok untuk survei" class="field {{ $err->has('notes') ? 'field-error' : '' }}">{{ old('notes') }}</textarea>
                @if ($err->has('notes')) <p class="error-text">{{ $err->first('notes') }}</p> @endif
            </div>
        </div>

        <div class="grid gap-2 border-t border-sky-100 p-5">
            <button type="submit" class="btn btn-primary btn-lg w-full"><i class="bi bi-send"></i> Kirim Pendaftaran</button>
            <button type="button" class="btn btn-ghost" data-modal-close>Batal</button>
        </div>
    </form>
</dialog>

{{-- Popup sukses --}}
@if (session('install_success'))
    <dialog id="successModal" class="modal" aria-labelledby="successTitle" data-open-on-load="1">
        <div class="p-8 text-center">
            <span class="icon-tile mx-auto mb-4 !size-20 !text-4xl"><i class="bi bi-check2-circle"></i></span>
            <h2 id="successTitle" class="text-xl">Pendaftaran terkirim!</h2>
            <p class="muted mb-5 mt-2 text-sm">{{ session('install_success') }}</p>
            <div class="grid gap-2">
                <a class="btn btn-wa" target="_blank" rel="noopener"
                   href="https://wa.me/{{ config('company.whatsapp') }}?text={{ rawurlencode('Halo ' . config('company.short_name') . ', saya baru saja mendaftar pasang WiFi baru lewat website.') }}">
                    <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                </a>
                <button type="button" class="btn btn-outline" data-modal-close>Tutup</button>
            </div>
        </div>
    </dialog>
@endif
