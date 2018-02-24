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
                    "name"  => "All courses",
                    "url"   => "admin/courses",
                    "aliases"   => array('admin\/courses\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new course",
                    "url"   => "admin/courses/create",
                    "aliases"   => array('admin\/courses\/create'),
                )
            ),
        ),
        array(
            "name"      => "Chapters",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-list-alt",
            "submenus"  => array(
                '1' => array(
                    "name"      => "Courses Skill Level",
                    "url"       => "admin/curses-skills",
                    "aliases"   => array(),
                ),
            ),
        ),
        array(
            "name"      => "Chapters Sections",
            "url"       => "admin/chapters-section",
            "aliases"   => array(),
            "class"     => "fa-bookmark-o",
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
                    "url"       => "admin/medialibrary",
                    "aliases"   => array(),
                ),
                '2' => array(
                    "name"      => "Upload new",
                    "url"       => "admin/medialibrary/add",
                    "aliases"   => array(),
                ),
            ),
        ),
        array(
            "name"      => "Configuration",
            "url"       => "admin/configuration",
            "aliases"   => array(),
            "class"     => "fa-wrench",
            "submenus"  => array(),

        ),
    ),
);
