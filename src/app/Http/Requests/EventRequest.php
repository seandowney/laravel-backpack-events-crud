<?php

namespace SeanDowney\BackpackEventsCrud\app\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'            => 'required|min:5|max:255',
            'slug'             => 'unique:events,slug,'.\Request::get('id'),
            'speaker'          => 'min:5|max:100',
            'start_time'       => 'required|date_format:"Y-m-d H:i:s"',
            'end_time'         => 'date_format:"Y-m-d H:i:s"',
            'body'             => 'required|min:5',
            'ticket_vendor'    => 'numeric',
            'ticket_vendor_id' => 'numeric',
            'venue_id'         => 'numeric',
            'meta_description' => 'max:255',
            'status'           => 'required|in:0,1',
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
