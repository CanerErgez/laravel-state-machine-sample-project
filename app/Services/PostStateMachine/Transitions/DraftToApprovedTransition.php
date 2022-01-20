<?php


namespace App\Services\PostStateMachine\Transitions;


use App\Enums\PostStatus;
use App\Services\PostStateMachine\Guards\CreateValidationGuard;
use Caner\StateMachine\Concerns\BaseTransition;
use Illuminate\Database\Eloquent\Model;

class DraftToApprovedTransition extends BaseTransition
{

    public function guards()
    {
        return [
           CreateValidationGuard::class,
        ];
    }

    public function action(): Model
    {
        $model = $this->baseStateMachine->getModel();

        $datas = array_merge(
            $this->data['validated'],
            [
                'status' => PostStatus::APPROVED,
            ]
        );

        $model->update($datas);

        return $model;
    }

    public function afterActions()
    {
        return [
            //
        ];
    }
}
