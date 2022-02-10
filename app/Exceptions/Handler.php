<?php

namespace App\Exceptions;

use App\Traits\HasJson;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use HasJson;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];
    public function render($request, Throwable $e)
    { 
        if(method_exists($e,"errors"))
        {
            $errors = [];
            foreach($e->errors() as $error)
            {
                $errors[] = $error[0];
            
            }
            return $this->sendError($errors,422);
        }
        
       
        return parent::render($request,$e);
    }
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
   
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
