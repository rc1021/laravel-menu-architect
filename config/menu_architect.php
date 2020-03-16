<?php

return [

    /*
    |--------------------------------------------------------------------------
    | tips ?
    |--------------------------------------------------------------------------
    |
    | view tips: how to use;
    |
    */

    'tips' => true,

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | you can add your own middleware here
    |
    */
	
   'middleware' => ['web', 'auth'],

   /*
   |--------------------------------------------------------------------------
   | Output display
   |--------------------------------------------------------------------------
   |
   | Display html by 'nestable', 'adminlte', 'bootstrap', 
   | or data by '_array', '_json'
   |
   */

   'output' => 'nestable',

   /*
   |--------------------------------------------------------------------------
   | Table Migrate
   |--------------------------------------------------------------------------
   |
   | you can set your own table prefix, table names here
   |
   */
  
    'table_prefix' => '',

    'table_name_menus' => 'menu_architects',

    'table_name_items' => 'menu_architect_items',

    'table_default_color' => '#000000', // menu item text color

    'table_default_target' => '_self', // click Open In ['_self', '_blank']

   /*
   |--------------------------------------------------------------------------
   | Role relation
   |--------------------------------------------------------------------------
   |
   | here you can make menu items visible to specific roles
   |
   */
  
    'use_roles' => false,
   
    'roles_table' => 'roles',

    'roles_pk' => 'id',

    'roles_title_field' => 'name', 

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Configure which JavaScript plugins should be included. At this moment,
    | DataTables, Select2, Chartjs and SweetAlert are added out-of-the-box,
    | including the Javascript and CSS files from a CDN via script and link tag.
    | Plugin Name, active status and files array (even empty) are required.
    | Files, when added, need to have type (js or css), asset (true or false) and location (string).
    | When asset is set to true, the location will be output using asset() function.
    |
    */

    'plugins' => [
        [
            'name' => 'jQuery',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js',
                ],
            ],
        ],
        [
            'name' => 'RamonSmit Nestable2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css',
                ],
            ],
        ],
        [
            'name' => 'jquery-ujs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jquery-ujs/1.2.2/rails.min.js',
                ],
            ],
        ],
        [
            'name' => 'twitter-bootstrap',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css',
                ],
            ],
        ],
        [
            'name' => 'Simonwep color pickr',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.es5.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@9',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Laravel Menu Architect Main Assets',
            'active' => true,
            'files' => [
                // Nestable2 Draggable Handles
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/menu_architect/css/nestable2.css',
                ],
                // Simonwep Picker
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/menu_architect/js/jquery-simonwep-pickr.js',
                ],
                // jQuery Button Confirm
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/menu_architect/js/jquery-btn-confirm.js',
                ],
                // Menu Architect Main Style
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/menu_architect/css/main.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/menu_architect/js/main.js',
                ],
            ],
        ],
    ],

];