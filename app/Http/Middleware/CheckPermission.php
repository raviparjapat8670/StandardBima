<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Occupation;
use App\Models\User;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $action, $model)
    {
        // Dynamically check if the user can perform the action on the model
        $user = auth()->user();
        // Perform the authorization check

        // Get the fully qualified class name (FQCN) using the model string
        $modelClass = 'App\\Models\\' . $model;
        if (!$user->can($action, $modelClass)) {
            // If not authorized, abort with a 403 response
            return response()->view('admin.errors.403', ['message' => 'Sorry, You Don\'t Have Permission To Access This Page.'], 403);
        
        }

        // Allow the request to continue
        return $next($request);
    }
}
