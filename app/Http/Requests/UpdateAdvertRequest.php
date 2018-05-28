<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAdvertRequest
 * @package App\Http\Requests\Api
 */
class UpdateAdvertRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|max:255',
            'price' => 'numeric',
            'image' => 'image'
        ];
    }
}