<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPrinterRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            "name" => "required|regex:/^^([A-Za-z0-9aáeéiíoóöőuúüűAÁEÉIÍOÓÖŐUÚÜŰ _-]*)$/",
            "ip_addr" => "required|regex:/^([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})$/",
            "type" => "required|regex:/^([A-Za-z0-9aáeéiíoóöőuúüűAÁEÉIÍOÓÖŐUÚÜŰ _-]*)$/",
            "brand" => "required|regex:/^([A-Za-z0-9aáeéiíoóöőuúüűAÁEÉIÍOÓÖŐUÚÜŰ _-]*)$/",
            "location" => "required",
        ];
    }
}
