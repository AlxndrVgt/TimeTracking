<?php

namespace Application\Model;

use Avolutions\Orm\Entity;

class TimeEntry extends Entity
{
    public int $customerID;
    public Customer $Customer;
    public int $taskID;
    public Task $Task;
    public int $duration;
    public string $date = '';
    public string $description = '';
}