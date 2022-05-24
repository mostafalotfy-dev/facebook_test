<?php


namespace Providers\Facebook\FacebookAlbum;

use Providers\Facebook\ProviderRepository;

use Facebook\Facebook;
use Facebook\FileUpload\FacebookFile;
use Providers\Facebook\Contracts\UploadPhotoContract;

class Album extends ProviderRepository implements UploadPhotoContract  {
    protected $photo;
    public function __construct(Facebook $provider)
    {
      parent::__construct($provider);
      $this->photo = new Photo($this->provider);
    }

    public function addPhoto($id,array $params,string $token)
    {
      $params["source"] = new FacebookFile($params);
      return $this->photo->addPhoto($id,$params,$token);
      
    }
        
}