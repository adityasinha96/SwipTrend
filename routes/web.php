<?php

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ServicesController;

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Quick Service Request
    Route::delete('quick-service-requests/destroy', 'QuickServiceRequestController@massDestroy')->name('quick-service-requests.massDestroy');
    Route::resource('quick-service-requests', 'QuickServiceRequestController');

    // Highlights
    Route::delete('highlights/destroy', 'HighlightsController@massDestroy')->name('highlights.massDestroy');
    Route::post('highlights/media', 'HighlightsController@storeMedia')->name('highlights.storeMedia');
    Route::post('highlights/ckmedia', 'HighlightsController@storeCKEditorImages')->name('highlights.storeCKEditorImages');
    Route::resource('highlights', 'HighlightsController');

    // Core Services
    Route::delete('core-services/destroy', 'CoreServicesController@massDestroy')->name('core-services.massDestroy');
    Route::post('core-services/media', 'CoreServicesController@storeMedia')->name('core-services.storeMedia');
    Route::post('core-services/ckmedia', 'CoreServicesController@storeCKEditorImages')->name('core-services.storeCKEditorImages');
    Route::resource('core-services', 'CoreServicesController');

    // Catalogue Category
    Route::delete('catalogue-categories/destroy', 'CatalogueCategoryController@massDestroy')->name('catalogue-categories.massDestroy');
    Route::resource('catalogue-categories', 'CatalogueCategoryController');

    // Catalogu Data
    Route::delete('catalogu-datas/destroy', 'CataloguDataController@massDestroy')->name('catalogu-datas.massDestroy');
    Route::post('catalogu-datas/media', 'CataloguDataController@storeMedia')->name('catalogu-datas.storeMedia');
    Route::post('catalogu-datas/ckmedia', 'CataloguDataController@storeCKEditorImages')->name('catalogu-datas.storeCKEditorImages');
    Route::resource('catalogu-datas', 'CataloguDataController');

    // Privacy Policy
    Route::delete('privacy-policies/destroy', 'PrivacyPolicyController@massDestroy')->name('privacy-policies.massDestroy');
    Route::post('privacy-policies/media', 'PrivacyPolicyController@storeMedia')->name('privacy-policies.storeMedia');
    Route::post('privacy-policies/ckmedia', 'PrivacyPolicyController@storeCKEditorImages')->name('privacy-policies.storeCKEditorImages');
    Route::resource('privacy-policies', 'PrivacyPolicyController');

    // Terms Conditions
    Route::delete('terms-conditions/destroy', 'TermsConditionsController@massDestroy')->name('terms-conditions.massDestroy');
    Route::post('terms-conditions/media', 'TermsConditionsController@storeMedia')->name('terms-conditions.storeMedia');
    Route::post('terms-conditions/ckmedia', 'TermsConditionsController@storeCKEditorImages')->name('terms-conditions.storeCKEditorImages');
    Route::resource('terms-conditions', 'TermsConditionsController');

    // Locations
    Route::delete('locations/destroy', 'LocationsController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationsController');

    // Company Details
    Route::delete('company-details/destroy', 'CompanyDetailsController@massDestroy')->name('company-details.massDestroy');
    Route::resource('company-details', 'CompanyDetailsController');

    // Contact Us Messages
    Route::delete('contact-us-messages/destroy', 'ContactUsMessagesController@massDestroy')->name('contact-us-messages.massDestroy');
    Route::resource('contact-us-messages', 'ContactUsMessagesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

//Frontend Controller

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services');

