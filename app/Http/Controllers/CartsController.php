<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Cart;

use Illuminate\Support\Facades\Storage;

use App\comment;


use App\product_of_cart;
use DB;




class CartsController extends Controller
{
    public function customer_cart($id){
    	$userid =  auth()->user()->id;
        $cart = Cart::where('id_user',$userid)->get();
        if(count($cart) > 0){
            return view('customer_view.cart.cart')->with('cart',$cart[0]);
        }else{
            $new_cart = new Cart;
            $new_cart->id_user = $userid;
            $new_cart->save();
            return view('customer_view.cart.cart')->with('cart',$new_cart);
        }
    }

    public function add_to_cart($product_id){


        if (Auth::user()) {
            $cart = Cart::where('id_user',Auth::user()->id)->get();
            $cart[0]->product()->attach($product_id);
            return back();
        }

        else{

            return view('auth.register');
        }


    }

    public function update_quantity($quantity,$product_id,$cart_id){
        $cart = Cart::find($cart_id);
        $cart_product = $cart->product()->find($product_id);
        $cart_product->pivot->quntity = $quantity;
        $cart_product->pivot->save();
    }
    public function customer_cart_delete($id)
    {
        
        $carts = Cart::where('id_user',auth()->user()->id)->get();
        $carts[0]->product()->wherePivot('product_id','=',$id)->detach();
        return back()->with('success','product Removed');
    }
    

}












