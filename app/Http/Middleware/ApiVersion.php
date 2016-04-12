<?php

namespace App\Http\Middleware;

use Closure;
use Header;

class ApiVersion
{
    private static $VALID_API_VERSIONS = [
        '1.0' => 'V1',
        '1.1' => 'V1.1',
        '2' => 'V2',
    ];

    public function terminate($request, $response)
    {
        // Store the session data...
    }

    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $apiVersion = $this->getApiVersion($request);

        $apiNamespace = $this->getNamespace($apiVersion);
        $separator = $this->getSeparator($apiVersion);

        $actionObj = $route->getAction();
        $namespace = $actionObj['namespace'].$separator.$apiNamespace;
        $actionObj['uses'] = str_replace($actionObj['namespace'],$namespace,$actionObj['uses']);
        $actionObj['controller'] = str_replace($actionObj['namespace'],$namespace,$actionObj['controller']);
        $actionObj['namespace'] = $namespace;
        $route->setAction($actionObj);

        return $next($request);
    }

    public function getApiVersion($request) {
        $apiVersion = $request->header(Header::API_VERSION,'1.0');
        return $apiVersion;
    }

    public function isValid($apiVersion)
    {
        return in_array(
            $apiVersion,
            array_keys(static::$VALID_API_VERSIONS),
            true
        );
    }

    public function getNamespace($apiVersion)
    {
        if (!$this->isValid($apiVersion)) {
            return '';
        }

        return static::$VALID_API_VERSIONS[$apiVersion];
    }

    public function getSeparator($apiVersion)
    {
        if (!$this->isValid($apiVersion)) {
            return '';
        }

        return '\\';
    }
}
