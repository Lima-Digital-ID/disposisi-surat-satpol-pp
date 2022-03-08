<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenerimaRequest extends FormRequest
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
            'penerima' => 'required|max:191'
        ];
    }

        public function messages()
    {
        return [
            'penerima.required' => 'Penerima surat harus diisi.',
            'penerima.max' => 'Maksimal jumlah karakter 191.'
        ];
    }
}
