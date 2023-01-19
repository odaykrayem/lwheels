<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreContestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prize' => ['required'],
            'description' => ['required'],
            'duration' => ['required'],
            // 'is_finished' => ['required']
        ];
    }

    //this function will be used when we have some keys not similar to db column name
    // protected function prepareForValidation(){
    //   $this->merge(
    //     [
    //         'is_finished' => $this->is_finished
    //     ]
    //   );
    // }
}
