<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        // PENGGUNA
        
        if (Auth::user()->hasPermissionTo('pengguna_add')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('tambah-pengguna'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('pengguna_add'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }
        
        if (Auth::user()->hasPermissionTo('pengguna_edit')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('ubah-pengguna/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('pengguna_edit'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        if (Auth::user()->hasPermissionTo('pengguna_delete')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('hapus-pengguna/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('pengguna_delete'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }
        
        // GRUP
        
        if (Auth::user()->hasPermissionTo('grup_add')) //If user has this //permission
        {
            return $next($request);
        }


        if ($request->is('tambah-grup')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('grup_add')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        
        if (Auth::user()->hasPermissionTo('grup_edit')) //If user has this //permission
        {
            return $next($request);
        }


        if ($request->is('ubah-grup/*')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('grup_edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }


        if (Auth::user()->hasPermissionTo('grup_delete')) //If user has this //permission
        {
            return $next($request);
        }


        if ($request->is('hapus-grup/*')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('grup_delete')) {
                abort('401');
            } else {
                return $next($request);
            }
        }



            // ARTIKEL add
        if (Auth::user()->hasPermissionTo('article_add')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('tambah-artikel'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('article_add'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        // artikel edit
        if (Auth::user()->hasPermissionTo('article_edit')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('ubah-artikel/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('article_edit'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        // artikel hapus
        if (Auth::user()->hasPermissionTo('article_delete')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('hapus-artikel/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('article_delete'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        // kategori artikel add
        if (Auth::user()->hasPermissionTo('categories_add')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('tambah-kategori'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('categories_add'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        // kategori artikel edit
        if (Auth::user()->hasPermissionTo('categories_edit')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('ubah-kategori/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('categories_edit'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        // kategori artikel delete
        if (Auth::user()->hasPermissionTo('categories_delete')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('hapus-kategori/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('categories_delete'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }



        // permission add
        if (Auth::user()->hasPermissionTo('permission_add')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('tambah-akses'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('permission_add'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        // permission add
        if (Auth::user()->hasPermissionTo('permission_edit')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('ubah-akses/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('permission_edit'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }  


        // permission add
        if (Auth::user()->hasPermissionTo('permission_delete')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('hapus-akses/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('permission_delete'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }  


        // statis page add
        if (Auth::user()->hasPermissionTo('page_add')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('tambah-halaman'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('page_add'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }  


        // statis page add
        if (Auth::user()->hasPermissionTo('page_edit')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('ubah-halaman/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('page_edit'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }  


        // statis page add
        if (Auth::user()->hasPermissionTo('page_delete')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('hapus-halaman/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('page_delete'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        } 



        // menu add
        if (Auth::user()->hasPermissionTo('menu_add')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('tambah-menu'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('menu_add'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }  


        // menu add
        if (Auth::user()->hasPermissionTo('menu_edit')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('ubah-menu/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('menu_edit'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }  
 

        // menu add
        if (Auth::user()->hasPermissionTo('menu_delete')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('hapus-menu/*'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('menu_delete'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }   
        return $next($request);
    }
}