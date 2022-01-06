<?php

return [
    'id' => [
        'column' => 'CustomerID'
    ],
    'customerNo' => [
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