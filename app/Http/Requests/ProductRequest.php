<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:5,1000'],
            'stock' => ['required', 'min:1', 'max:100'],
            'image' => ['required', 'image', 'max:2048'],
        ];

        // remove required role and add nullable
        if (Route::current()->getActionMethod() === 'update') {
            $rules = array_map(function ($rule) {
                $rule = array_filter($rule, function ($item) {
                    return $item !== 'required';
                });
                array_unshift($rule, 'nullable');
                return $rule;
            }, $rules);

        }

        return $rules;
    }
}
