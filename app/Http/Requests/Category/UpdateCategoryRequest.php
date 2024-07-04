<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        // is->category->id is concatenating the current category's ID to the rule, which typically allows the current category to be excluded from the uniqueness check. This is useful when updating an existing category to prevent it from failing the uniqueness check against itself.

        return [
            //
            'name' => 'max:255|unique:categories,name,' . $this->category->id,
            'description' => 'max:1000'


        ];
    }
}
