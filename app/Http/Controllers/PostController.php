<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostStateMachine\PostStateMachine;
use App\Services\PostStateMachine\States\DraftState;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $postStateMachine = new PostStateMachine();

        //$postStateMachine->getPossibleTransitions();
        $postStateMachine->transitionTo(DraftState::class, $request);

        return response()->json(['success' => true]);
    }

    public function update(Post $post, Request $request)
    {
        $exampleData = ['foo' => 'bar'];

        $post->state(PostStateMachine::class, 'status')
            ->transitionTo($request->target, $request, $exampleData);
    }
}
