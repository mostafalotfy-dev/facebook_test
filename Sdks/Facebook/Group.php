<?php



namespace Sdks\Facebook;

class Group extends ProviderRepository {
    public function createAlbum($groupId,array $params,$token)
    {
       return $this->provider->post($groupId."/albums",$params,$token);
    }
    
}