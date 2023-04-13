<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Rules\DynamicContact;

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
        \Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255',Rule::unique(User::class),new DynamicContact],
            'first_name' => ['required'],
            'password' => $this->passwordRules(),
        ],[/* message bag here*/])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        User::find($user->id)->profile()->create([
            "first_name" => $input['first_name'],
            "last_name" => $input['last_name'],
            "email" => $input['email'],
            "mobile" => $input['mobile']
        ]);


        $user->assignRole('customer');

        return $user;
    }

}
