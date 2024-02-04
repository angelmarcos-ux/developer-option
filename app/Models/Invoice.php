<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'invoices';

    protected $dates = [
        'get_pay_until_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_id',
        'prev_reading',
        'present_reading',
        'water_usage',
        'price_per_cb',
        'discount',
        'system_lost',
        'total_amount',
        'note',
        'get_pay_until_date',
        'reading_date_from',
        'reading_date_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function last_name()
    {
        return $this->belongsTo(ListOfName::class, 'last_name_id');
    }

    public function first_name()
    {
        return $this->belongsTo(ListOfName::class, 'first_name_id');
    }

    public function getGetPayUntilDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setGetPayUntilDateAttribute($value)
    {
        $this->attributes['get_pay_until_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
