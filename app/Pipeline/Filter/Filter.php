<?php
namespace App\Pipeline\Filter;


use Illuminate\Support\Str;
class Filter{
    public function handle($request ,\Closure $next)
    {
        $builder = $next($request);
        if(!$this->condition())
        {
            return $next($request);
        }
        return $this->query($builder);
    }
    public function condition()
    {
        $className= Str::snake(class_basename($this));
        return request($className) && request()->has($className);
    }
    public function query($builder)
    {
        $className = Str::snake(class_basename($this));
        return $builder->orWhere($className,request($className));
    }   
}