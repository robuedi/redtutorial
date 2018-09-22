<?php

namespace App\Libraries;

class Upload
{

    private $upload_dir = 'media_library';

    public function __construct($options = array())
    {
        foreach ((array)$options as $key => $val) {
            if (isset($this->$key)) $this->$key = $val;
        }
    }

    public function file()
    {

        // HTTP headers for no cache etc
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // Settings
        $target_dir = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->upload_dir . DIRECTORY_SEPARATOR;

        // organize into folders: year / date
        $date_dir = date('Y' . DIRECTORY_SEPARATOR . 'm');
        $target_dir .= $date_dir;

        // check if folder exists, create if not
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // failed || in_progress || complete
        $current_status = 'in_progress';
        $message = '';

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $file_name = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $file_name = $_FILES["file"]["name"];
        } else {
            $file_name = uniqid("file_");
        }

        // Clean the file_name for security reasons
        $file_name = preg_replace('/[^\w\._]+/', '_', $file_name);

        // Make sure the file_name is unique but only if chunking is disabled
        if ($chunks < 2 && file_exists($target_dir . DIRECTORY_SEPARATOR . $file_name)) {
            $ext = strrpos($file_name, '.');
            $file_name_a = substr($file_name, 0, $ext);
            $file_name_b = substr($file_name, $ext);

            $count = 1;
            while (file_exists($target_dir . DIRECTORY_SEPARATOR . $file_name_a . '_' . $count . $file_name_b))
                $count++;

            $file_name = $file_name_a . '_' . $count . $file_name_b;
        }

        $file_path = $target_dir . DIRECTORY_SEPARATOR . $file_name;
        $file_url = 'uploads/' . $this->upload_dir . '/' . $date_dir . '/' . $file_name;

        // Create target dir
        if (empty($target_dir) || !file_exists($target_dir)) {
            $current_status = 'failed';
            $message = 'The upload folder was not specified or doesn\'t exist';

            return array(
                'current_status' => $current_status,
                'message' => $message,
                'file_name' => $file_name,
                'file_dir' => $target_dir,
                'file_url' => $file_url
            );
        }


        // Open temp file
        if (!$out = @fopen("{$file_path}.part", $chunks ? "ab" : "wb")) {
            $current_status = 'failed';
            $message = '#102 - Failed to open output stream.';

            return array(
                'current_status' => $current_status,
                'message' => $message,
                'file_name' => $file_name,
                'file_dir' => $target_dir,
                'file_url' => $file_url
            );
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $current_status = 'failed';
                $message = '#103 - Failed to move uploaded file.';

                return array(
                    'current_status' => $current_status,
                    'message' => $message,
                    'file_name' => $file_name,
                    'file_dir' => $target_dir,
                    'file_url' => $file_url
                );
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                $current_status = 'failed';
                $message = '#101 - Failed to open input stream.';

                return array(
                    'current_status' => $current_status,
                    'message' => $message,
                    'file_name' => $file_name,
                    'file_dir' => $target_dir,
                    'file_url' => $file_url
                );
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                $current_status = 'failed';
                $message = '#101 - Failed to open input stream.';

                return array(
                    'current_status' => $current_status,
                    'message' => $message,
                    'file_name' => $file_name,
                    'file_dir' => $target_dir,
                    'file_url' => $file_url
                );
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$file_path}.part", $file_path);

            $current_status = 'completed';
            $message = 'The file was successfully uploaded.';
        }

        // Return Success JSON-RPC response
        return array(
            'current_status' => $current_status,
            'message' => $message,
            'file_name' => $file_name,
            'file_dir' => $target_dir,
            'file_url' => $file_url
        );
    }
}