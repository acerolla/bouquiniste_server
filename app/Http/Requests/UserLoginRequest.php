<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserLoginRequest
 * @package App\Http\Requests\Api
 */
class UserLoginRequest extends FormRequest
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
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|max:255'
        ];
    }
}