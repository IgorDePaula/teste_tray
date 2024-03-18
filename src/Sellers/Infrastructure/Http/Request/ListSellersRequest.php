<?php

namespace Tray\Sellers\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Tray\Core\Application\AbstractDto;
use Tray\Core\Infrastructure\Http\Request\RequestInterface;
use Tray\Sellers\Application\Dto\ListSellerDto;

class ListSellersRequest extends FormRequest implements RequestInterface
{
    public function toDto(): AbstractDto
    {
        return new ListSellerDto();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
