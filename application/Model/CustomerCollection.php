<?php

namespace Application\Model;

use Avolutions\Orm\EntityCollection;

class CustomerCollection extends EntityCollection
{
    protected string $entity = 'Customer';
}