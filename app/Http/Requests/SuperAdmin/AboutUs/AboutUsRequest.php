<?php

namespace App\Http\Requests\SuperAdmin\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'services_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'service_1_desc' => 'nullable|string',
            'service_2_desc' => 'nullable|string',
            'service_3_desc' => 'nullable|string',
            'packages_numbers_desc' => 'nullable|string',
            'packages_numbers_number' => 'nullable|integer',
            'clients_numbers_desc' => 'nullable|string',
            'clients_numbers_number' => 'nullable|integer',
            'apps_numbers_desc' => 'nullable|string',
            'apps_numbers_number' => 'nullable|integer',
            'info_1' => 'nullable|string',
            'info_2' => 'nullable|string',
            'completeness' => 'nullable|string',
            'control' => 'nullable|string',
            'proficiency' => 'nullable|string',
        ];
    }
}
