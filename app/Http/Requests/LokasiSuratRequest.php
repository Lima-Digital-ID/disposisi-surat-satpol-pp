<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LokasiSuratRequest extends FormRequest
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
            'lokasi' => 'required|max:191'
        ];
    }

        public function messages()
    {
        return [
            'lokasi.required' => 'Lokasi surat harus diisi.',
            'lokasi.max' => 'Maksimal jumlah karakter 191.'
        ];
    }
}
