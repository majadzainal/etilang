<?php

namespace App\Actions\Fortify;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'user_level' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->validate();
        
        DB::beginTransaction();
        try 
        {
            $user = User::create([
                    'username' => $input['username'],
                    'email' => $input['email'],
                    'user_level' => $input['user_level'],
                    'password' => Hash::make($input['password']),
                ]);
            $petugas = Petugas::create([
                    'user_id' => $user->id,
                    'nik' => '',
                    'name' => '',
                    'tempat_lahir' => '',
                    'tanggal_lahir' => Carbon::now(),
                    'jenis_kelamin' => 'laki-laki',
                    'alamat' => '',
                    'agama' => '',
                    'status_perkawinan' => '',
                ]);
            
            if ($user && $petugas) { DB::commit(); } else { DB::rollBack(); }
        }
        catch (Exception $e) { DB::rollBack(); }

        return $user;
    }
}
