<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAdvertRequest
 * @package App\Http\Requests\Api
 */
class CreateAdvertRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'price' => 'numeric',
            'image' => 'image'
        ];
    }
}