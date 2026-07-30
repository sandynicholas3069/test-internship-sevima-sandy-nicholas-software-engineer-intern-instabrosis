<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya pemilik post yang boleh mengedit
        return $this->user()->id === $this->route('post')->user_id;
    }

    public function rules(): array
    {
        return [
            // Saat update, gambar opsional (bisa hanya ganti caption)
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:1000'],
        ];
    }
}