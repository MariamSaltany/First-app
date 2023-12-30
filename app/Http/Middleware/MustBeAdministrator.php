 <?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class MustBeAdministrator
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {  //if there is more then your we could use array of admins || update the users table to add colum show that if he is an admin T,F
//         if(auth()->user()?->username != 'Mariammar'){
//             abort(Response::HTTP_FORBIDDEN);
//         }
//         return $next($request);
//     }
// } 
