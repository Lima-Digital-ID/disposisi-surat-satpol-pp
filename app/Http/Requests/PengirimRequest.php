<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengirimRequest extends FormRequest
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
            'pengirim' => 'required|max:191'
        ];
    }

    public function messages()
    {
        return [
            'pengirim.required' => 'Pengirim surat harus diisi.',
            'pengirim.max' => 'Maksimal jumlah karakter 191.'
        ];
    }
}
