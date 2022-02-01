<?php



namespace Sdks\Facebook;

use Nette\NotImplementedException;
use Sdks\Facebook\Contracts\ICrud;
use Sdks\Facebook\Contracts\IUploadPhoto;

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
     throw new NotImplementedException();
 }
 public function update($id, array $params, string $token)
 {
     throw new NotImplementedException();
 }
 public function addPhoto($id, array $params, string $token)
 {
     return $this->provider->post($id."/photo",$params,$token);
 }
}