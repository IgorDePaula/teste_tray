<?php

namespace Tray\Sellers\Domain\Director;

use Tray\Core\Domain\Director\DirectorInterface;
use Tray\Core\Domain\Entity\EntityInterface;
use Tray\Sellers\Domain\Builder\SellerBuilder;

class SellerDirector implements DirectorInterface
{

    public function make(array $data): EntityInterface
    {
        $methods = [
            'id' => 'withId',
            'name' => 'withName',
            'email' => 'withEmail',
            'commission' => 'withCommission',
        ];

        $builder = new SellerBuilder();
        foreach ($methods as $key => $method) {
            if (isset($data[$key])) {
                $builder->{$method}($data[$key]);
            }
        }
        return $builder->build();
    }
}
