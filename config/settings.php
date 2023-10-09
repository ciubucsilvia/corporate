<?php
    return [
        'paginate'  => 20,
        'home_portfolio_count' => 3,
        'home_sliders_count'    => 12,
        'other_projects' => 12,
        // 'roles-per-page' => 20,
        // 'permissions-per-page' => 20,
        // 'users-per-page' => 20,
        'sliders' => [
            'image' => [
                'max' => [
                    'width'  => 1200,
                    'height' => 400
                ],
                'mini' => [
                    'width'  => 24,
                    'height' => 24
                ]
            ],
        ],
        'portfolio' => [
            // 'home_portfolio_count' => 8,
            // 'portfolio_per_page_admin' => 5,
            'image' => [
                'mini' => [
                    'width'  => 175,
                    'height' => 175
                ],
                'max' => [
                    'width'  => 700,
                    'height' => 345
                ]
            ],    
        ],
        'portfolio_categories' => [
            // 'categories_per_page' => 20
        ]
    ];
?>