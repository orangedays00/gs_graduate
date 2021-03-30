<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            //
            'name' => ['required','string','max:50'],
            'email' => ['required','email','max:255'],
            'gender' => ['nullable','string', 'max:10'],
            'prefecture' => ['nullable','string', 'max:5'],
            'birthday' => ['nullable','date'],
            'period' => ['nullable','string', 'max:10'],
            'reasons_admission' => ['nullable', 'string', 'max:500'],
            'selected_mentor' => ['nullable', 'string', 'max:30'],
            'submission_assignments' => ['nullable', 'url'],
            'graduation_project_url' => ['nullable', 'url'],
            'graduation_project_proposal' => ['nullable', 'file'],
            'stressed_gs' => ['nullable', 'string', 'max:500'],
            'avatar' => ['file', 'image'],
        ];
    }
}
