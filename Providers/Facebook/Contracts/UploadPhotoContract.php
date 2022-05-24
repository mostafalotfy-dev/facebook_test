<?php



namespace Providers\Facebook\Contracts;


interface UploadPhotoContract {
    public function addPhoto($id,array $params,string $token);
}