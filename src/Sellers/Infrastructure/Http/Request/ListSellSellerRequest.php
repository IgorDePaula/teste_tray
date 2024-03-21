<?php

namespace Tray\Sellers\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Infrastructure\Http\Request\RequestInterface;
use Tray\Sellers\Application\Dto\ListSellsSellerDto;

class ListSellSellerRequest extends FormRequest implements RequestInterface
{

    public function toDto(): AbstractDto
    {
        return new ListSellsSellerDto(...['sellerId' => $this->validated()['id']]);
    }

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
            'id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'sellerId is required',
            'id.integer' => 'sellerId must be an integer'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('sellerId')]);
    }
}
