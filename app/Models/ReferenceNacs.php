<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceNacs extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'public.tst_nacs';

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->whereRaw("description like '%".$search."%'" );
        }
    }
}
