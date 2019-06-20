<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class UserRole extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='role_user';
    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=['role_id','user_id'];










}
