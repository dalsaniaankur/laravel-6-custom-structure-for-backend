<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Classes\Models;

class CheckTeacher
{
    public function handle($request, Closure $next)
    {

		if (!Auth::guard('teacher')->check()) {
           return redirect('teacher_login');
        }
        view()->share('loadingPageType', 'teacher');
		return $next($request);
    }
}
