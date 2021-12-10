<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateMentorProfileInformationController extends Controller
{
    public function __invoke(Request $request)
    {
        Gate::authorize('mentor-only');

         $request->validate([
                    'title' => 'nullable|string|max:255',
                    'qualification_id' => 'required|exists:qualifications,id',
                    'annual_mentees' => 'nullable|numeric',
                    'mentorship_schedule' => 'nullable|string|max:255',
                    'preffered_platform' => 'nullable|string|max:255',
                    'about_me' => 'nullable|string',
                ]);
           
        Mentor::firstWhere('user_id', auth()->id())
                ->forceFill([
                    'title' => $request->title,
                    'qualification_id' => $request->qualification_id,
                    'annual_mentees' => $request->annual_mentees,
                    'mentorship_schedule' => $request->mentorship_schedule,
                    'preffered_platform' => $request->preffered_platform,
                    'about_me' => $request->about_me,
                ])->save();
        return back()->banner('Profile Updated Successfully');
    }
}
