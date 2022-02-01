<?php


namespace Sdks\Facebook\FacebookAlbum;

use Sdks\Facebook\ProviderRepository;
use Sdks\Facebook\Photo;
use Facebook\Facebook;
use Facebook\FileUpload\FacebookFile;

class Album extends ProviderRepository  {
    protected $photo;
    public function __construct(Facebook $provider)
    {
      parent::__construct($provider);
      $this->photo = new Photo($this->provider);
    }

    public function uploadPhotoToAlbum($albumId,string $files,string $token )
    {
      $params["source"] = new FacebookFile($files);
      return $this->photo->addPhoto($albumId,$params,$token);
      
    }
    
    

    
}