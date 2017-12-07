<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Socialite\Contracts\User as ProviderUser;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Creating user by social account's data
	 *
	 * @param ProviderUser $providerUser
	 */
	public static function createBySocialProvider(ProviderUser $providerUser){
		self::create([
			'name' => $providerUser->getName(),
			'email' => $providerUser->getEmail(),
			'password' => $providerUser->getId()
		]);
	}
}
