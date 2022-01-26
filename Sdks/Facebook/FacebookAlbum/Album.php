<?php


namespace Sdks\Facebook\FacebookAlbum;


use Sdks\Facebook\ProviderRepository;

class Album extends ProviderRepository {
    

    
    public function addToAlbum($albumId,array $files,string $token )
    {
     
      return $this->provider->post($albumId."/photos", $files,$token);
      
    }
   
    public function create($albumId,$token)
    {
      return $this->provider->get("/".$this->id,$token); 
      
    }
    

    
}