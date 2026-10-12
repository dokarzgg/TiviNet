import './bootstrap';
import '@fontsource-variable/plus-jakarta-sans';
import 'bootstrap-icons/font/bootstrap-icons.min.css';

document.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;

    /* ---------- Popup (<dialog>) ---------- */
    const openDialog = (dlg) => {
        // Hanya satu popup terbuka: tutup yang lain dulu.
        document.querySelectorAll('dialog[open]').forEach((d) => d !== dlg && d.close());
        if (!dlg.open) dlg.showModal();
        root.classList.add('overflow-hidden');
    };

    // Kunci scroll halaman selama ada popup terbuka.
    document.addEventListener('close', () => {
        if (!document.querySelector('dialog[open]')) root.classList.remove('overflow-hidden');
    }, true);

    document.addEventListener('click', (e) => {
        // Buka popup: <button data-modal-open="idPopup" [data-product-id="3"]>
        const opener = e.target.closest('[data-modal-open]');
        if (opener) {
            const dlg = document.getElementById(opener.dataset.modalOpen);
            if (dlg) {
                // Pilih paket otomatis di formulir pendaftaran.
                if (opener.dataset.productId) {
                    const select = dlg.querySelector('select[name="product_id"]');
                    if (select) select.value = opener.dataset.productId;
                }
                openDialog(dlg);
            }
            return;
        }

        // Tutup popup: tombol [data-modal-close] atau klik area gelap di luar kotak popup.
        if (e.target.closest('[data-modal-close]')) {
            e.target.closest('dialog')?.close();
            return;
        }
        if (e.target instanceof HTMLDialogElement) e.target.close();
    });

    // Buka otomatis (validasi gagal / pendaftaran sukses).
    document.querySelectorAll('dialog[data-open-on-load="1"]').forEach(openDialog);

    /* ---------- Menu mobile ---------- */
    const navBtn = document.getElementById('navToggle');
    const nav = document.getElementById('mainNav');
    navBtn?.addEventListener('click', () => {
        const open = nav.classList.toggle('hidden') === false;
        navBtn.setAttribute('aria-expanded', String(open));
    });

    /* ---------- Tombol WhatsApp mengambang ---------- */
    const fab = document.getElementById('waFab');
    const popup = document.getElementById('waPopup');
    if (fab && popup) {
        const toggle = (open) => {
            popup.hidden = !open;
            fab.setAttribute('aria-expanded', String(open));
        };
        fab.addEventListener('click', () => toggle(popup.hidden));
        document.getElementById('waClose')?.addEventListener('click', () => toggle(false));
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') toggle(false); });
    }
});
