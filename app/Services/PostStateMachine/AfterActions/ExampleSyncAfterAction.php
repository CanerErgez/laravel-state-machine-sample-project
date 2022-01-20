<?php


namespace App\Services\PostStateMachine\AfterActions;


use Caner\StateMachine\Concerns\BaseAfterAction;

class ExampleSyncAfterAction extends BaseAfterAction
{
    public function handle()
    {
        if ($this->data['foo'] !== 'bar') {
            throw new \Exception('Data value is not correct.');
        }

        $this->completed();
    }
}
