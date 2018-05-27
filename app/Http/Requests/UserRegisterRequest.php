<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRegisterRequest
 * @property string password
 * @package App\Http\Requests\Api
 */
class UserRegisterRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users'
        ];
    }
}