<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormContact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'content',
    ];

    /**
     * @return array
     */
    public static function getAllPaginated(Request $request)
    {
        $query = self::query()->orderBy('created_at', 'DESC');

        return $query->paginate($request->get('perPage', 10));
    }
}
