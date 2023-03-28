<?php

namespace Modules\Media\Http\Requests\Admin;

use Modules\Core\Http\Requests\BaseApiRequest;

class ListRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'path' => 'nullable|string|max:255'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
