<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'CPF' => ['required', 'string', 'max:11', 'unique:users'],
            'RG' => ['required', 'string', 'max:11'],
            'birth_date' => ['string', 'max:10'],
            'address' => ['string'],
            'number' => ['string'],
            'neighborhood' => ['string'],
            'postal_code' => ['string', 'max:9'],
            'city' => ['string'],
            'state' => ['string'],
            'salary' => ['string'],

            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'CPF' => $input['CPF'],
                'RG' => $input['RG'],
                'birth_date' => $input['birth_date'],
                'address' => $input['address'],
                'number' => $input['number'],
                'neighborhood' => $input['neighborhood'],
                'postal_code' => $input['postal_code'],
                'city' => $input['city'],
                'state' => $input['state'],
                'salary' => $input['salary'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
