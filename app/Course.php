<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /**
     * @return array
     */
    public static function getAllPaginated(Request $request)
    {
        $query = self::query();

        return $query->paginate($request->get('perPage', 10));
    }

    /**
     * @return array
     */
    public static function getFormOptions()
    {
        return self::query()->where('is_active', true)->select(['id', 'name'])->get()->pluck('name', 'id');
    }
}
