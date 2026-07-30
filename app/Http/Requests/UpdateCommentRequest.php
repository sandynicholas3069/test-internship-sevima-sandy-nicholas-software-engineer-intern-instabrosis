<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya pembuat komentar yang boleh mengedit
        return $this->user()->id === $this->route('comment')->user_id;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Komentar tidak boleh kosong.',
            'content.max' => 'Komentar maksimal 500 karakter.',
        ];
    }
}