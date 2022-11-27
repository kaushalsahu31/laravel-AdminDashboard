<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if (isset($user)) {
            if ($user->role=="admin") {
                $users = User::paginate(2);
                return view('admin.admin',compact('users'))->render();
            }elseif ($user->role=="seller") {
                $products=Product::paginate(10);
                return view('seller.profile', compact('products'))->render();
            }elseif ($user->role=="user") {
                 $products=Product::paginate(12);
                return view('user.profile', compact('products'))->render();
            }else{
                 return redirect('/');
            }
           
        }else{
            return redirect('/login');
        }
    }
}
