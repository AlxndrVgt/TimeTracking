<?php

namespace Application\Controller;

use Application\Model\TimeEntry;
use Application\Model\TimeEntryCollection;

class TimeEntryController extends ApiController
{
    public function __construct(TimeEntryCollection $timeEntryCollection)
    {
        parent::__construct($timeEntryCollection, TimeEntry::class);
    }
}