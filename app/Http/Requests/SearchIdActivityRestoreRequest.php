<?php

namespace App\Http\Requests;

use App\Models\Activity;
use App\Utilities\Resources;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SearchIdActivityRestoreRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
            'search' => Resources::getUpperString($this->query('search')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['bail','required','integer','exists:pgsql.tst_activity,id']

        ];
    }

    public function attributes()
    {
        return [
            'id' => 'La actividad'
        ];
    }


    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->first(),
            'code' => 422,
            'data' =>[]
        ], 200));
    }
}
