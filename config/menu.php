<?php
// backend menus
return array(
    'admin' => array(
        array(
            "name"      => "Dashboard",
            "url"       => "admin/dashboard",
            "aliases"   => array(),
            "class"     => "fa-dashboard",
            "submenus"  => array(),
        ),
        array(
            "name"      => "Courses",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-book",
            "submenus"  => array(
                "1" => array(
                    "name"  => "All",
                    "url"   => "admin/courses",
                    "aliases"   => array('admin\/courses\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "admin/courses/create",
                    "aliases"   => array('admin\/courses\/create'),
                )
            ),
        ),
        array(
            "name"      => "Chapters",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-bookmark-o",
            "submenus"  => array(
                '1' => array(
                    "name"      => "All",
                    "url"       => "admin/chapters",
                    "aliases"   => array('admin\/chapters\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "admin/chapters/create",
                    "aliases"   => array('admin\/chapters\/create'),
                )
            ),
        ),
        array(
            "name"      => "Lessons",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-file-text-o",
            "submenus"  => array(
                "1" => array(
                    "name"  => "All",
                    "url"   => "admin/lessons",
                    "aliases"   => array('admin\/lessons\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "admin/lessons/create",
                    "aliases"   => array('admin\/lessons\/create'),
                )
            ),
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
                    "aliases"   => array('admin\/users_management\/admin\/[0-9]+\/edit'),
                ),
                '2' => array(
                    "name"      => " All clients",
                    "url"       => "backend/users_management/clients/show",
                    "aliases"   => array('admin\/users_management\/client\/[0-9]+\/edit'),
                ),
                '3' => array(
                    "name"      => "Add new",
                    "url"       => "backend/users_management/create",
                    "aliases"   => array('admin\/users_management\/admin\/create', 'backend\/users_management\/client\/create'),
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
                    "url"       => "admin/media-library",
                    "aliases"   => array(),
                ),
                '2' => array(
                    "name"      => "Upload new",
                    "url"       => "admin/media-library/add",
                    "aliases"   => array(),
                ),
            ),
        ),
        array(
            "name"      => "Configuration",
            "url"       => "admin/configuration",
            "aliases"   => array(),
            "class"     => "fa-wrench",
            "submenus"  => array(
                '1' => array(
                    "name"      => "Themes",
                    "url"       => "admin/themes",
                    "aliases"   => array(),
                ),
            ),

        ),
    ),
);
