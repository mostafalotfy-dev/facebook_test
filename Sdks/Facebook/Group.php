<?php

namespace Sdks\Facebook;

class Group extends ProviderRepository {
    public function createAlbum($groupId,array $params,$token)
    {
       return $this->provider->post($groupId."/albums",$params,$token);
    }
    
    public function addVideo($groupId,$file,array $metadata,string $token )
    {
      return $this->provider->uploadVideo($groupId."/videos",$file, $metadata,$token);
    }
    
}