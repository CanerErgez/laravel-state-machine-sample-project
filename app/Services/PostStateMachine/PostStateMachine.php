<?php


namespace App\Services\PostStateMachine;


use App\Enums\PostStatus;
use App\Services\PostStateMachine\States\ApprovedState;
use App\Services\PostStateMachine\States\DraftState;
use App\Services\PostStateMachine\States\NeedChangesState;
use App\Services\PostStateMachine\Transitions\ApprovedToDraftTransition;
use App\Services\PostStateMachine\Transitions\DraftToApprovedTransition;
use App\Services\PostStateMachine\Transitions\DraftToNeedChangesTransition;
use App\Services\PostStateMachine\Transitions\NeedChangesToApprovedTransition;
use App\Services\PostStateMachine\Transitions\UnCreatedToDraftTransition;
use Caner\StateMachine\Concerns\BaseStateMachine;

class PostStateMachine extends BaseStateMachine
{

    public function initialState()
    {
        return DraftState::class;
    }

    public function states()
    {
        return [
            PostStatus::DRAFT               => DraftState::class,
            PostStatus::NEED_CHANGES        => NeedChangesState::class,
            PostStatus::APPROVED            => ApprovedState::class,
        ];
    }

    public function transitions()
    {
        return [
            self::class => [
                $this->initialState()   => UnCreatedToDraftTransition::class,
            ],
            DraftState::class => [
                NeedChangesState::class => DraftToNeedChangesTransition::class,
                ApprovedState::class    => DraftToApprovedTransition::class,
            ],
            NeedChangesState::class => [
                ApprovedState::class    => NeedChangesToApprovedTransition::class,
            ],
            ApprovedState::class => [
                DraftState::class       => ApprovedToDraftTransition::class,
            ],
        ];
    }
}
