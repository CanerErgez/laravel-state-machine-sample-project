<?php


namespace App\Services\PostStateMachine\Transitions;


use App\Models\Post;
use App\Services\PostStateMachine\AfterActions\ExampleAsyncAfterAction;
use App\Services\PostStateMachine\AfterActions\ExampleSyncAfterAction;
use App\Services\PostStateMachine\Guards\CreateValidationGuard;
use Caner\StateMachine\Concerns\BaseTransition;
use Illuminate\Database\Eloquent\Model;

class UnCreatedToDraftTransition extends BaseTransition
{

    public function guards()
    {
        return [
           CreateValidationGuard::class,
        ];
    }

    public function action(): Model
    {
        $validatedRequest = $this->data['validated'];

        $post = (new Post());
        $post->fill($validatedRequest)->save();

        return $post;
    }

    public function afterActions()
    {
        return [
            ExampleSyncAfterAction::class,
            ExampleAsyncAfterAction::class,
        ];
    }
}
