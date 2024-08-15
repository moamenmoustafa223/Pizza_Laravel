<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PizzaOrderRequest extends FormRequest
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
            'phone' => 'required|digits_between:10,15', 
            'small_pizza' => 'required|integer|min:0', 
            'medium_pizza' => 'required|integer|min:0',
            'large_pizza' => 'required|integer|min:0',
            'pizza_id' => 'required|exists:pizzas,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'body' => 'required|string|max:500', 
            //
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (
                $this->small_pizza == 0 &&
                $this->medium_pizza == 0 &&
                $this->large_pizza == 0
            ) {
                $validator->errors()->add('pizza_quantity', 'Please order at least one pizza with a quantity greater than 0.');
            }
        });
    }
}
