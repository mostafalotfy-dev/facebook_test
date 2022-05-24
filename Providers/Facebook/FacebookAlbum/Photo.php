<?php



namespace Providers\Facebook\FacebookAlbum;

use Providers\Facebook\Contracts\CreateContract;
use Providers\Facebook\Contracts\ReadContract;
use Providers\Facebook\Contracts\UploadPhotoContract;
use Providers\Facebook\ProviderRepository;


class Photo extends ProviderRepository implements ReadContract,CreateContract,UploadPhotoContract
{
 public function get($id,$token)
 {
     return $this->provider->get($id,$token);
 }
 public function create($id, array $params, string $token)
 {
     return $this->provider->post($id."/photos",$params,$token);
 }

 public function addPhoto($id, array $params, string $token)
 {
     return $this->provider->post($id."/photos",$params,$token);
 }
}