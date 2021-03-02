<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $querylang = $request->query('lang');
        // $lang = session('locale');
        $lang = Cookie::get('locale');

        if($querylang){
            if (!in_array($querylang, config('app.locales'))) {
                $lang = config('app.fallback_locale');
                // session(['locale' => $lang]);
                Cookie::queue('locale', $lang, 6000);
                app()->setLocale($lang);    
            }else{
                // session(['locale' => $querylang]);
                Cookie::queue('locale', $querylang, 6000);
                app()->setLocale($querylang);
            }
        }elseif($lang){
            if (!in_array($lang, config('app.locales'))) {
                $lang = config('app.fallback_locale');
                // session(['locale' => $lang]);
                Cookie::queue('locale', $lang, 6000);
                app()->setLocale($lang);    
            }else{
                app()->setLocale($lang);
            }
        }else{
            $lang = config('app.fallback_locale');
            // session(['locale' => $lang]);
            Cookie::queue('locale', $lang, 6000);
            app()->setLocale($lang);
        }                

        return $next($request);
    }
}
