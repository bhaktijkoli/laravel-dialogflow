<?php

use Illuminate\Http\Request;
use BhaktijKoli\LaravelDialogflow\Facades\Fulfillment;

Route::post('/webhook', function(Request $request) {
  return Fulfillment::run($request);
});
