<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
       $studentId = $this->route('student');

     return [
            // Personal Information
            'name'              => ['sometimes', 'string', 'max:255'],
            'gender'            => ['sometimes', Rule::in(['MALE', 'FEMALE'])],
            'age'               => ['sometimes', 'integer', 'min:1', 'max:100'],
            'cnic_number'       => [
                'sometimes',
                'digits:13',
                Rule::unique('students', 'cnic_number')->ignore($studentId),
            ],
            'cnic_document'    => ['sometimes', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'image'             => ['sometimes', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'father_name'       => ['sometimes', 'string', 'max:255'],
            'father_cnic'       => ['sometimes', 'digits:13'],
            'father_occupation' => ['sometimes', 'string', 'max:255'],

            // Contact Information
            'contact_number'     => ['sometimes', 'string', 'max:20'],
            'father_cell_number' => ['sometimes', 'string', 'max:20'],
            'email'              => [
                'sometimes',
                'email',
                Rule::unique('students', 'email')->ignore($studentId),
            ],
            'address' => ['sometimes', 'string'],

            // Education Detail
            'recent_education' => ['sometimes', Rule::in([
                '8TH',
                'MATRIC (PART-I)',
                'MATRIC (PART-II)',
                'INTERMEDIATE (PART-I)',
                'INTERMEDIATE (PART-II)',
            ])],

            'marks' => ['sometimes', 'string', 'max:20'],

            'enrolled_program' => ['sometimes', Rule::in([
                '8TH',
                'MATRIC (PART-I)',
                'MATRIC (PART-II)',
                'INTERMEDIATE (PART-I)',
                'INTERMEDIATE (PART-II)',
            ])],

            'educational_place' => ['sometimes', 'string', 'max:255'],

            'additional_document' => [
                'sometimes',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
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