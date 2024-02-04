<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillSettings extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'bill_settings';

    protected $dates = [
        'billing_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'billing_date',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
