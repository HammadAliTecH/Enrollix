<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StudentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        return [
            // Personal Information
            'name'               => ['required', 'string', 'max:255'],
            'gender'             => ['required', Rule::in(['MALE', 'FEMALE'])],
            'age'                => ['required', 'integer', 'min:1', 'max:100'],
            'cnic_number'        => ['required', 'digits:13', 'unique:students,cnic_number'],
            'cnic_document'      => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'], // CNIC attachment
            'image'              => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'father_name'        => ['required', 'string', 'max:255'],
            'father_cnic'        => ['required', 'digits:13'],
            'father_occupation'  => ['required', 'string', 'max:255'],

            // Contact Information
            'contact_number'     => ['required', 'string', 'max:20'],
            'father_cell_number' => ['required', 'string', 'max:20'],
            'email'              => ['required', 'email', 'unique:students,email'],
            'address'            => ['required', 'string'],

            // Education Detail
            'recent_education'  => ['required', Rule::in([
                '8TH', 'MATRIC (PART-I)', 'MATRIC (PART-II)',
                'INTERMEDIATE (PART-I)', 'INTERMEDIATE (PART-II)',
            ])],
            'marks'               => ['required', 'string', 'max:20'],
            'enrolled_program'    => ['required', Rule::in([
                '8TH', 'MATRIC (PART-I)', 'MATRIC (PART-II)',
                'INTERMEDIATE (PART-I)', 'INTERMEDIATE (PART-II)',
            ])],
            'educational_place'   => ['required', 'string', 'max:255'],
            'additional_document' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'cnic_number.digits' => 'CNIC number 13 digits ka hona chahiye (bina dashes).',
            'father_cnic.digits' => 'Father CNIC 13 digits ka hona chahiye (bina dashes).',
        ];
    }
}