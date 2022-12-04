<?php

namespace App\Http\Requests;

use App\Models\ReferenceExpertises;
use App\Utilities\Resources;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;


class SearchIdExpertiseRequest extends FormRequest
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
            'id' => ['bail','required','integer',Rule::exists(ReferenceExpertises::class,'id')],
            'search' => ['bail','nullable','string','max:60'],
        ];
    }

    public function attributes()
    {
        return [
            'search' => 'Campo de Busquedad',
            'id' => 'La Experticia'
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
