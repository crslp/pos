<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'all' => ['nullable', 'required_if:items,null', 'accepted_if:items,null'],
            'items' => ['nullable', 'required_if:all,null', 'array'],
            'items.*.id' => ['required_if:all,null', 'integer', 'exists:order_items,id'],
        ];
    }
}
