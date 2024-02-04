<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListOfName extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const INSTALLATION_SELECT = [
        'installed' => 'Installed',
        'pending'   => 'pending',
    ];

    public $table = 'list_of_names';

    public static $searchable = [
        'last_name',
        'first_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'house_number',
        'last_name',
        'first_name',
        'middle_initial',
        'customers_number',
        'meter_number',
        'installation',
        'connection',

        'Province',
        'City',
        'Brgy',
        'Purok',
        'Street',

        'created_at',
        'updated_at',
        'deleted_at',
        'address',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
