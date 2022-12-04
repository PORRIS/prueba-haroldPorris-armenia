<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceCulturalRights extends Model
{
    use HasFactory;
    protected $table = 'public.tst_cultural_rights';

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->whereRaw("description ilike '%".$search."%'" );
        }
    }
}
