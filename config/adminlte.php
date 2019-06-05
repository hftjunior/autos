<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Autos',

    'title_prefix' => 'Autos :: ',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'Autos',

    'logo_mini' => 'AT',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => 'fixed',

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */
    /*
    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Pages',
            'url'         => 'admin/pages',
            'icon'        => 'file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url'  => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url'  => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text'       => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],
    ],
    */
    'menu' => [
        'CADASTROS',
        [
            'text' => 'Blog',
            'url'  => '#',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Cadastros',
            'url'         => '#',
            'icon'        => 'book',
            'submenu'     => [
                [
                    'text'        => 'Perfis',
                    'url'         => 'admin/roles',
                    'can'         => 'view_role'
                ],
                [
                    'text'        => 'Usuários',
                    'url'         => 'admin/users',
                    'can'         => 'view_user'
                ],
                [
                    'text'        => 'Estados',
                    'url'         => 'admin/states',
                    'can'         => 'view_state'
                ],
                [
                    'text'        => 'Cidades',
                    'url'         => 'admin/cities',
                    'can'         => 'view_city'
                ],
                [
                    'text'        => 'Clientes',
                    'url'         => 'admin/clients',
                    'can'         => 'view_client'
                ],
            ],
        ],
        [
            'text'        => 'Veículos',
            'url'         => '#',
            'icon'        => 'car',
            'submenu'     => [
                [
                    'text'        => 'Categorias',
                    'url'         => 'vehicle/categories',
                    'can'         => 'view_vehicleCategory'
                ],
                [
                    'text'        => 'Tipos',
                    'url'         => 'vehicle/veh-types',
                    'can'         => 'view_vehicleType'
                ],
                [
                    'text'        => 'Espécies',
                    'url'         => 'vehicle/species',
                    'can'         => 'view_vehicleSpecies'
                ],
                [
                    'text'        => 'Combustíveis',
                    'url'         => 'vehicle/fuels',
                    'can'         => 'view_fuel'
                ],
                [
                    'text'        => 'Marcas',
                    'url'         => 'vehicle/manufacturers',
                    'can'         => 'view_manufacturer'
                ],
                [
                    'text'        => 'Modelos',
                    'url'         => 'vehicle/models',
                    'can'         => 'view_vehicleModel'
                ],
                [
                    'text'        => 'Veículos',
                    'url'         => 'vehicle/vehicles',
                    'can'         => 'view_vehicle'
                ]
            ],
        ],
        [
            'text'        => 'AITs',
            'url'         => '#',
            'icon'        => 'tags',
            'submenu'     => [
                [
                    'text'        => 'Órgãos',
                    'url'         => 'ait/agencies',
                    'can'         => 'view_agency'
                ],
                [
                    'text'        => 'Gravidades',
                    'url'         => 'ait/gravities',
                    'can'         => 'view_aitGravity'
                ],
                [
                    'text'        => 'Medidas Administrativas',
                    'url'         => 'ait/measures',
                    'can'         => 'view_aitMeasure'
                ],
                [
                    'text'        => 'Situações',
                    'url'         => 'ait/ait-statuses',
                    'can'         => 'view_aitStatus'
                ],
                [
                    'text'        => 'Tipos de Infrações',
                    'url'         => 'ait/ait-types',
                    'can'         => 'view_aitType'
                ],
                [
                    'text'        => 'Autos de Infrações',
                    'url'         => 'ait/aits',
                    'can'         => 'view_ait'
                ]
            ]
        ],
        [
            'text'        => 'Recursos',
            'url'         => '#',
            'icon'        => 'legal',
            'submenu'     => [
                [
                    'text'        => 'Situações',
                    'url'         => 'ait/resource/res-statuses',
                    'can'         => 'view_aitResourceStatus'
                ],
                [
                    'text'        => 'Recursos',
                    'url'         => 'ait/resource/resources',
                    'can'         => 'view_aitResource'
                ],
                [
                    'text'        => 'Andamentos',
                    'url'         => '#',
                    'submenu'     => [
                        [
                            'text'      => 'Origens da Inf.',
                            'url'       => 'ait/resource/progress/origins',
                            'can'       => 'view_aitProgressOrigin'
                        ],
                        [
                            'text'      => 'Fontes de Inf.',
                            'url'       => 'ait/resource/progress/meanses',
                            'can'       => 'view_aitProgressMeans'
                        ],
                        [
                            'text'      => 'Andamentos',
                            'url'       => 'ait/resource/progress/progresses',
                            'can'       => 'view_aitResourceProgress'
                        ]

                    ]
                ]
            ]
        ], 
        [
            'text'        => 'Documentos',
            'url'         => '#',
            'icon'        => 'file-text-o',
            'submenu'     => [
                [
                    'text'        => 'Tipos',
                    'url'         => 'document/doc-types',
                    'can'         => 'view_documentType'
                ],
                [
                    'text'        => 'Entidades',
                    'url'         => 'document/entities',
                    'can'         => 'view_documentEntity'
                ],
                [
                    'text'        => 'Documentos',
                    'url'         => 'document/documents',
                    'can'         => 'view_document'
                ]

            ]
        ]          
    ],    
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
        'inputmask'  => true,
    ],
];
