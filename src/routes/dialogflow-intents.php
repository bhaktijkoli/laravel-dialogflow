<?php

use BhaktijKoli\LaravelDialogflow\Facades\Fulfillment;

/*
|--------------------------------------------------------------------------
| Dialogflow Fulfillment Intents
|--------------------------------------------------------------------------
|
| Here you may register all of the intents
|
*/

Fulfillment::intent('Default Welcome Intent', 'WelcomeIntentHandler');
