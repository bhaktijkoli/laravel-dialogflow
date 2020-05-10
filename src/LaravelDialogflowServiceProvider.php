<?php

namespace BhaktijKoli\LaravelDialogflow;

use Illuminate\Support\ServiceProvider;

class LaravelDialogflowServiceProvider extends ServiceProvider
{
  /**
  * Register services.
  *
  * @return void
  */
  public function register()
  {
    $this->app->bind('Fulfillment',function() {
      return new Fulfillment();
    });
  }

  /**
  * Bootstrap services.
  *
  * @return void
  */
  public function boot()
  {
    if(file_exists(base_path('routes/Dialogflow-intents.php'))) {
      require base_path('routes/Dialogflow-intents.php');
    }

    $this->loadRoutesFrom(__DIR__.'/routes/web.php');

    $this->publishes([
      __DIR__.'/routes/Dialogflow-intents.php' => base_path('routes/Dialogflow-intents.php')
    ], 'routes');

    $this->publishes([
      __DIR__.'/app/Dialogflow/Intents/WelcomeIntentHandler.php' => base_path('app/Dialogflow/Intents/WelcomeIntentHandler.php')
    ], 'handler');
  }
}
