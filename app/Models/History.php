<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $primaryKey = 'id_history';
    protected $table = 'history';
    use HasFactory;

    protected $guarded = ['id_history'];
    public $timestamps = false;


    // protected $guarded = ['id_history', 'id_user'];

    // protected $fillable = [
    //     'type_bank',
    //     'account_number',
    //     'name',
    //     'nominal',
    //     'date',
    //     'status'
    // ];
}
