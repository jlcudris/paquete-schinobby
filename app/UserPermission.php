<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class UserPermission extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='permission_user';
    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=['permission_id','user_id'];










}
