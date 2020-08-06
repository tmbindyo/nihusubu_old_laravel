<?php




Route::group(['domain' => '{portal}.localhost'], function () {

    Route::get('cart', 'Commerce\CommerceController@cart')->name('commerce.cart');
    Route::get('checkout', 'Commerce\CommerceController@checkout')->name('commerce.checkout');
    Route::get('index', 'Commerce\CommerceController@index')->name('commerce.index');
    Route::get('product/detail/{product_id}', 'Commerce\CommerceController@productDetail')->name('commerce.product.detail');
    Route::get('shop', 'Commerce\CommerceController@shop')->name('commerce.shop');


    Route::post('/add/cart/{product_id}', 'Commerce\CommerceController@addToCart')->name('add.cart');
    Route::post('/update/cart/{item_id}', 'Commerce\CommerceController@updateCart')->name('update.cart');
    Route::get('/subtract/cart/item/quantity/{item_id}', 'Commerce\CommerceController@subtractCartItemQuantity')->name('subtract.cart.item.quantity');
    Route::get('/add/cart/item/quantity/{item_id}', 'Commerce\CommerceController@addCartItemQuantity')->name('add.cart.item.quantity');
    Route::get('/remove/item/{item_id}', 'Commerce\CommerceController@removeItem')->name('remove.item');
    Route::get('/clear/cart', 'Commerce\CommerceController@clearCart')->name('clear.cart');

    Route::post('/user/checkout', 'Commerce\CommerceController@checkoutStore')->name('commerce.user.checkout');
});
