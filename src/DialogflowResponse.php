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
  private $messages = array();

  /**
  * Response Followup Event Input.
  *
  * @var array
  */
  private $followupEventInput = array();

  /**
  * Response Output Contexts.
  *
  * @var array
  */
  private $outputContexts = array();

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
  * Add Response Output Context.
  *
  * @param string context_name
  * @param array params
  * @param int lifespan
  * @return $this
  */
  public function addOutputContext(string $context_name, array $params = array(), int $lifespan = 5)
  {
    $data = [
      'name' => $this->request->session . "/contexts/$context_name",
      'lifespanCount' => $lifespan,
    ];
    if(count($params) > 0) {
      $data['parameters'] = $params;
    }
    array_push($this->outputContexts, $data);
    return $this;
  }

  /**
  * Add Response Followup Event Input.
  *
  * @param string name
  * @param array params
  * @return $this
  */
  public function followupEvent(string $name, array $params)
  {
    $data = [
      'name' => $name,
    ];
    if(count($params) > 0) {
      $data['parameters'] = $params;
    }
    $this->followupEventInput = $data;
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
      ),
      'outputContexts' => $this->outputContexts,
      'followupEventInput' => $this->followupEventInput
    );
    return json_encode($response);
  }

}
