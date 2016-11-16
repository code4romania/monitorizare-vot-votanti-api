<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreIncidentRequest extends Request
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
            'first_name' => 'required|max:200',
            'last_name' => 'required|max:200',
            'incidentType' => 'required',
            'description' => 'required|max:1000',
            'county' => 'required',
            'city' => 'required',
            'station_number' => 'required'
        ];
    }
}
