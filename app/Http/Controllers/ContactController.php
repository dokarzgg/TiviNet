<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name'    => ['required', 'string', 'max:100'],
                'email'   => ['required', 'email', 'max:150'],
                'phone'   => ['nullable', 'string', 'max:30'],
                'subject' => ['required', 'string', 'max:150'],
                'message' => ['required', 'string', 'min:10', 'max:3000'],
            ],
            [
                'required' => ':attribute wajib diisi.',
                'email'    => 'Format :attribute tidak valid.',
                'max'      => ':attribute terlalu panjang (maksimal :max karakter).',
                'min'      => ':attribute terlalu pendek (minimal :min karakter).',
            ],
            [
                'name'    => 'Nama',
                'email'   => 'Email',
                'phone'   => 'Nomor telepon',
                'subject' => 'Subjek',
                'message' => 'Pesan',
            ]
        );

        ContactMessage::create($data);

        return redirect()
            ->route('contact')
            ->with('success', 'Terima kasih, pesan Anda sudah kami terima. Tim kami akan menghubungi Anda secepatnya.');
    }
}
