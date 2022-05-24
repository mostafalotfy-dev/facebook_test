<?php 


namespace Providers\Facebook\Contracts;


interface DeleteContract
{
    public function delete($id,$token);
}