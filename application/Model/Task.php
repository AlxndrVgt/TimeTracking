<?php

namespace Application\Model;

use Avolutions\Orm\Entity;

class Task extends Entity
{
    public int $customerID;
    public string $taskNo = '';
    public string $name = '';
}