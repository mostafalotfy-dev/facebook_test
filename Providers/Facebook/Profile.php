<?php

namespace Providers\Facebook;

use Facebook\Facebook;
use Providers\Facebook\ProviderRepository;

class Profile extends ProviderRepository
{
    
    public function __construct()
    {
        $this->response = $this->facebook->get("/me",$this->token);
    }
    public function getProfile()
    {
      return $this->response->getGraphUser();
    }

}