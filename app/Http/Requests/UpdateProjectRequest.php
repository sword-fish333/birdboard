<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        if(auth()->user()->isNot($this->route('project')->owner)){
//            abort(403);
//        }
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
            'title'=>'sometimes|required',
            'description'=>'sometimes|required|max:150',
            'notes'=>'nullable'
        ];
    }

    public function project(){

        return $this->route('project');
    }

    public function save(){
        $this->project()->update($this->validated());
        return $this->project();
    }
}
