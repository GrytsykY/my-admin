<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        $token = $request->query('api_token');
        if (empty($token)){
            $token = $request->input('api_token');
        }
        if (empty($token)){
            $token = $request->bearerToken();
        }

        if ($token === config('apitokens')['admin-panel']) return;
        $this->unauthenticated($request, $guards);
    }
}
