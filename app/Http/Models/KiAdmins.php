<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KiAdmins extends Model
{

    protected $table = 'admins';

    protected $primaryKey = 'admin_id';

    protected $dateFormat = 'U';

    protected $guarded = [];

    use SoftDeletes;

}
