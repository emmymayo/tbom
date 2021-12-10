<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserDocumentDownloadController extends Controller
{
    public function __invoke(Request $request, UserDocument $user_document)
    {
        return Storage::download($user_document->doc_path);
         
    }
}
