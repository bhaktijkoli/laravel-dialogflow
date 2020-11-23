<?php

namespace BhaktijKoli\LaravelDialogflow\Commands;

use Illuminate\Console\Command;

class DialogflowInstall extends Command
{
  /**
  * The name and signature of the console command.
  *
  * @var string
  */
  protected $signature = 'dialogflow:install';

  /**
  * The console command description.
  *
  * @var string
  */
  protected $description = 'Install dialogflow required resources.';

  /**
  * Create a new command instance.
  *
  * @return void
  */
  public function __construct()
  {
    parent::__construct();
  }

  /**
  * Execute the console command.
  *
  * @return mixed
  */
  public function handle()
  {
    $this->call('vendor:publish', [
      '--provider' => 'BhaktijKoli\LaravelDialogflow\LaravelDialogflowServiceProvider',
    ]);
  }
}
