<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Sentinel;
use App\Configuration;
use View;

class ConfigurationController extends Controller
{
    function editUserTheme()
    {

        $user = Sentinel::getUser();

        if(!$user)
            abort(404);

        $theme_configurations = Configuration::leftJoin('users_configuration', 'configurations.id', '=', 'users_configuration.configuration_id')
                                ->where('users_configuration.user_id', $user->id)
                                ->where('configurations.type', 'theme')
                                ->get();

        return View::make('_admin.configurations.user_configuration.edit', [
                'user' =>$user,
                'theme_configurations' => $theme_configurations
        ]);
    }

    function updateUserTheme()
    {

    }

}