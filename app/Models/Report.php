<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const PAID_PENDING_SELECT = [
        'paid'    => 'paid',
        'pending' => 'pending',
    ];

    public $table = 'reports';

    protected $dates = [
        'last_payment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lastname_id',
        'first_name_id',
        'middle_name',
        'last_payment_date',
        'balance',
        'bill_paid',
        'paid_pending',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lastname()
    {
        return $this->belongsTo(ListOfName::class, 'lastname_id');
    }

    public function first_name()
    {
        return $this->belongsTo(ListOfName::class, 'first_name_id');
    }

    public function getLastPaymentDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLastPaymentDateAttribute($value)
    {
        $this->attributes['last_payment_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
