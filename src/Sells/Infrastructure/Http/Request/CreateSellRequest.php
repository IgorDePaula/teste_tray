<?php

namespace Tray\Sells\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Infrastructure\Http\Request\RequestInterface;
use Tray\Sells\Application\Dto\CreateSellDto;

class CreateSellRequest extends FormRequest implements RequestInterface
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
            'seller' => 'required|integer',
            'amount' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'seller.required' => 'Seller is required',
            'seller.integer' => 'Seller must be an integer',
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be numeric/float',
        ];
    }

    public function toDto(): AbstractDto
    {
        return new CreateSellDto(...$this->validated());
    }
}
