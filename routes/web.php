<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>'gues'], function () {

    Route::get('/', 'Guest\LandingPageController@index');

    Route::get('shop/get-state-list/{param}','Guest\ShopController@getStateList');
    Route::get('shop/get-city-list/{param}','Guest\ShopController@getCityList');
    Route::get('shop/get-category-list/{param}','Guest\ShopController@getSubCategory');
    Route::get('shop/get-brand-list/{param}','Guest\ShopController@getBrandCategory');

    Route::get('/search', 'Guest\ShopController@search')->name('search.product');

    Route::get('/shop', 'Guest\ShopController@index')->name('shop.index');
    Route::get('/shop/{product}', 'Guest\ShopController@show')->name('shop.show');

    Route::get('register', 'Auth\RegistrationController@register')->name('register');
    Route::post('register', 'Auth\RegistrationController@postRegister')->name('register');

    Route::get('activate/{email}/{activationCode}','Auth\ActivationController@activate');

    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::post('login', 'Auth\LoginController@postLogin')->name('login');

    Route::get('/cart', 'Guest\CartController@index')->name('cart.index');
    Route::post('/cart/{product}', 'Guest\CartController@store')->name('cart.store');
    Route::patch('/cart/{product}', 'Guest\CartController@update')->name('cart.update');
    Route::delete('/cart/{product}', 'Guest\CartController@destroy')->name('cart.destroy');
    Route::post('/cart/switchToSaveForLater/{product}', 'Guest\CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

    Route::delete('/saveForLater/{product}', 'Guest\SaveForLaterController@destroy')->name('saveForLater.destroy');
    Route::post('/saveForLater/switchToCart/{product}', 'Guest\SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');
       
});

