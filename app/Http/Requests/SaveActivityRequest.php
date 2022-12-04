<?php

namespace App\Http\Requests;

use App\Models\ReferenceCulturalRights;
use App\Models\ReferenceExpertises;
use App\Utilities\Resources;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SaveActivityRequest extends FormRequest
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
            'nombre_esm' => Resources::getUpperString($this->activity_name),
            'start_time' => Resources::getUpperString($this->start_time),
            'final_hour' => Resources::getUpperString($this->final_hour)
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'activity_name' => ['bail','required','string','min:5','max:255'],
            'activity_date' => ['bail','required','date_format:Y-m-d'],
            'start_time' => ['bail','required','date_format:g:i A'],
            'final_hour' => ['bail','required','date_format:g:i A','after:start_time'],
            'cultural_rights' => ['bail','required','numeric',Rule::exists(ReferenceCulturalRights::class,'id')],
            'nac_id' => ['bail','required','numeric',Rule::exists(ReferenceCulturalRights::class,'id')],
            'expertise_id' => ['bail','required','numeric',Rule::exists(ReferenceExpertises::class,'id')],

        ];
    }
    public function messages(){
        return [
            'start_time.date_format' => 'La :attribute no corresponde al formato HH:MM AM-PM (1:30 PM)',
            'final_hour.date_format' => 'La :attribute no corresponde al formato HH:MM AM-PM (10:00 PM)'
        ];
    }
    public function attributes()
    {
        return [
            'activity_name' => 'NOMBRE ACTIVIDAD',
            'activity_date' => 'FECHA',
            'start_time' => 'HORA INICIO',
            'final_hour' => 'HORA FINAL',
            'cultural_rights' => 'DERECHOS CULTURALES',
            'nac_id' => 'NAC',
            'expertises' => 'EXPERTICIA'
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
