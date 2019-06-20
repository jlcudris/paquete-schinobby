<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class RolePermission extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='permission_role';
    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable=['permission_id','role_id'];










}
