<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateMenteeProfileInformationController extends Controller
{
    // Update Authenticated Mentee profile information
    public function __invoke(Request $request)
    {
        Gate::authorize('mentee-only');

        $request->validate([
            'dob' => 'nullable|date'
        ]);
            
         Mentee::firstWhere('user_id', auth()->id())
                ->forceFill([
                    'dob' => $request->dob
                ])->save();
        return back()->banner('Date of birth Updated Successfully');
    }
}
