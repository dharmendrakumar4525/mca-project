<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressStoreRequest extends FormRequest
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
            'address_line1' => 'required|max:255',
            'country' => 'required',
            'state' => 'required|',
            'city' => 'required',
            'zip' => 'required|integer',
            "street" => 'required',

        ];;
    }
}
