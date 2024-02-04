<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audit extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'audits';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lastname_id',
        'firstname_id',
        'middle_initial',
        'suffix',
        'bill_paid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lastname()
    {
        return $this->belongsTo(ListOfName::class, 'lastname_id');
    }

    public function firstname()
    {
        return $this->belongsTo(ListOfName::class, 'firstname_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
