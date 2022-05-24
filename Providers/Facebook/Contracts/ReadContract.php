<?php


namespace Providers\Facebook\Contracts;

interface ReadContract {
    public function get($id,$token);
}