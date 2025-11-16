<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nama_pegawai' => ['required', 'string', 'max:60'],
            'username'     => ['required', 'string', 'max:25'],
        ];
    }
}
