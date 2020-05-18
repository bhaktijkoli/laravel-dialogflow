<?php

namespace BhaktijKoli\LaravelDialogflow;

use Illuminate\Http\Request;

class DialogflowRequest {

  /**
  * Request instance.
  *
  * @var Illuminate\Http\Request
  */
  private $request;

  /**
  * Dialogflow Response Id.
  *
  * @var string
  */
  public $responseId;

  /**
  * Dialogflow Session.
  *
  * @var string
  */
  public $session;

  /**
  * Dialogflow Query Result.
  *
  * @var array
  */
  public $queryResult;

  /**
  * Dialogflow Parameters.
  *
  * @var array
  */
  public $parameters;

  /**
  * Dialogflow Intent name.
  *
  * @var string
  */
  public $intentName;

  /**
  * Dialogflow Request Constructor.
  *
  * @param Illuminate\Http\Request $request
  * @return void
  */
  public function __construct(Request $request)
  {
    $this->request = $request;
    $this->responseId = $request->input('responseId');
    $this->session = $request->input('session');
    $this->queryResult = $request->input('queryResult');
    $this->parameters = $this->queryResult['parameters'];
    $this->intentName = $this->queryResult['intent']['displayName'];
  }

}
