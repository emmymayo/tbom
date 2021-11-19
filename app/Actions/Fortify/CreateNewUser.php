<?php

namespace App\Actions\Fortify;

use App\Models\Mentor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'country' => ['required', Rule::exists('nationalities','id')],
            'qualification' => [Rule::when($input['role']=='mentor','required','nullable'), Rule::exists('qualifications','id')],
            'password' => $this->passwordRules(),
            'dob' => ['nullable', 'date'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        /* Retrieve Role Id based on role input: if none register as mentee */
        $role_id = isset($input['role']) ? Role::firstWhere('name',$input['role'])->id 
                                         : Role::firstWhere('name','mentee')->id ;
        
       $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'username' => $input['username'],
            'nationality_id' => $input['country'], //Form field country DB column nationality_id
            'role_id' => $role_id,
        ]);

        $input['role'] == 'mentor' ? $user->mentor()->create(['qualification_id' => $input['qualification']])
                                   : $user->mentee()->create(['dob' => $input['dob']]);
        return $user;

    }
}
