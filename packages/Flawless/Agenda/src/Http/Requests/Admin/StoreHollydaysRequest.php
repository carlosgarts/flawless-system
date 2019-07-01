<?php
namespace Flawless\Agenda\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreHollydaysRequest extends FormRequest
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
          'name' => 'required',
          'day' => 'date_format:Y-m-d',
        ];
    }
}
