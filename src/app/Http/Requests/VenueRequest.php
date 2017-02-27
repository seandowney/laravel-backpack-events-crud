<?php

namespace SeanDowney\BackpackEventsCrud\app\Http\Requests;

use App\Http\Requests\Request;

class VenueRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'      => 'required|min:5|max:255',
            'slug'       => 'unique:venues,slug,'.\Request::get('id'),
			'descrition' => 'min:5',
            'address1'   => 'min:5|max:100',
            'address2'   => 'min:5|max:100',
            'city'       => 'min:5|max:50',
            'state'      => 'min:5|max:50',
            'postcode'   => 'min:4|max:10',
            'country'    => 'min:3|max:100',
            'url'        => 'url|max:100',
            'phone'      => '|max:30',
            'latitude'   => 'numeric|max:90|min:-90',
            'longitude'  => 'numeric|max:180|min:-180',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
