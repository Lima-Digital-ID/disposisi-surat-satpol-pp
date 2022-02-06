<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class DisposisiRequest extends FormRequest
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
            'sifat_surat' => 'required',
            'id_pengirim' => 'required',
            'id_penerima' => 'required',
            'tgl_disposisi' => 'required',
            'catatan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sifat_surat.required' => 'Sifat Surat harus diisi.',
            'id_pengirim.required' => 'Pengirim harus diisi.',
            'id_penerima.required' => 'Penerima harus diisi.',
            'tgl_disposisi.required' => 'Tanggal Disposisi harus diisi.',
            'catatan.required' => 'Catatan harus diisi.',
        ];
    }
}
