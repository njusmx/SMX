<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 15/12/1
 * Time: 20:26
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Config;
class UserRegisterRequest extends Request {

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
            //对注册表单提交的信息进行验证
            "name" => ['required','min:3'],
            "password" => ['required','min:3','max:16'],
            "email" => ['required','min:3']
        ];
    }

    public function sanitize()
    {
        return $this->all();
    }

}
