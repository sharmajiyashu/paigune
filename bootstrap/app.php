<?php


use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {

                if ($exception instanceof AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthenticated. Please log in to access this route.',
                    ], 401); // 401 Unauthorized
                }

                if ($exception instanceof NotFoundHttpException) {
                    return response()->json(['message' => 'API not found.'], 404);
                }

                // if ($exception instanceof MethodNotAllowedHttpException) {
                //     return response()->json([
                //         'message' => 'Method not allowed for this route.',
                //     ], 405); // Return 405 error code
                // }

                if ($exception instanceof ValidationException) {

                    $formattedErrors = collect($exception->errors())->mapWithKeys(function ($messages, $field) {
                        return [$field => $messages[0]]; // Take the first error message per field
                    });

                    return response()->json([
                        'message' => 'Validation failed.',
                        'errors'  => $formattedErrors,
                    ], 422);
                }


                if ($exception instanceof UnauthorizedHttpException) {
                    return response()->json([
                        'message' => 'Unauthenticated. Please log in to access this route.',
                    ], 401); // Return 401 error code
                }



                return response()->json([
                    'message' => $exception->getMessage() ?: 'Something went wrong',
                ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
            }

            if ($request->is('admin/*')) {
                // abort(404);
            }

            // Default error handling for non-API routes
            return null;
        });
    })->create();
