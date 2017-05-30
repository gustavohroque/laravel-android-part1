<?php

namespace SON\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillPayRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'date_due' => 'required|date',
            'value' => 'required|numeric',
            // Valida se o category id existe no banco de dados
            'category_id' => 'required|exists:categories,id',
        ];

        // caso o método HTTP seja um put(update) força o preenchimento do done
        if($this->isMethod('put')){
            $rules = [
                'done' => 'required|boolean',
            ];
        }

        return $rules ;
    }
}
