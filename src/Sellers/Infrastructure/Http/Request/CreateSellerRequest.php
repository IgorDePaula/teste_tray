<?php

namespace Tray\Sellers\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Infrastructure\Http\Request\RequestInterface;
use Tray\Sellers\Application\Dto\SellerDto;

class CreateSellerRequest extends FormRequest implements RequestInterface
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
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:sellers',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email must be unique',
        ];
    }

    public function toDto(): AbstractDto
    {
        return new SellerDto(...$this->validated());
    }
}
