<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CrmClient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'pesel',
        'gender',
        'birthday',
        'birth_city',
        'address_city',
        'address_street',
        'address_postal_code',
        'address_house_number',
        'address_apartment_number',
        'info',
    ];

    /**
     * @return Collection
     */
    public function courses()
    {
        return $this->belongsToMany(CrmCourse::class, 'crm_course_client')->withTimestamps();
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

            $query = $query->where('first_name', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('last_name', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('email', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('phone_number', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('pesel', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('birth_city', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('address_city', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('address_street', 'LIKE', '%'. $search .'%');
            $query = $query->orWhere('address_postal_code', 'LIKE', '%'. $search .'%');
        }

        return $query->paginate($request->get('perPage', 10))->appends('search', $request->get('search'));
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
