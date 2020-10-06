<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CrmCourse extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'info',
    ];

    /**
     * @return Collection
     */
    public function clients()
    {
        return $this->belongsToMany(CrmClient::class, 'crm_course_client')->withTimestamps();
    }

    /**
     * @return array
     */
    public static function getAllPaginated(Request $request)
    {
        $query = self::query();

        if ($request->has('search'))
        {
            $search = $request->get('search');

            $query = $query->where('name', 'LIKE', '%'. $search .'%');
        }

        return $query->paginate($request->get('perPage', 10))->appends('search', $request->get('search'));
    }
}
