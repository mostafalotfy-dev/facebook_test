<?php

namespace Providers\Facebook\Contracts;

interface ICrud {
    public function create($id,array $params ,string $token);
    public function update($id,array $params,string $token);
    public function delete($id,$token);
    public function get($id,$token);
}