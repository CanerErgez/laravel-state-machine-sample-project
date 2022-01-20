<?php


namespace App\Services\PostStateMachine\Guards;


use Caner\StateMachine\Concerns\BaseGuard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateValidationGuard extends BaseGuard
{

    public function check(): BaseGuard
    {
        $validator = Validator::make($this->request->all(), $this->rules());

        if ($validator->fails()) {
            Log::error(json_encode($validator->errors()->first()));

            $this->data = [
                'result'    => false,
                'error'     => $validator->errors()->first(),
            ];
        }

        $this->data = [
            'result'        => true,
            'data'          => [
                'validated'     => $validator->validated(),
                'foo'           => 'bar',
            ]

        ];

        return $this;
    }

    public function rules(): array
    {
        return [
            'title'     => ['required', 'min:5'],
            'content'   => ['required', 'min:5'],
        ];
    }
}
