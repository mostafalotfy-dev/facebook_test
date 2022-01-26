<?php


namespace Sdks;


class Registry
{
    private array $classes;
    public function __get($name)
    {
        return $this->get($name); 
    }
    public function __set($name, $object)
    {
        $this->set($name, $object);
    }
    public function get($name)
    {
        if (array_key_exists($name, $this->classes)) {
            return $this->classes[$name];
        }
        return null;
    }
    public function set($name, $object)
    {
        return $this->classes[$name] = $object;
    }
}
