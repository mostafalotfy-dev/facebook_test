<?php 

namespace Sdks\Facebook;

use Facebook\Facebook;

class ProviderRepository {
    protected $token;
    protected $provider;
    private $loginHelper;
    public function __construct(Facebook $fb)
    {
        $this->token = null;
        $this->provider = $fb;
        $this->setLoginHelper();
        
    }
    protected function setLoginHelper()
    {
        $this->loginHelper = $this->provider->getRedirectLoginHelper();
        return $this;
    }
    public function getRedirectLoginHelper()
    {
        return $this->loginHelper;
    }
    public function loginUrl( $redirectUrl, array $scope = []){
        return $this->loginHelper->getLoginUrl($redirectUrl,$scope);
    }

    public function client()
    {
        return $this->provider->getOAuth2Client();
    }

    public function accessToken($redirectUrl = null)
    {
        return $this->loginHelper->getAccessToken($redirectUrl);
    }
    public function longLivedAccessToken()
    {
        return $this->client()->getLongLivedAccessToken($this->token);
    }
    public function setToken($accessToken)
    {
        $this->token = $accessToken;
        return $this;
    }
}