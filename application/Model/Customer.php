<?php

namespace Application\Model;

use Avolutions\Orm\Entity;

class Customer extends Entity
{
    public int $customerNo;
    public string $name = '';
}