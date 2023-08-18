<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function uploadFile(Request $request) {
        $target_dir = "uploads/";
        $target_file = public_path($target_dir . basename($_FILES["file"]["name"]));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check === false) {
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     $uploadOk = 0;
        //     $message = "File already exists.";
        // }

        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            $uploadOk = 0;
            $message = "File size is too large.";
        }

        // Allow certain file formats
        $allowedExtensions = ["jpg", "png", "jpeg", "gif", "webp", "svg", "bmp"];
        if(!in_array($imageFileType, $allowedExtensions)) {
            $uploadOk = 0;
            $message = "Invalid file format.";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return json_encode([
                'status' => 0,
                'message' => $message ?? 'Error'
            ]);
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $url = asset($target_dir . basename($_FILES["file"]["name"]));
                return json_encode([
                    'status' => 1,
                    'url' => $url
                ]);
            } else {
                return json_encode([
                    'status' => 0,
                    'message' => 'Error uploading file.'
                ]);
            }
        }
    }
}
