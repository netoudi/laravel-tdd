<?php

namespace CodePress\CodeUser\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;

class Authorization
{
    /**
     * @var Gate
     */
    private $gate;

    /**
     * Authorization constructor.
     *
     * @param Gate $gate
     */
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $ability
     * @return mixed
     */
    public function handle($request, Closure $next, $ability)
    {
        $this->gate->authorize($ability);

        return $next($request);
    }
}
