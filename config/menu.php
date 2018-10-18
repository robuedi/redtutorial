<?php
// backend menus
return array(
    'admin' => array(
        array(
            "name"      => "Dashboard",
            "url"       => "/dashboard",
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
                    "url"   => "/courses",
                    "aliases"   => array('\/courses\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "/courses/create",
                    "aliases"   => array('\/courses\/create'),
                )
            ),
        ),
        array(
            "name"      => "Chapters",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-bookmark",
            "submenus"  => array(
                '1' => array(
                    "name"      => "All",
                    "url"       => "/chapters",
                    "aliases"   => array('\/chapters\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "/chapters/create",
                    "aliases"   => array('\/chapters\/create'),
                )
            ),
        ),
        array(
            "name"      => "Lessons",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-file-text",
            "submenus"  => array(
                "1" => array(
                    "name"  => "All",
                    "url"   => "/lessons",
                    "aliases"   => array('\/lessons\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "/lessons/create",
                    "aliases"   => array('\/lessons\/create'),
                )
            ),
        ),
        array(
            "name"      => "Contact Messages",
            "url"       => "/contact-messages",
            "aliases"   => array('\/contact-messages\/[a-zA-Z0-9]+\/edit'),
            "class"     => "fa-envelope",
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
                    "url"       => "/users-management/admin",
                    "aliases"   => array('\/users-management\/admin\/[0-9]+\/edit'),
                ),
                '2' => array(
                    "name"      => " All clients",
                    "url"       => "/users-management/client",
                    "aliases"   => array('\/users-management\/client\/[0-9]+\/edit'),
                ),
                '3' => array(
                    "name"      => "Add new",
                    "url"       => "/users-management/create",
                    "aliases"   => array('\/users-management\/admin\/create', '\/users-management\/client\/create'),
                ),
            ),
        ),
        array(
            "name"      => "Static Pages",
            "url"       => "#",
            "aliases"   => array(),
            "class"     => "fa-sitemap",
            "submenus"  => array(
                "1" => array(
                    "name"  => "All",
                    "url"   => "/static-pages",
                    "aliases"   => array('\/static-pages\/[a-zA-Z0-9]+\/edit'),
                ),
                "2" => array(
                    "name"  => "Add new",
                    "url"   => "/static-pages/create",
                    "aliases"   => array('\/static-pages\/create'),
                )
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
                    "url"       => "/media-library",
                    "aliases"   => array(),
                ),
                '2' => array(
                    "name"      => "Upload new",
                    "url"       => "/media-library/add",
                    "aliases"   => array(),
                ),
            ),
        )
    ),
);
