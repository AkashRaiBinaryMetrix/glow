<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userabout extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userabout';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'user_id',
       'studied_at',
       'lives_in',
       'from',
       'marital_status',
       'phone',
       'about',
       'zipcode',
       'denomination',
       'member',
       'created_at',
       'updated_at',
    ];

}
