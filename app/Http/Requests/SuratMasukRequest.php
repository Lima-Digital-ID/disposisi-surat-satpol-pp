<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SuratMasukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_surat' => 'required|max:191',
            'no_agenda' => 'required|max:191',
            'sifat_surat' => 'required',
            'pengirim' => 'required',
            // 'id_penerima' => 'required',
            'tgl_pengirim' => 'required',
            'tgl_penerima' => 'required',
            'perihal' => 'required',
            'file_surat' => 'required|max:2048',
            // 'file_surat' => 'required|jpg,png,jpeg,pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'no_surat.required' => 'No surat harus diisi.',
            'no_surat.max' => 'Maksimal jumlah karakter 191.',
            'sifat_surat.required' => 'Sifat surat harus diisi.',
            'pengirim.required' => 'Pengirim harus diisi.',
            'id_penerima.required' => 'Penerima harus diisi.',
            'tgl_pengirim.required' => 'Tanggal Pengirim harus diisi.',
            'tgl_penerima.required' => 'Tanggal Penerima harus diisi.',
            'perihal.required' => 'Perihal harus diisi.',
            'file_surat.required' => 'File surat harus diunggah.',
        ];
    }
}
