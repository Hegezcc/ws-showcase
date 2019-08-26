<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlentities(strip_tags($_POST['title']));
    $description = htmlentities(strip_tags($_POST['title']));
    $tags = $_POST['tags'];
    $positions = $_POST['positions'];
    $image = $_FILES['image'];
    if (!empty($title) && !empty($image)) {
        $imagePath = uploadImage($image, 'image');
        $arr = [];
        if (count($tags) === count($positions)) {
            foreach ($tags as $key => $index) {
                $arr[] = [
                    "name" => $tag,
                    "position" => $positions[$key]
                ];
            }
        }
        addNewData([
            'title' => $title,
            'description' => $description,
            'path' => $imagePath,
            'tags' => $arr,
        ]);
    }
}


function addNewData($newData)
{
    $data = file_get_contents('images.json');
    $data = (array)json_decode($data);
    $id = count($data) + 1;
    $newData['id'] = $id;
    $data[] = $newData;
    file_put_contents('res/images.json', json_encode($data));
}


function uploadImage($image, $key)
{
    $target_dir = "res/";
    $target_file = $target_dir . basename($image[$key]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST["submit"])) {
        $check = getimagesize($image[$key]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo false;
    } else {
        if (move_uploaded_file($image[$key]["tmp_name"], $target_file)) {
            return $target_dir . basename($image[$key]["name"]);
        } else {
            return false;
        }
    }
}


