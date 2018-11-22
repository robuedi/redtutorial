<?php

namespace App\Http\Controllers\admin;

use App\Libraries\Listing;
use App\Libraries\Upload;
use App\Libraries\UIMessage;
use App\Libraries\MediaFilesToItemLib;
use Redirect;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\MediaFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Log;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    public function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return Redirect::to($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "*",

            'body' => "FROM media_files WHERE (1) {filters}",

            'filters' => array(

                'name' => "AND name LIKE '%{name}%'",

            ),

            'sortables' => array(

                'name' => '',
                'created_at' => 'desc'

            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.media_library.index', array('results' => $results, 'listing' => $listing));
    }

    public function add()
    {
        return View::make('_admin.media_library.add');
    }

    public function addToItem($item_type, $item_id)
    {
        return View::make('_admin.media_library.add', [
            'item_type' => $item_type,
            'item_id'   => $item_id,
        ]);
    }

    public function upload()
    {

        // initializez libraria de upload
        $upload = new Upload();

        // fac uploadul
        $upload_response = $upload->file();

        $upload_response['id'] = 0;
        // verific  raspunsul
        if (strtolower($upload_response['current_status']) === 'completed') {
            // get extension
            $type = pathinfo($upload_response['file_name'], PATHINFO_EXTENSION);

            // totul ok => insereaza in baza de date
            $upload_response['id'] = DB::table('media_files')->insertGetId(array(
                'name' => $upload_response['file_name'],
                'path' => $upload_response['file_dir'],
                'url' => $upload_response['file_url'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));
        }

        exit(json_encode($upload_response));
    }

    public function uploadToItem($item_type, $item_id)
    {
        $new_media_files_item = new MediaFilesToItemLib($item_type, $item_id);
        // initializez libraria de upload
        $upload = new Upload();

        // fac uploadul
        $upload_response = $upload->file();

        $upload_response['id'] = 0;
        // verific  raspunsul
        if (strtolower($upload_response['current_status']) === 'completed') {
            // get extension
            $type = pathinfo($upload_response['file_name'], PATHINFO_EXTENSION);

            // totul ok => insereaza in baza de date
            $upload_response['id'] = DB::table('media_files')->insertGetId(array(
                'name' => $upload_response['file_name'],
                'path' => $upload_response['file_dir'],
                'url' => $upload_response['file_url'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));

            //new record for media to item

            Media;
            $media_to_item->file_id     = $upload_response['id'];
            $media_to_item->item_id     = $item_id;
            $media_to_item->item_type   = $item_type;
            $media_to_item->save();
        }

        exit(json_encode($upload_response));
    }

    public function delete($id)
    {
        // aduc datele imaginii
        $file = MediaFile::findOrFail($id);

        // sterg din baza de date
        DB::table('media_files')
            ->where('id', $id)
            ->delete();

        // sterg de pe disc
        $file_path = $file->name . '/' . $file->name;
        if (file_exists($file_path))
            @unlink($file_path);

        // set success message
        UIMessage::set('success', 'File <strong>' . $file->name . '</strong> was deleted.');

        // go back to listing
        return Redirect::back();
    }

    public function popup_browse()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return Redirect::to($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "*",

            'body' => "FROM media_files WHERE (1) {filters}",

            'filters' => array(

                'name' => "AND name LIKE '%{name}%'",

            ),

            'sortables' => array(

                'name' => '',
                'created_at' => 'desc'

            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $listing->results_per_page = 50;

        $results = $listing->results();

        // display
        return View::make('_admin.media-library.popup_browse', array('results' => $results, 'listing' => $listing));
    }

    public function popup_upload()
    {
        return View::make('_admin.media-library.popup_upload');
    }

    public function download($id = 0) {
        // aduc datele fisierului
        $file = MediaFile::find($id);

        return Response::download($file->path.'/'.$file->name);
    }
}