<?php

namespace BhaktijKoli\LaravelDialogflow;

use Illuminate\Http\Request;

class Fulfillment
{
  /**
  * All of the intents registered.
  *
  * @var array
  */
  private $intents = array();

  /**
  * Create a url from a string.
  *
  * @param string $name
  * @param string $handler
  * @return void
  */
  public function intent(string $name, string $handler)
  {
    array_push($this->intents, array(
      'name' => $name,
      'handler' => $handler,
    ));
  }

  /**
  * Run Fulfillment Request.
  *
  * @param Illuminate\Http\Request $request
  * @return string
  */
  public function run(Request $request)
  {
    $request = new DialogflowRequest($request);
    $intent = null;
    foreach ($this->intents as $i) {
      if($i['name'] == $request->intentName) {
        $intent = $i;
        break;
      }
    }
    if($intent) {
      $handler = $intent['handler'];
      $class = "App\Dialogflow\Intents\\$handler";
      $instance = new $class();
      $response = $instance->handle($request);
      \Log::info($response);
      return $response;
    }
  }
}
