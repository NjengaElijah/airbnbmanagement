<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    //

    public function index()
    {
        $features = Feature::where(['deleted' => 0])->get();
       
        return view('features.index',compact('features'));
    }
    public function create(Request $request)
    {

        if ($request->isMethod('GET')) {

            return view('partials.modal', [
                'title' => 'Add Feature',
                'action' => route('feature_add'),
                'body' => view('features.create'),
                'submit_text' => 'Save',
            ])->render();
        }
        // dd("..");
        $request->validate(['name' => 'required']);

         Feature::create(
            [
                'name' => $request->name,
                'description' => $request->description??"",
            ]
        );
        // dd($client->fresh());
        return back()->with([
            'success' => 0,
            'msg' => 'feature registered'
        ]);

    }
    public function edit()
    {
    }
    public function delete($id,Request $request)
    {
        $feature = Feature::find($id);

        if ($request->isMethod('GET')) {

            return view('partials.confirm', [
                'action' => route('feature_delete',$id),
                'body' => "Delete feature <b>".$feature->name."</b>",
                'method' => 'DELETE'
            ])->render();
        }
        // dd("..");
        $feature->update(['deleted' => 1]);
        return back()->with([
            'success' => 0,
            'msg' => 'feature deleted'
        ]);

    }
}
