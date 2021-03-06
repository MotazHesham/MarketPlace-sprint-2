<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Category;
use App\User;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', function () {
		$user = User::find(auth()->user()->id);
    $user ->login_status = 0;
    $user->save();
		Auth::logout();
    return redirect("/");
});

/*---------------- start admin routes ----------------*/
Route::group(['middleware' => 'admin'],function(){

	Route::get('admin','HomeController@statistics');

	Route::get('admin/accounts', 'UsersController@admin_accounts_index');

	Route::get('admin/categories', 'CategoriesController@admin_categories_index');

	Route::get('admin/comments', 'CommentsController@admin_comments_index');

	Route::get('admin/products', 'ProductsController@admin_products_index');

	Route::get('admin/products/approve/{id}', 'ProductsController@admin_products_approve');

	Route::get('admin/products/destroy/{id}', 'ProductsController@admin_product_destroy');

	Route::get('admin/categories/edit/{id}', 'CategoriesController@admin_categories_edit');

	Route::put('admin/categories/confirm/{id}', 'CategoriesController@admin_categories_confirm_edit');

	Route::get('admin/categories/destroy/{id}', 'CategoriesController@admin_categories_destroy');

	Route::get('admin/comments/destroy/{id}', 'commentsController@admin_comments_destroy');

	Route::get('admin/profile/edit/{id}','UsersController@admin_edit_profile');

	Route::put('admin/profile/confirm/{id}', 'UsersController@admin_profile_confirm_edit');

	Route::get('/deleteuser/{id}','UsersController@delete_user');

});

/*---------------- end admin routes ----------------*/


/*----------------start customer routes----------------*/

	Route::get('customer', 'CategoriesController@customer_categories');

	Route::get('customer/products/of/category/{id}','ProductsController@product_of_category');

	Route::get('customer/product/details/{id}','ProductsController@customer_product_details');

	Route::get('comments/fetch/{id}','CommentsController@fetch_comments');

Route::group(['middleware' => 'customer'],function(){

	Route::get('customer/cart/delete/{product_id}', 'CartsController@customer_cart_delete');

	Route::get('customer/cart/{id}', 'CartsController@customer_cart');

	Route::get('customer/orders', 'OrderController@customer_orders');

	Route::post('order/cart','OrderController@order_form');

	Route::get('customer/profile/{id}','UsersController@customer_profile');

	Route::get('customer/profile/edit/{id}','UsersController@customer_edit_profile');

	Route::put('customer/profile/confirm/{id}', 'UsersController@customer_profile_confirm_edit');

	Route::get('update/quantity/{quantity}/{product_id}/{cart_id}','CartsController@update_quantity');

	Route::post('comments/insert-comment','CommentsController@insert_comment');

  Route::get('add_to_cart/{product_id}','CartsController@add_to_cart');

});

/*---------------- end customer routes ----------------*/

/*---------------- start seller routes ----------------*/



Route::group(['middleware' => 'seller'],function(){

	Route::get('seller','ProductsController@view_store');

	Route::get('seller/orders/{id}', 'OrderController@seller_orders');

	Route::get('seller/profile/{id}','UsersController@seller_profile');

	Route::get('seller/profile/edit/{id}','UsersController@seller_edit_profile');

	Route::put('seller/profile/confirm/{id}', 'UsersController@seller_profile_confirm_edit');

  Route::get('seller/edit/product/{id}','ProductsController@seller_edit_product');

  Route::put('seller/confirm_edit/product/{id}','ProductsController@seller_confirm_update_product');

  Route::get('seller/delete/product/{id}', 'ProductsController@seller_delete_product');

 	Route::get('add_product', 'ProductsController@add_product');

 	Route::post('add_product_confirm', 'ProductsController@add_product_confirm');

});
/*---------------- end seller routes ----------------*/

/*---------------- start Chat routes ----------------*/

	Route::get('insert_chat/{to_user_id}/{chat_message}','ChatController@insert_chat');

	Route::get('fetch_user_chat_history/{to_user_id}','ChatController@fetch_user_chat_history');

	Route::get('count_messages/{to_user_id}','ChatController@count_messages');

	Route::get('fetch_contacts/{user_id}','ChatController@fetch_contacts');

/*---------------- start Chat routes ----------------*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
