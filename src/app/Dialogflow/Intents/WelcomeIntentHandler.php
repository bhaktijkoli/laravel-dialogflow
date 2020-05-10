<?php
namespace App\Dialogflow\Intents;

use BhaktijKoli\LaravelDialogflow\IntentHandler;
use BhaktijKoli\LaravelDialogflow\DialogflowRequest;
use BhaktijKoli\LaravelDialogflow\DialogflowQuickResponse;

class WelcomeIntentHandler extends IntentHandler
{

  /**
  * Handle Dialogflow Request.
  *
  * @param BhaktijKoli\LaravelDialogflow\DialogflowRequest $request
  * @return mixed
  */
  public function handle(DialogflowRequest $request)
  {
    return new DialogflowQuickResponse('Hello, How are you?');
  }

}
