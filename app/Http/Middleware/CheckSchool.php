<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Classes\Models;

class CheckSchool
{
    public function handle($request, Closure $next)
    {
		if (!Auth::guard('school')->check()) {
           return redirect('school_login');
        }
        view()->share('loadingPageType', 'school');
        return $next($request);
    }
}
