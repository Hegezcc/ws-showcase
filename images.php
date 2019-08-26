<?php
function getDataImages(){
    $data = file_get_contents('./images.json');
    return (array) json_decode($data);
}