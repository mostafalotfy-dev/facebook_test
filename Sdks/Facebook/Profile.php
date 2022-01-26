<?php

namespace Sdks\Facebook;

use Facebook\Facebook;

class Profile extends FacebookToken
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