<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Validation\Validator;
use Rees\Sanitizer\Facade as Sanitizer;
use ERR;

abstract class Request extends FormRequest
{
    protected $messages = [];

    public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        Sanitizer::register('sqlorderby', function ($value,$db='mysql') {
            if (empty($value)) return '';
            $leftWrap = $rightWrap= '`';
            if ($db=='sqlserver'){
                $leftWrap = '[';
                $rightWrap = ']';
            }
            if (empty($value)) $sorts = [];
            $sorts = explode(',',$value);
            $value = '';
            foreach($sorts as $sort)
            {
                if(substr($sort,0,1)=='-'){
                    $value .= $leftWrap.substr($sort,1).$rightWrap.' desc,';
                }else{
                    $value .= $leftWrap.substr($sort,0).$rightWrap.' asc,';
                }
            }
            return rtrim($value,',');
        });
    }

    public function rules()
    {
        $httpMethod = strtolower($this->method());
        $method = $httpMethod."Rules";
        if (method_exists($this,$method)){
            return $this->$method();
        }
        return [];
    }

    protected function formatErrors(Validator $validator)
    {
//        parent::formatErrors($validator);
//        var_dump($validator->getMessageBag()->toArray());die;
        $messages = array_merge($this->messages,$validator->errors()->getMessages());
        return $messages;
    }

    public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        return true;
    }

    public function forbiddenResponse()
    {
        // Optionally, send a custom response on authorize failure
        // (default is to just redirect to initial page with errors)
        //
        // Can return a response, a view, a redirect, or whatever else

        return Response::make('Permission denied foo!', 403);
    }

    public function response(array $errors)
    {
        return new JsonResponse(ERR::E(ERR::PARAM,'',$errors),422);
        /*if ($this->ajax() || $this->wantsJson())
		{
			return new JsonResponse($errors, 422);
		}

		return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);*/
    }

    /*public function validator(ValidationService $service)
    {

        $validator = $service->getValidator($this->input());

        // Optionally customize this version using new ->after()
        $validator->after(function() use ($validator) {
            // Do more validation
            $validator->errors()->add('field', 'new error');
        });

        parent::validate();
    }*/

    protected function getRules()
    {

    }
    protected function postRules()
    {

    }
    protected function putRules()
    {

    }
    protected function patchRules()
    {

    }
    protected function deleteRules()
    {

    }
    public function sanitize()
    {

    }
}
