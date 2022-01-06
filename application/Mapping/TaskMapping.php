<?php

return [
    'id' => [
        'column' => 'TaskID'
    ],
    'customerID' => [],
    'taskNo' => [
        'validation' => [
            'required',
            'unique'
        ]
    ],
    'name' => [
        'validation' => [
            'required',
            'size' => ['max' => 30]
        ]
    ]
];