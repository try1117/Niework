<?php

namespace Niework;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Niework\Models\Country as Country;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birth_date', 'country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmailAddress()
    {
        return $this->email;
    }

    public function getRegistrationDateTime()
    {
        return $this->created_at;
    }

    public function getRegistrationDate()
    {
        return ($this->created_at)->format('Y-m-d');
    }

    public function birthDateSelected()
    {
        return boolval($this->birth_date);
    }

    public function getBirthdate()
    {
        return $this->birth_date;
    }

    public function countrySelected()
    {
        return Country::validCountryId($this->country_id);
    }

    public function getCountry()
    {
        return Country::getCountryById($this->country_id);
    }

    public function getAvatar()
    {
        return $this->avatar;
    }
}
