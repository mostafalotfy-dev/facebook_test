<?php 


namespace Providers\Facebook\Contracts;


interface UpdateContract{
    public function update($id,array $params,string $token);
}