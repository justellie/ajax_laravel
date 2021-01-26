<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    // Se encarga de POST validando lo que sea necesario 
    public function rules()
    {
        
        $rule_email_unique = Rule::unique('users', 'email');//Valida que sea unico el email
        $rule_documento_unique = Rule::unique('users', 'documento');//Valida que sea el unico el documento 
        if ($this->method() !== 'POST') { //Esto unicamente se ejecuta en caso de ser un Update, ya que no esta previsto otro caso
            
            $rule_email_unique->ignore($this->id);
            $rule_documento_unique->ignore($this->id);
            return [
                'name' => 'required|max:100',
                'lastname' => 'required|max:100',
                'email' => ['required',
                            'email',
                            $rule_email_unique,
                            'max:255'
                ],
                'documento' => ['required',
                                $rule_documento_unique,
                                'numeric',
                                'max:99999999999'],
                'birthday' => 'required|date|before:-15 years',//Valida que minimo sean 15 annos
                'telefono' => 'required|min:8|max:11',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[.@$!%*#?&]/', // must contain a special character
                ],
                
            ];
        }
        else
        {
            return [
                'name' => 'required|max:100',
                'lastname' => 'required|max:100',
                'email' => ['required',
                            'email',
                            $rule_email_unique,
                            'max:255'
                ],
                'documento' => ['required',
                                $rule_documento_unique,
                                'numeric',
                                'max:99999999999'],
                'birthday' => 'required|date|before:-15 years',
                'telefono' => 'required|min:8|max:11',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[.@$!%*#?&]/', // must contain a special character
                ],
                
            ];
        }
    }
}
