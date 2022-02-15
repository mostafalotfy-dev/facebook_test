<?php 
namespace App\Traits;
trait HasImage {
    public function addImage(&$input,$attribute,$outputPath)
    {
        if(request()->file($attribute))
        {
            $fileName = uniqid(). request()->file($attribute)->getClientOriginalName();
            $input[$attribute] = $fileName;
            request()->file($attribute)->move($outputPath,$fileName);
        }else{
            unset($input[$attribute]);
        }
    }
}