Route::group(['middleware'=>'member'], function () {

    Route::get('/main-member', 'Member\LandingPageController@index');

    Route::get('pesan', 'Member\MessengerController@index')->name('messenger.index');
    Route::get('pesan/{product}/create', 'Member\MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('pesan', 'Member\MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('pesan/inbox', 'Member\MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('pesan/reply', 'Member\MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('pesan/{topic}', 'Member\MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('pesan/{topic}', 'Member\MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('pesan/{topic}/reply', 'Member\MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('pesan/{topic}/reply', 'Member\MessengerController@showReply')->name('messenger.showReply');

    Route::get('dashboard-barang', 'Member\SellerController@index')->name('jual');
    Route::get('information-barang', 'Member\SellerController@all')->name('information_barang');
    
    Route::get('jual-barang', 'Member\SellerController@create')->name('jual_barang');
    Route::get('jual-barang/get-state-list/{param}','Member\SellerController@getStateList');
    Route::get('jual-barang/get-city-list/{param}','Member\SellerController@getCityList');
    Route::get('jual-barang/get-category-list/{param}','Member\SellerController@getSubCategory');
    Route::get('jual-barang/get-brand-list/{param}','Member\SellerController@getBrandCategory');
    Route::post('jual-barang', 'Member\SellerController@store')->name('jual_barang_store');

    Route::get('update-barang/product/{id}/data/{slug}', 'Member\SellerController@EditProduct')->name('edit_barang');
    Route::post('update-barang/product/{id}/data/{slug}', 'Member\SellerController@UpdateProduct');
    
    Route::get('edit-image-barang/product/{product_id}', 'Member\SellerController@EditImageProduct')->name('edit_image_barang');
    Route::post('edit-image-barang/product/{product_id}', 'Member\SellerController@UpdateImageProduct');
    
    Route::get('status-waiting/barang', 'Member\InformasiStatusController@pemantauan')->name('waiting');
    Route::get('status-publish/barang', 'Member\InformasiStatusController@publish')->name('publish');
    Route::get('status-unpublish/barang', 'Member\InformasiStatusController@unpublish')->name('unpublish');
    Route::get('status-soldout/barang', 'Member\InformasiStatusController@terjual')->name('terjual');

    Route::get('checkout/get-state-list/{param}','Member\CheckoutController@getStateList');
    Route::get('checkout/get-city-list/{param}','Member\CheckoutController@getCityList');
    Route::get('/checkout', 'Member\CheckoutController@index')->name('checkout.index');
    Route::post('/checkout', 'Member\CheckoutController@store')->name('checkout.store');

    Route::get('/thankyou', 'Member\ConfirmationController@index')->name('confirmation.index');

    Route::get('/my-orders', 'Member\OrdersController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'Member\OrdersController@show')->name('orders.show');

    Route::get('/information/payment-confirmation', 'Member\KonfirmasiPembayaranController@index')->name('konfirmasi.index');
    Route::get('/payment-confirmation/', 'Member\KonfirmasiPembayaranController@search')->name('search');
    Route::get('/payment-confirmation/{id}/show', 'Member\KonfirmasiPembayaranController@edit')->name('edit.search');
    Route::post('/payment-confirmation/{id}/show', 'Member\KonfirmasiPembayaranController@store')->name('konfirmasi.store');

    Route::get('notification-member', 'Member\CommentProductController@showInbox')->name('notification.member');
    Route::get('notification-member/{topic}', 'Member\CommentProductController@showMessages')->name('notification.showMessages');
    Route::post('notification-member/{topic}/reply', 'Member\CommentProductController@replyToTopic')->name('notification.reply');
    Route::get('notification-member/{topic}/reply', 'Member\CommentProductController@showReply')->name('notification.showReply');

    Route::post('notification', 'Member\CommentProductController@store')->name('jual_store');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout.user');

});

Route::group(['middleware'=>'master'], function () {

    Route::get('/dashboard/main-admin', 'Admin\LandingPageController@index')->name('dashboard_admin');
    
    Route::get('/category/main-category', 'Admin\Category\CategoryController@index')->name('category_admin');
    Route::post('/category/main-category', 'Admin\Category\CategoryController@store')->name('store_category_admin');
    Route::get('/category/update/main-category/{id}', 'Admin\Category\CategoryController@edit')->name('edit_category_admin');
    Route::post('/category/update/main-category/{id}', 'Admin\Category\CategoryController@update');
    Route::get('/category/delete/main-category/{id}', 'Admin\Category\CategoryController@delete')->name('category_delete_admin');

    Route::get('/category/main-subcategory', 'Admin\Category\SubCategoryController@index')->name('subcategory_admin');
    Route::post('/category/main-subcategory', 'Admin\Category\SubCategoryController@store')->name('store_subcategory_admin');
    Route::get('/category/update/main-subcategory/{id}', 'Admin\Category\SubCategoryController@edit')->name('edit_subcategory_admin');
    Route::post('/category/update/main-subcategory/{id}', 'Admin\Category\SubCategoryController@update');
    Route::get('/category/delete/main-subcategory/{id}', 'Admin\Category\SubCategoryController@delete')->name('subcategory_delete_admin');
    
    Route::get('/category/main-merkcategory', 'Admin\Category\MerkCategoryController@index')->name('merkcategory_admin');
    Route::post('/category/main-merkcategory', 'Admin\Category\MerkCategoryController@store')->name('store_merkcategory_admin');
    Route::get('/category/update/main-merkcategory/{id}', 'Admin\Category\MerkCategoryController@edit')->name('edit_merkcategory_admin');
    Route::post('/category/update/main-merkcategory/{id}', 'Admin\Category\MerkCategoryController@update');
    Route::get('/category/delete/main-merkcategory/{id}', 'Admin\Category\MerkCategoryController@delete')->name('merkcategory_delete_admin');

    Route::get('/hands/main-hands', 'Admin\Kepemilikan\HandController@index')->name('hand_admin');
    Route::post('/hands/main-hands', 'Admin\Kepemilikan\HandController@store')->name('store_hand_admin');
    Route::get('/hands/update/main-hands/{id}', 'Admin\Kepemilikan\HandController@edit')->name('edit_hand_admin');
    Route::post('/hands/update/main-hands/{id}', 'Admin\Kepemilikan\HandController@update');
    Route::get('/hands/delete/main-hands/{id}', 'Admin\Kepemilikan\HandController@delete')->name('hand_delete_admin');

    Route::get('/cods/main-cods', 'Admin\TransaksiCod\CodController@index')->name('cods_admin');
    Route::post('/cods/main-cods', 'Admin\TransaksiCod\CodController@store')->name('store_cods_admin');
    Route::get('/cods/update/main-cods/{id}', 'Admin\TransaksiCod\CodController@edit')->name('edit_cods_admin');
    Route::post('/cods/update/main-cods/{id}', 'Admin\TransaksiCod\CodController@update');
    Route::get('/cods/delete/main-cods/{id}', 'Admin\TransaksiCod\CodController@delete')->name('cods_delete_admin');

    Route::get('/wilayah/main-Provinsi', 'Admin\Wilayah\ProvinsiController@index')->name('Provinsi_admin');
    Route::get('/wilayah/main-Kabupaten', 'Admin\Wilayah\KabupatenController@index')->name('kabupaten_admin');
    Route::get('/wilayah/main-Kota', 'Admin\Wilayah\KotaController@index')->name('kota_admin');

    Route::get('/produk/main-produk/publish', 'Admin\StatusProduk\PublishProdukController@index')->name('publish_admin');
    Route::get('/produk/update/main-produk/{id}/publish', 'Admin\StatusProduk\PublishProdukController@edit')->name('edit_publish_admin');
    Route::post('/produk/update/main-produk/{id}/publish', 'Admin\StatusProduk\PublishProdukController@update');

    Route::get('/produk/main-produk/waiting', 'Admin\StatusProduk\WaitingProdukController@index')->name('waiting_admin');
    Route::get('/produk/update/waiting-produk/{id}', 'Admin\StatusProduk\WaitingProdukController@edit')->name('edit_waiting_admin');
    Route::post('/produk/update/waiting-produk/{id}', 'Admin\StatusProduk\WaitingProdukController@update');

    Route::get('/produk/main-produk/unpublish', 'Admin\StatusProduk\UnPublishProdukController@index')->name('unpublish_admin');
    Route::get('/produk/update/main-produk/{id}/unpublish', 'Admin\StatusProduk\UnPublishProdukController@edit')->name('edit_unpublish_admin');
    Route::post('/produk/update/main-produk/{id}/unpublish', 'Admin\StatusProduk\UnPublishProdukController@update');

    Route::get('/order/main-order', 'Admin\Order\OrderController@index')->name('order_admin');
    Route::get('/order/main-order/{id}/update', 'Admin\Order\OrderController@edit')->name('order_edit_waiting_admin');
    Route::post('/order/main-order/{id}/update', 'Admin\Order\OrderController@update')->name('update_order_edit_waiting_admin');

    Route::get('/user/main-user/all', 'Admin\User\UserController@index')->name('user_admin');
    Route::get('userUserRevoke/{id}', array('as'=> 'users.revokeuser', 'uses' => 'Admin\User\UserController@revoke'));
    Route::post('userBan', array('as'=> 'users.ban', 'uses' => 'Admin\User\UserController@ban'));

    Route::post('logout-admin', 'Auth\LoginController@postlogout')->name('logout');

});

