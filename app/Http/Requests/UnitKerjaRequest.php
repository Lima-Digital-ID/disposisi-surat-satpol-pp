<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UnitKerjaRequest extends FormRequest
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
            'kode' => 'required|max:30',
            'unit_kerja' => 'required|max:30',
        ];
    }

    public function messages()
    {
        return [
            'kode.required' => 'Kode harus diisi.',
            'kode.max' => 'Maksimal jumlah karakter 100.',
            'unit_kerja.required' => 'Unit Kerja harus diisi.',
            'unit_kerja.max' => 'Maksimal jumlah karakter 100.'
        ];
    }
}
