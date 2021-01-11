<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Models\Manage\KiAccess
 *
 * @property int $access_id
 * @property string $title 权限名
 * @property int $methods 请求类型
 * @property string $uri 路由
 * @property int $pid 上级权限id
 * @property int $level 权限等级
 * @property int $is_include 是否直接被上级选中 1.是 0.不是
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 更新时间
 * @property \Illuminate\Support\Carbon|null $deleted_at 删除时间
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess newQuery()
 * @method static \Illuminate\Database\Query\Builder|KiAccess onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess query()
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereAccessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereIsInclude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KiAccess whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|KiAccess withTrashed()
 * @method static \Illuminate\Database\Query\Builder|KiAccess withoutTrashed()
 * @mixin \Eloquent
 */
class KiAccess extends Model
{

    protected $table = 'access';

    protected $primaryKey = 'access_id';

    protected $dateFormat = 'U';

    protected $guarded = [];

    use SoftDeletes;

}
