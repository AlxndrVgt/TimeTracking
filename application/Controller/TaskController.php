<?php

namespace Application\Controller;

use Application\Model\Task;
use Application\Model\TaskCollection;

class TaskController extends ApiController
{
    public function __construct(TaskCollection $taskCollection)
    {
        parent::__construct($taskCollection, Task::class);
    }

    public function indexAction(int $customer = null): bool|string
    {
        if ($customer !== null) {
            $entities = $this->EntityCollection->where('CustomerID = ' . $customer)->getAll();

            return json_encode($entities, JSON_PRETTY_PRINT);
        } else {
            return parent::indexAction();
        }
    }
}