<?php



namespace Providers\Facebook\FacebookAlbum;

use Providers\Facebook\Contracts\ICrud;
use Providers\Facebook\Contracts\IUploadPhoto;
use Providers\Facebook\ProviderRepository;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Photo extends ProviderRepository implements ICrud,IUploadPhoto
{
 public function get($id,$token)
 {
     return $this->provider->get($id,$token);
 }
 public function create($id, array $params, string $token)
 {
     return $this->provider->post($id."/photos",$params,$token);
 }
 public function delete($id,$token)
 {
     throw new MethodNotAllowedHttpException([
         "GET",
         "POST"
     ]);
 }
 public function update($id, array $params, string $token)
 {
    throw new MethodNotAllowedHttpException([
        "GET",
        "POST"
    ]);
 }
 public function addPhoto($id, array $params, string $token)
 {
     return $this->provider->post($id."/photos",$params,$token);
 }
}