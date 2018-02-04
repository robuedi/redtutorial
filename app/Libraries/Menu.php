<?php

namespace App\Libraries\AdminLib;

use Config;
use Log;
use Request;
//use Sentinel;

class Menu
{

    public static function getMenu()
    {
        $current_url = Request::path();

        $url_items = explode('/', $current_url);

        // get all menu structure
        $menu = Config::get('menu');

        // filter menu based on current user type
//        if (Sentinel::hasAccess('admin'))
            $menu = $menu['admin'];

        foreach ($menu as $top_level_menu_key => $top_level_menu) {
            if ($current_url == $top_level_menu['url']) {
                $menu[$top_level_menu_key]['active'] = true;
                break;
            }

            if (isset($url_items[0]) && $url_items[0] == $top_level_menu['url'])
            {
                $menu[$top_level_menu_key]['active'] = true;
                break;
            }

            if (isset($top_level_menu['submenus']) && count($top_level_menu['submenus'])) {
                foreach ($top_level_menu['submenus'] as $second_level_menu_key => $second_level_menu) {

                    if ($current_url == $second_level_menu['url']) {
                        $menu[$top_level_menu_key]['submenus'][$second_level_menu_key]['active'] = true;
                        $menu[$top_level_menu_key]['active'] = true;
                        break;
                    } elseif (isset($second_level_menu['aliases']) && count($second_level_menu['aliases'])) {
                        foreach ($second_level_menu['aliases'] as $alias) {
                            preg_match('/'.$alias.'/', $current_url, $found_items);

                            if (count($found_items)) {
                                $menu[$top_level_menu_key]['submenus'][$second_level_menu_key]['active'] = true;
                                $menu[$top_level_menu_key]['active'] = true;
                                break;
                            }
                        } // end looping aliases
                    }
                } // end looping submenus
            }
        } // end looping top menus

        return $menu;
    }
}