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

// change language routes
Route::get('locale/{locale}', function ($locale)
{
    Session::put('locale', $locale);
    return redirect()->back();
});

// front routes
Auth::routes();

Route::get('/clearcache185', function () {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";
});

Route::get('/', 'HomeController@index')->name('home');
Route::post('/sendemail', 'HomeController@store');
Route::post('/register', 'HomeController@register')->name('register');
Route::post('/login', 'HomeController@login')->name('login');
Route::get('forgotpassword','HomeController@forgotpassword');
Route::post('forgotpass','HomeController@forgotpass')->name('send_code');
Route::get('activation','HomeController@activation');
Route::post('activation_code','HomeController@activation_code')->name('using_code');
// Route::get('account_activation','HomeController@account_activation');
// Route::post('activat_account','HomeController@activat_account');
Route::get('rechangepassword','HomeController@rechangepassword');
Route::post('rechangepass','HomeController@rechangepass')->name('rechangepass');
Route::resource('contactus','contactController');
Route::get('aboutus','HomeController@aboutus');
Route::get('privacy','HomeController@privacy');
Route::get('policy','HomeController@policy');
Route::get('shipping','HomeController@shipping');
Route::get('bankaccounts','HomeController@bankaccounts');
Route::resource('cart','cartController');
Route::get('cartdelete/{id}','cartController@delete');
Route::get('cartdeleteall','cartController@deleteall');

Route::resource('items','itemController');
Route::get('items_filter/{id}','itemController@filter');
Route::get('mostsold','HomeController@mostsold');
Route::resource('categories','categoryController');
Route::get('subcategories/{id}','categoryController@show1');


Route::group(['middleware' => ['auth:web']], function () 
{
    Route::resource('profile','profileController');
    Route::get('myorders','profileController@index2');
    Route::get('myfavorites','profileController@index3');
    Route::get('mynotification','profileController@index4');
    Route::get('mybills','profileController@index5');
    Route::get('orders/{id}','profileController@showorder');
    Route::get('returnorder/{id}','profileController@returnorder');
    Route::get('returnorders','profileController@returnorders');
    Route::get('mycredit','profileController@mycredit');
    Route::post('addtowishlist','HomeController@addtowishlist');
    Route::post('removefromwishlist/{id}','HomeController@removefromwishlist');
    Route::post('checkout','cartController@checkout');
    Route::post('shipping','cartController@shipping');
    Route::get('banktransfer/{id}','profileController@banktransfer');
    Route::post('sendbanktransfer/{id}','profileController@sendbanktransfer');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    // Route::get('logout', 'profileController@logout');
});



//admin routes
Route::resource('adminpanel/','adminloginController');  
Route::group(['middleware' => ['adminauth:admin']], function () 
{
  Route::resource('adminpanel/users','adminmemberController');
  Route::delete('myusersDeleteAll', 'adminmemberController@deleteAll');
  Route::resource('adminpanel/provider','providerController');
  Route::resource('adminpanel/about','adminaboutController');
  Route::resource('adminpanel/privacy','adminprivacyController');
  Route::resource('adminpanel/conditions','adminconditionsController');
  Route::resource('adminpanel/setapp','adminchangelogoController');
  Route::resource('adminpanel/items','adminitemController');
  Route::delete('myitemssDeleteAll', 'adminitemController@deleteAll');
  Route::resource('adminpanel/bills','adminillController');
  Route::resource('adminpanel/orders','adminorderController');
  Route::get('adminpanel/returnorders','adminorderController@index1');
  Route::delete('myordersDeleteAll', 'adminorderController@deleteAll');
  Route::get('adminpanel/itemrates/{id}','adminitemController@showrates');
  Route::resource('adminpanel/contactus','admincontactController');
  Route::delete('mycontactsDeleteAll', 'admincontactController@deleteAll');
  Route::resource('adminpanel/transfers','admintransferController');
  Route::delete('mytransferDeleteAll', 'admintransferController@deleteAll');
  Route::get('adminpanel/adcomments/{id}','adminadController@showcomments');
  Route::get('adminpanel/adrates/{id}','adminadController@showrates');
  Route::resource('adminpanel/sliders','adminsliderController');
  Route::delete('mysliderDeleteAll', 'adminsliderController@deleteAll');
  Route::resource('adminpanel/categories','admincategoryController');
  Route::resource('adminpanel/subcategories','adminsubcategoryController');
  Route::delete('mycategoriesDeleteAll', 'admincategoryController@deleteAll');
    
});

//admin logout
Route::Delete('adminpanel/{id}','adminloginController@destroy');


