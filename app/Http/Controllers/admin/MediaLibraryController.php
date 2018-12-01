<?php

namespace App\Http\Controllers\admin;

use App\Libraries\Listing;
use App\Libraries\Upload;
use App\Libraries\UIMessage;
use App\Libraries\MediaFilesToItemLib;
use App\MediaFileToItem;
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

            'fields' => "m.*, mf.item_type, mf.item_id",

            'body' => "FROM media_files as m 
                        LEFT JOIN media_files_to_items mf ON m.id = mf.file_id
                        WHERE (1) {filters}",

            'filters' => array(

                'name' => "AND name LIKE '%{name}%'",

            ),

            'sortables' => array(

                'name' => '',
                'item_type' => '',
                'created_at' => 'desc',
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

    public function editAdd()
    {
        return View::make('_admin.media_library.edit_add');
    }

    public function addToItem($item_type, $item_id)
    {
        //get any existing img for item
        $img = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $item_id)
            ->where('item_type', $item_type)
            ->first();

        return View::make('_admin.media_library.edit_add', [
            'item_type' => $item_type,
            'img'       => $img,
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

            //delete the existing img for the item
            $current_file_to_item = MediaFileToItem::where('item_id', $item_id)
                ->where('item_type', $item_type)->get();

            if($current_file_to_item)
            {
                foreach ($current_file_to_item as $file_to_item)
                {
                    //check  if exist
                    $file = MediaFile::findOrFail($file_to_item->file_id);

                    // remove from db
                    DB::table('media_files')
                        ->where('id', $file_to_item->file_id)
                        ->delete();

                    if($file)
                    {
                        // remove from disc
                        $file_path = $file->name . '/' . $file->name;
                        if (file_exists($file_path))
                            @unlink($file_path);
                    }

                    //delete current file to item link
                    DB::table('media_files_to_items')
                        ->where('id', $file_to_item->id)
                        ->delete();
                }
            }

            //new record for media to item
            $media_to_item = new MediaFileToItem();
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