<?php

namespace Niework;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Niework\Models\Country as Country;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    public static $defaultAvatar = 'default.jpg';
    protected $fillable = [
        'name', 'email', 'password', 'birth_date', 'country_id',
    ];
    protected $hidden = [
        'password', 'remember_token', 'avatar',
    ];

    public function posts() {
        return $this->hasMany('Niework\Models\Post', 'author_id', 'id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (gettype($name) == "string") {
            $this->name = $name;
        }
    }

    public function getEmailAddress()
    {
        return $this->email;
    }

    public function setEmailAddress($email)
    {
        if (gettype($email) == "string") {
            $this->email = $email;
        }
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

    public function setBirthdate($dateString)
    {
        $date = date_create($dateString);
        if ($date) {
            $this->birth_date = $date;
        }
    }

    public function countrySelected()
    {
        return Country::validCountryId($this->country_id);
    }

    public function getCountry()
    {
        return Country::getCountryById($this->country_id);
    }

    public function getCountryId()
    {
        if ($this->countrySelected()) {
            return $this->country_id;
        }
        return 0;
    }

    public function setCountryId($id)
    {
        if (Country::isCountryId($id)) {
            $this->country_id = $id;
        }
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($hash_name)
    {
        if (gettype($hash_name) == "string") {
            $this->avatar = $hash_name;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($pass)
    {
        $this->password = Hash::make($pass);
    }
}
