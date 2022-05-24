<?php 


namespace Providers\Facebook\Contracts;


interface CreateContract {

    public function create($id,array $params ,string $token);

}