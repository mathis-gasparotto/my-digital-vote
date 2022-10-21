<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class StoreUserFormRequest extends FormRequest
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
            'firstname' => [
                'required',
                'string',
                'max:191',
            ],
            'lastname' => [
                'required',
                'string',
                'max:191',
            ],
            'email' => [
                'required',
                'email',
                'max:191',
                'unique:users',
                ],
            'password' => [
                'required',
                'max:191',
                'confirmed',
                Password::min(4)
                    -> letters(),
                    //->uncompromised(),
                ],
            'role' => [
                'required',
                new Enum(RoleEnum::class),
            ],
        ];
    }
}
