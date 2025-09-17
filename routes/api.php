<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Quick Service Request
    Route::apiResource('quick-service-requests', 'QuickServiceRequestApiController');

    // Highlights
    Route::post('highlights/media', 'HighlightsApiController@storeMedia')->name('highlights.storeMedia');
    Route::apiResource('highlights', 'HighlightsApiController');

    // Core Services
    Route::post('core-services/media', 'CoreServicesApiController@storeMedia')->name('core-services.storeMedia');
    Route::apiResource('core-services', 'CoreServicesApiController');

    // Catalogue Category
    Route::apiResource('catalogue-categories', 'CatalogueCategoryApiController');

    // Catalogu Data
    Route::post('catalogu-datas/media', 'CataloguDataApiController@storeMedia')->name('catalogu-datas.storeMedia');
    Route::apiResource('catalogu-datas', 'CataloguDataApiController');

    // Privacy Policy
    Route::post('privacy-policies/media', 'PrivacyPolicyApiController@storeMedia')->name('privacy-policies.storeMedia');
    Route::apiResource('privacy-policies', 'PrivacyPolicyApiController');

    // Terms Conditions
    Route::post('terms-conditions/media', 'TermsConditionsApiController@storeMedia')->name('terms-conditions.storeMedia');
    Route::apiResource('terms-conditions', 'TermsConditionsApiController');

    // Locations
    Route::apiResource('locations', 'LocationsApiController');

    // Company Details
    Route::apiResource('company-details', 'CompanyDetailsApiController');

    // Contact Us Messages
    Route::apiResource('contact-us-messages', 'ContactUsMessagesApiController');
});
