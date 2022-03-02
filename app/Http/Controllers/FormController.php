<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\FormData;
use App\Mail\FormSubmitSendMail;

class FormController extends Controller
{
    // Public form show
    public function index()
    {
        $forms = Form::where('user_id',auth()->id())->latest()->first();

        if (!$forms) {
            return response()->json(['error' => 'No Public Form Created.!'], 422);
        }
        
        return response()->json(json_decode($forms->fields));
    }

    // Dynamic form data store
    public function store(Request $request)
    {
        foreach ($request->data as $key => $value) {
            $data[] = collect(config('helper.data'))->firstWhere('value',$value);
        }
        $form = Form::create([
            'user_id' => auth()->id(),
            'fields' => json_encode($data),
        ]);

        return response()->json(['datas' => $form->fields]);
    }

    // public form data store
    public function formDataStore(Request $request)
    {

        $form_id = Form::where('user_id',auth()->id())->latest()->first();
        foreach ($request->data as $key => $value) {
            $data[$key] = $value;
        }

        $form = FormData::create([
            'form_id' => $form_id->id,
            'user_datas' => json_encode($data),
        ]);

        \Mail::to(auth()->user()->email)
                ->send(new FormSubmitSendMail($form));

        return response()->json('success');
    }
}
