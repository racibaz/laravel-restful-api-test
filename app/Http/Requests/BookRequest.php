<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => [
                        'required',
                        'max:255',
                        'unique:books'
                    ],
                    'ISBN' => 'max:255|nullable',
                    'description' => 'max:255|nullable',
                    'status' => 'boolean',
                ];
            }
            case 'PUT':
            case 'PATCH': {

                //Another way wrong for api test.
                $segments = request()->segments();
                $record_id  = end($segments);

                return [
                    'name' => [
                        'nullable',
                        'max:255',
                        "unique:books,name,{$record_id}"
                    ],
                    'ISBN' => 'max:255|nullable',
                    'description' => 'max:255|nullable',
                    'status' => 'nullable|boolean',
                ];
            }
            default:
                break;
        }
    }
}
