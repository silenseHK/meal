<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KiRoles extends Model
{

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    protected $dateFormat = 'U';

    protected $guarded = [];

    use SoftDeletes;

}
