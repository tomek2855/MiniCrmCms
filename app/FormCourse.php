<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormCourse extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'number',
        'pesel',
        'address_number',
        'address_street',
        'address_city',
        'address_zipcode',
        'course_id',
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function getFullName() : string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return array
     */
    public static function getAllPaginated(Request $request)
    {
        $query = self::query()->orderBy('created_at', 'DESC');

        return $query->paginate($request->get('perPage', 10));
    }
}
