<?php

namespace App\Sancofa;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class SancofaUser extends Authenticatable
{
    use Notifiable;
    use SearchableTrait;
    use LogsActivity;
    protected $guarded = [];
    protected static $logFillable = true;
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be the table name.
     *
     * @var string
     */

    protected $table = 'sancofa_user';

    /**
     *the attribute that is the primary key
     *
     *@var string
     */

    protected $primaryKey = 'sancofa_id';

    /**
     *the attribute that is for incrementing
     *
     *@var string
     */

    public  $incrementing = false;

    /**
     *the attribute for key type
     *
     *@var string
     */


    public $timestamps = false;
    protected $searchable =[

      'columns' => [

        'sancofa_user.full_name'     =>   100,
        'sancofa_user.university_id' =>   100,

      ],


    ];

    public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults();
    }

    

}
