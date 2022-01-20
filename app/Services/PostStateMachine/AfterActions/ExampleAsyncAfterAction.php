<?php


namespace App\Services\PostStateMachine\AfterActions;


use App\Jobs\ExampleJob;
use Caner\StateMachine\Concerns\BaseAfterAction;

class ExampleAsyncAfterAction extends BaseAfterAction
{
    public function handle()
    {
        ExampleJob::dispatch();

        $this->completed();
    }
}
