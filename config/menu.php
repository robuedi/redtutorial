<?php
// backend menus
return array(
    'admin' => array(
        array(
            "name"      => "Dashboard",
            "url"       => "backend/dashboard",
            "aliases"   => array(),
            "class"     => "fa-dashboard",
            "submenus"  => array(),
        ),


        array(
            "name"      => "Users Management",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-user",
            "submenus"  => array(
                '1' => array(
                    "name"      => " All administrators",
                    "url"       => "backend/users_management/administrators/show",
                    "aliases"   => array('backend\/users_management\/admin\/[0-9]+\/edit'),
                ),
                '2' => array(
                    "name"      => " All clients",
                    "url"       => "backend/users_management/clients/show",
                    "aliases"   => array('backend\/users_management\/client\/[0-9]+\/edit'),
                ),
                '3' => array(
                    "name"      => "Add new",
                    "url"       => "backend/users_management/create",
                    "aliases"   => array('backend\/users_management\/admin\/create', 'backend\/users_management\/client\/create'),
                ),
            ),
        ),
        array(
            "name"      => "Media Library",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-picture-o",
            "submenus"  => array(
                '1' => array(
                    "name"      => "All files",
                    "url"       => "backend/medialibrary",
                    "aliases"   => array(),
                ),
                '2' => array(
                    "name"      => "Upload new",
                    "url"       => "backend/medialibrary/add",
                    "aliases"   => array(),
                ),
            ),
        ),
        array(
            "name"      => "Configuration",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-wrench",
            "submenus"  => array(),
        ),
    ),
);
