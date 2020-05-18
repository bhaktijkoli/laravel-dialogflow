<?php

namespace BhaktijKoli\LaravelDialogflow;

class DialogflowResponse {

  /**
  * Request instance.
  *
  * @var BhaktijKoli\LaravelDialogflow\DialogflowRequest
  */
  private $request;

  /**
  * Response Messages.
  *
  * @var array
  */
  public $messages = array();

  /**
  * Dialogflow Request Constructor.
  *
  * @param BhaktijKoli\LaravelDialogflow\DialogflowRequest $request
  * @return void
  */
  public function __construct(DialogflowRequest $request)
  {
    $this->request = $request;
  }

  /**
  * Add Response Data.
  *
  * @param array data
  * @return $this
  */
  public function addData(array $data)
  {
    array_push($this->messages, $data);
    return $this;
  }

  /**
   * Returns the Response as an string.
   *
   * @return string
   */
  public function __toString()
  {
    $response = array(
      'fulfillmentMessages' => array(
        array(
          'payload' => array(
            'richContent' => array(
              $this->messages,
            )
          )
        )
      )
    );
    return json_encode($response);
  }

}
