<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Credentials File Path
    |--------------------------------------------------------------------------
    |
    | The path of dialogflow credentials file.
    |
    */

    'credentials' => env('DIALOGFLOW_CREDENTIALS', 'google-credentials.json'),

    /*
    |--------------------------------------------------------------------------
    | Project Name
    |--------------------------------------------------------------------------
    |
    | The name of dialogflow project
    |
    */

    'project' => env('DIALOGFLOW_PROJECT', ''),
];
