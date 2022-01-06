<?php

namespace Application\Controller;

use Application\Model\CustomerCollection;

class CustomerController extends ApiController
{
    public function __construct(CustomerCollection $customerCollection)
    {
        parent::__construct($customerCollection, Customer::class);
    }
}