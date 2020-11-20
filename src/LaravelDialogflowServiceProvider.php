<?php

namespace BhaktijKoli\LaravelDialogflow;

use Illuminate\Support\ServiceProvider;
use BhaktijKoli\LaravelDialogflow\Commands\DialogflowIntent;
use BhaktijKoli\LaravelDialogflow\Commands\DialogflowInstall;

class LaravelDialogflowServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('Fulfillment', function () {
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
    if (file_exists(base_path('routes/dialogflow-intents.php'))) {
      require base_path('routes/dialogflow-intents.php');
    }

    if ($this->app->runningInConsole()) {
      $this->commands([
        DialogflowInstall::class,
        DialogflowIntent::class
      ]);
    }

    $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

    $this->publishes([
      __DIR__ . '/config/dialogflow.php' => config_path('dialogflow.php'),
    ]);

    $this->publishes([
      __DIR__ . '/routes/dialogflow-intents.php' => base_path('routes/dialogflow-intents.php')
    ], 'routes');

    $this->publishes([
      __DIR__ . '/app/Dialogflow/Intents/WelcomeIntentHandler.php' => base_path('app/Dialogflow/Intents/WelcomeIntentHandler.php')
    ], 'handler');
  }
}
