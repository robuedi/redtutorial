<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Theme
    |--------------------------------------------------------------------------
    |
    */

    'skins' => [
        'options' => [
            ['Default'       , 'smart-style-0'],
            ['DarkElegance'  , 'smart-style-1'],
            ['UltraLight'    , 'smart-style-2'],
            ['Google'        , 'smart-style-3'],
            ['PixelSmash'    , 'smart-style-4'],
            ['Glass'         , 'smart-style-5']
        ],
        'default' => 'smart-style-0',
    ],

    // Fixed Header
    'fixed_header' => [
        'option' => 'fixed-header',
        'default'=> ''
    ],

    'fixed_navigation' => [
        'option' => 'fixed-navigation',
        'default'=> ''
    ],

    'fixed_ribbon' => [
        'option' => 'fixed-ribbon',
        'default'=> ''
    ],

    'fixed_footer' => [
        'option' => 'fixed-page-footer',
        'default'=> ''
    ],

    'inside_container' => [ //must be checked
        'option' => 'container',
        'default'=> ''
    ],

    'right_side_nav' => [
        'option' => 'smart-rtl',
        'default'=> '',
        'custom' => ''
    ],

    'menu_on_top' => [
        'option' => 'menu-on-top ',
        'default'=> '',
    ],


    'custom' => ['body' => '']

];
