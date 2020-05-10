<?php

namespace BhaktijKoli\LaravelDialogflow;

class DialogflowQuickResponse {

  /**
  * Response array.
  *
  * @var array
  */
  private $response;

  /**
  * Dialogflow Quick Response Constructor.
  *
  * @param string $message
  * @return void
  */
  public function __construct(string $message)
  {
    $this->response = array(
      'fulfillmentMessages' => array(
        array(
          'text' => array(
            'text' => array(
              $message
            )
          )
        )
      )
    );
  }

  /**
   * Returns the Response as an string.
   *
   * @return string
   */
  public function __toString()
  {
    return json_encode($this->response);
  }

}
