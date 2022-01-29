<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JenisSuratRequest extends FormRequest
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
            'jenis_surat' => 'required|max:191'
        ];
    }

        public function messages()
    {
        return [
            'jenis_surat.required' => 'Jenis surat harus diisi.',
            'jenis_surat.max' => 'Maksimal jumlah karakter 191.'
        ];
    }
}
