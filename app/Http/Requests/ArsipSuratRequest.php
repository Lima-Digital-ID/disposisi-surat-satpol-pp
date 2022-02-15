<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArsipSuratRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis' => 'not_in:0',
            'surat' => 'not_in:0',
            'lokasi' => 'not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'jenis.not_in' => 'Jenis harus dipilih.',
            'surat.not_in' => 'Surat harus dipilih.',
            'lokasi.not_in' => 'Lokasi surat harus dipilih.',
        ];
    }
}
