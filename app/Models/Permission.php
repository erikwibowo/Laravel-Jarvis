<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

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
