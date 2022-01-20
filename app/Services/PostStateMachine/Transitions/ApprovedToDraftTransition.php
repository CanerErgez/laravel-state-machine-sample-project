<?php


namespace App\Services\PostStateMachine\Transitions;


use App\Enums\PostStatus;
use Caner\StateMachine\Concerns\BaseTransition;
use Illuminate\Database\Eloquent\Model;

class ApprovedToDraftTransition extends BaseTransition
{

    public function guards()
    {
        return [
           //
        ];
    }

    public function action(): Model
    {
        $model = $this->baseStateMachine->getModel();

        $model->update([
            'status' => PostStatus::DRAFT,
        ]);

        return $model;
    }

    public function afterActions()
    {
        return [
            //
        ];
    }
}
