<?php

namespace App\Http\Requests\Seller;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->seller->id === $this->product->seller_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'max:255',
            'description' => 'min:5',
            'quantity' => 'integer|min:1',
            'status' => "in" . Product::AVAILABLE_PRODUCT . "," . Product::UNAVAILABLE_PRODUCT,
            'image' => 'image'
        ];
    }
}
