<?php

namespace Tray\Sellers\Domain\Director;

use Tray\Core\Domain\Director\DirectorInterface;
use Tray\Core\Domain\Entity\EntityInterface;
use Tray\Sellers\Domain\Builder\ListSellSellerBuilder;

class ListSellSellerDirector implements DirectorInterface
{

    public function make(array $data): EntityInterface
    {
        $methods = [
            'id' => 'withId',
            'name' => 'withName',
            'email' => 'withEmail',
            'commission' => 'withCommission',
            'amount' => 'withAmount',
            'soldAt' => 'withSoldAt',
        ];

        $builder = new ListSellSellerBuilder();
        foreach ($methods as $key => $method) {
            if (isset($data[$key])) {
                $builder->{$method}($data[$key]);
            }
        }
        return $builder->build();
    }
}
