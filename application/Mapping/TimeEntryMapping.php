<?php

return [
    'id' => [
        'column' => 'TimeEntryID'
    ],
    'customerID' => [
        'validation' => [
            'required'
        ]
    ],
    'Customer' => [
        'column' => 'customerID',
        'type' => 'Customer'
    ],
    'taskID' => [
        'validation' => [
            'required'
        ]
    ],
    'Task' => [
        'column' => 'taskID',
        'type' => 'Task'
    ],
    'duration' => [
        'validation' => [
            'required',
            'size' => ['min' => 1, 'max' => 86400]
        ]
    ],
    'date' => [
        'validation' => [
            'required',
            'datetime' => ['type' => 'date']
        ]
    ],
    'description' => [
        'validation' => [
            'required',
            'size' => ['min' => 10, 'max' => 255]
        ]
    ]
];