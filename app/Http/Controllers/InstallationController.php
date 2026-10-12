<?php

namespace App\Http\Controllers;

use App\Models\InstallationRequest;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    /**
     * Menyimpan formulir "Pasang WiFi Baru" dari popup.
     */
    public function store(Request $request)
    {
        // Rapikan nomor HP: buang spasi, titik, dan strip.
        $request->merge(['phone' => preg_replace('/[\s.\-]/', '', (string) $request->input('phone'))]);

        $data = $request->validateWithBag(
            'install',
            [
                'product_id' => ['required', 'exists:products,id'],
                'name'       => ['required', 'string', 'max:100'],
                'phone'      => ['required', 'regex:/^(\+62|62|0)8[0-9]{7,12}$/'],
                'email'      => ['nullable', 'email', 'max:150'],
                'address'    => ['required', 'string', 'min:10', 'max:500'],
                'notes'      => ['nullable', 'string', 'max:500'],
            ],
            [
                'required' => ':attribute wajib diisi.',
                'exists'   => ':attribute tidak valid.',
                'email'    => 'Format :attribute tidak valid.',
                'regex'    => 'Format :attribute tidak valid (contoh: 081234567890).',
                'max'      => ':attribute terlalu panjang (maksimal :max karakter).',
                'min'      => ':attribute terlalu pendek (minimal :min karakter).',
            ],
            [
                'product_id' => 'Paket',
                'name'       => 'Nama lengkap',
                'phone'      => 'Nomor WhatsApp',
                'email'      => 'Email',
                'address'    => 'Alamat pemasangan',
                'notes'      => 'Catatan',
            ]
        );

        InstallationRequest::create($data);

        return back()->with('install_success', 'Terima kasih, pendaftaran Anda sudah kami terima. Tim kami akan menghubungi Anda via WhatsApp untuk survei lokasi dan jadwal pemasangan.');
    }
}
