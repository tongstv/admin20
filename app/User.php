<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mpociot\Firebase\SyncsWithFirebase;
class User extends \TCG\Voyager\Models\User
{
    use Notifiable, SyncsWithFirebase;

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
    
    
    public function addNew($input)
{
    $check = static::where('facebook_id',$input['facebook_id'])->first();

    if(is_null($check)){
        return static::create($input);
    }

    return $check;
    
}



 public function addNewgoogle($input)

    {

        $check = static::where('google_id',$input['google_id'])->first();



        if(is_null($check)){

            return static::create($input);

        }



        return $check;

    }
    
}
