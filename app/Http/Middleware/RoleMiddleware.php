<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class RoleMiddleware
{
    /**
     * Meloloskan request hanya jika role pengguna sama dengan
     * role yang ditulis pada route, misalnya middleware('role:admin').
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role !== $role) {
            abort(403, 'Halaman ini khusus untuk ' . $role . '.');
        }
 
        return $next($request);
    }
}
