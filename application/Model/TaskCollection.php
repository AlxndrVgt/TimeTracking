<?php

namespace Application\Model;

use Avolutions\Orm\EntityCollection;

class TaskCollection extends EntityCollection
{
    protected string $entity = 'Task';
}