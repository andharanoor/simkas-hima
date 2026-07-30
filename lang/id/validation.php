<?php

return [

    'required' => ':attribute wajib diisi.',
    'unique' => ':attribute sudah digunakan.',
    'min' => [
        'string' => ':attribute minimal :min karakter.',
    ],
    'max' => [
        'string' => ':attribute maksimal :max karakter.',
    ],
    'confirmed' => 'Konfirmasi :attribute tidak sesuai.',
    'email' => 'Format email tidak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'date' => ':attribute harus berupa tanggal yang valid.',
    'before_or_equal' => ':attribute tidak boleh melebihi hari ini.',

    'attributes' => [
        'nama'      => 'Nama',
        'username'  => 'Username',
        'password'  => 'Password',
        'nim'       => 'NIM',
        'jurusan'   => 'Jurusan',
        'status'    => 'Status',
        'tanggal'   => 'Tanggal',
        'sumber'    => 'Sumber',
        'jumlah'    => 'Jumlah',
        'keterangan'=> 'Keterangan',
        'bukti'     => 'Bukti',
        'kategori' => 'Kategori',
        'no_hp'     => 'Nomor HP',
    ],
];