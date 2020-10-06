<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $timestamps = false;

    public static function add()
    {
        $result = self::query()->where('date', Carbon::today())->first();

        if ($result)
        {
            $result->count = $result->count + 1;
            $result->save();
        }
        else
        {
            $result = new self();
            $result->date = Carbon::today();
            $result->count = 1;
            $result->save();
        }
    }

    public static function getChart()
    {
        $result = self::query()->where('date', '>', Carbon::today()->addDays(-30))->orderBy('date', 'ASC')->get();

        $result = $result->pluck('count', 'date')->toArray();

        $keys = array_keys($result);

        foreach ($keys as &$item)
        {
            $item = "'$item'";
        }

        $keys = join(',', $keys);
        $values = join(',', array_values($result));

        return [
            'keys' => $keys,
            'values' => $values,
        ];
    }
}
