<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 01/12/18
 * Time: 18:36
 */

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use Log;
use Storage;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller
{
    public function showMediaImage(Filesystem $filesystem, $year, $month, $file_name)
    {

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => public_path('/')."uploads/media_library/$year/$month/",
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        $server->outputImage(
            $file_name,
            [
                'w' => Input::get('w'),
                'h' => Input::get('h'),
                'fit' => Input::get('fit', 'crop'),
                'filt' => Input::get('filt'),
                'fm' => 'pjpg'
            ]
        );
    }

    public function showAssetImage(Filesystem $filesystem, $file_name)
    {

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => public_path('/')."assets/img/",
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        $server->outputImage(
            $file_name,
            [
                'w' => Input::get('w'),
                'h' => Input::get('h'),
                'fit' => Input::get('fit', 'crop'),
                'filt' => Input::get('filt'),
                'fm' => 'pjpg'
            ]
        );
    }
}