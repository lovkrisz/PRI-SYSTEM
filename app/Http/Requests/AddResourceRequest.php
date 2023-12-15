<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|regex:/^([A-Za-z0-9aáeéiíoóöőuúüűAÁEÉIÍOÓÖŐUÚÜŰ _-]*)$/",
            "color" => "nullable",
            "capacity" => "nullable|integer",
            "quantity" => "required|regex:/^([0-9]*)$/",
            "barcode" => "required",
            "usablebyprinters" => "nullable",
            "amount_to_operate" => "nullable|integer",
        ];
    }
}
