<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'public.tst_activity';
    protected $hidden = ['deleted_at'];

    protected $casts = [
        'start_time' => 'datetime:g:i A',
        'final_hour' => 'datetime:g:i A',
        'activity_date' =>'datetime:Y-m-d',
        'created_at' => "datetime:Y-m-d H:i:s",
        'updated_at' => "datetime:Y-m-d H:i:s"
    ];

    protected $fillable = [
        'consecutive',
        'activity_name',
        'cultural_right_id',
        'nac_id',
        'activity_date',
        'start_time',
        'final_hour',
        'expertise_id'
    ];



    public function cultural(){
        return $this->belongsTo(ReferenceCulturalRights::class, 'cultural_right_id');
    }

    public function nac(){
        return $this->belongsTo(ReferenceNacs::class, 'nac_id');
    }

    public function expertise(){
        return $this->belongsTo(ReferenceExpertises::class, 'expertise_id');
    }
}
