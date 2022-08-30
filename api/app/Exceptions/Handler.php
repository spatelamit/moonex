<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;
use Throwable;

use Symfony\Component\Routing\Exception\RouteNotFoundException;

use Symfony\Component\Routing\Exception\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;




class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
    // $this->renderable(function (Throwable $e, $request) {
    //     if ($request->is('*')) {
    //         return response()->json([
    //             'message' => 'The requested URL was not found on this server. That’s all we know.'
    //         ], 404);
    //     }
    // });


    $this->renderable(function (NotFoundHttpException $e, $request) {
        if ($request->is('*')) {
            return response()->json([
                'message' => '404 The requested URL was not found on this server. That’s all we know.'
            ], 404);
        }
    });



$this->renderable(function (RouteNotFoundException $e, $request) {
    if ($request->is('*')) {
        return response()->json([
            'message' => 'UnAuthorized Invalid token',
            'status' => '403'
        ], 403);
    }
});

$this->renderable(function (MethodNotAllowedHttpException $e, $request) {
    if ($request->is('*')) {
        return response()->json([
            'message' => 'the request Method Not allowed.!',
            'status' => '401'
        ], 403);
    }
});




//  $this->renderable(function (QueryException $e, $request) {
//     if ($request->is('*')) {
//         return response()->json([
//             'message' => 'Error in Configuration db.',
//             'status' => '403'
//         ], 403);
//     }
// });


    


}

  // public function render($request, Throwable $e)
  //   {


  //   }







}
 