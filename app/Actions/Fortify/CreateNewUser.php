<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use QR_Code\Types\vCard\Phone;

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
            'password' => $this->passwordRules(),
            'telephone' => ['required', 'integer', 'unique:users'],
            'sexe' => ['required', 'string', 'max:2'],
            'adresse' => ['required', 'string', 'max:250'],
            'num_carte_identite' => ['required', 'integer', 'unique:users'],
            // 'profil' => ['string', 'max:10'],
            // 'etat' => ['string', 'max:2'],
            // 'pointdeventes_id' => ['integer',  'max:8'],

            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'telephone' => $input['telephone'],
            'sexe' => $input['sexe'],
            'adresse' => $input['adresse'],
            'num_carte_identite' => $input['num_carte_identite'],
            // 'pointdeventes_id' => $input['pointdeventes_id'],
        ]);
    }
}
