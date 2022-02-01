<?php



namespace Sdks\Facebook\Contracts;


interface IUploadPhoto {
    public function addPhoto($id,array $params,string $token);
}