@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi halaman" class="flex flex-wrap items-center justify-center gap-2 text-sm font-semibold">
        {{-- Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="rounded-xl border border-sky-100 bg-white px-4 py-2 text-slate-300">Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="rounded-xl border border-sky-200 bg-white px-4 py-2 text-sea-700 transition hover:bg-sea-700 hover:text-white">Sebelumnya</a>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-slate-400">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="rounded-xl bg-sea-700 px-4 py-2 text-white shadow">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" aria-label="Ke halaman {{ $page }}" class="rounded-xl border border-sky-200 bg-white px-4 py-2 text-sea-700 transition hover:bg-sky-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Berikutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="rounded-xl border border-sea-700 bg-sea-700 px-4 py-2 text-white transition hover:bg-sea-900">Berikutnya</a>
        @else
            <span class="rounded-xl border border-sky-100 bg-white px-4 py-2 text-slate-300">Berikutnya</span>
        @endif
    </nav>
@endif
