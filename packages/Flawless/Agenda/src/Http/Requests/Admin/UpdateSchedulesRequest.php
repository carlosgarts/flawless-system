<?php
namespace Flawless\Agenda\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchedulesRequest extends FormRequest
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
            'start_time' => 'required|date_format:H:i:s',
            'finish_time' => 'date_format:H:i:s',
        ];
    }
}
