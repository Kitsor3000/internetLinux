<?php

declare(strict_types=1);

namespace App\Http\Requests\GamePeriod;

use App\Enum\GamePeriodStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GamePeriodStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'duration_weeks' => [
                'required',
                'integer',
                'min:1',
            ],
//            'status' => [
//                'required',
//                Rule::in(GamePeriodStatusEnum::DRAFT),
//            ],
        ];
    }
}
