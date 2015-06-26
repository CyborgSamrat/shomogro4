<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
    protected $fillable = array('mobileNumber', 'birthday');

	public static $rules = array(
        'mobileNumber'=>'required|digits:11',
        'birthday'=>'required|between:10,10',
		'password'=>'required|alpha_num|between:5,12|confirmed',
		'password_confirmation'=>'required|alpha_num|between:5,12',
		'isActivated'=>'integer'
	);

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	//these functions are just to implement the abstract function to avoid error, Samrat
	public function getReminderEmail()
	{
		return $this->mobileNumber;
	}

    public function getRememberToken(){
        return 0;
    }

    public function setRememberToken($value){
        return 0;
    }


    public function getRememberTokenName(){
        return 0;
    }

}