<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelsPermission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
class Permission extends ModelsPermission
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->setDescriptionForEvent(fn(string $eventName) => auth()->user()?->name." {$eventName} ".$this->getTable());
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('D MMMM Y HH:mm');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->isoFormat('D MMMM Y HH:mm');
    }

    public static function getDataByGroupSuperadmin()
    {
        $permissions = self::orderBy('name')->get();

        // Initialize an empty array to store the grouped data
        $groupedData = [];

        foreach ($permissions as $permission) {
            // Extract the group and data from the permission name
            $parts = explode(' ', $permission->name);
            $group = $parts[0];
            $data = $parts[1];

            // Check if the group already exists in the groupedData array
            $groupIndex = array_search($group, array_column($groupedData, 'group'));

            if ($groupIndex !== false) {
                // If the group exists, append the data to its 'data' array
                $groupedData[$groupIndex]['data'][] = ['id' => $permission->id,'name' => $data];
            } else {
                // If the group doesn't exist, add a new entry to the groupedData array
                $groupedData[] = [
                    'group' => $group,
                    'data' => [['id' => $permission->id,'name' => $data]],
                ];
            }
        }

        return $groupedData;
    }

    public static function getDataByGroup()
    {
        $permissions = self::orderBy('name')->whereNotIn('name', ['permission create', 'permission read', 'permission update', 'permission delete'])->get();

        // Initialize an empty array to store the grouped data
        $groupedData = [];

        foreach ($permissions as $permission) {
            // Extract the group and data from the permission name
            $parts = explode(' ', $permission->name);
            $group = $parts[0];
            $data = $parts[1];

            // Check if the group already exists in the groupedData array
            $groupIndex = array_search($group, array_column($groupedData, 'group'));

            if ($groupIndex !== false) {
                // If the group exists, append the data to its 'data' array
                $groupedData[$groupIndex]['data'][] = ['id' => $permission->id,'name' => $data];
            } else {
                // If the group doesn't exist, add a new entry to the groupedData array
                $groupedData[] = [
                    'group' => $group,
                    'data' => [['id' => $permission->id,'name' => $data]],
                ];
            }
        }

        return $groupedData;
    }
}
