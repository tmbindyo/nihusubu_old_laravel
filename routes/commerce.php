<?php




Route::group(['domain' => '{portal}.localhost'], function () {

    Route::get('cart', 'Commerce\CommerceController@cart')->name('commerce.cart');
    Route::get('checkout', 'Commerce\CommerceController@checkout')->name('commerce.checkout');
    Route::get('index', 'Commerce\CommerceController@index')->name('commerce.index');
    Route::get('product/details', 'Commerce\CommerceController@productDetail')->name('commerce.product.detail');
    Route::get('shop', 'Commerce\CommerceController@shop')->name('commerce.shop');

});
