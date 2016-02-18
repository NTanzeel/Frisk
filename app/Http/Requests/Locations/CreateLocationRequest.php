<?php

namespace App\Http\Requests\Locations;

use App\Http\Requests\Request;

class CreateLocationRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_address_line'    => 'required|string|min:6',
            'second_address_line'   => 'string|min:6',
            'city'                  => 'required|string|min:3|max:50',
            'region'                => 'required|string|min:3|max:50',
            'postcode'              => 'required|string|min:7|max:8'
        ];
    }
}
