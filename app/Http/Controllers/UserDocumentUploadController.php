<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use Illuminate\Http\Request;


class UserDocumentUploadController extends Controller
{
    /* Upload Document for current user */
    public function __invoke(Request $request)
    {
        $request->validate([
            'type' => 'required|in:1,2',
            'document' => 'required|file|mimes:pdf|max:200'
        ]);


        if(!$request->file('document')->isValid()){
           return back()->dangerBanner('Something went wrong, please try again.'); 
        }
        
        $path = auth()->id().'_'.$request->type.'.'.$request->document->extension(); 
        $path = $request->document->storePubliclyAs('docs',$path);

        UserDocument::updateOrCreate(
            [
                'user_id' => auth()->id(), 
                'type' => $request->input('type')
            ],
            ['doc_path' => $path ]
        );

        return back()->banner('File Uploaded Successfully.');
    }
}
