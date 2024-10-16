<?php

namespace App\Models\Project;

use Database\Factories\Project\SprintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sprint extends Model
{
    /** @use HasFactory<SprintFactory> */
    use HasFactory;



    protected $fillable = [
        'name',
        'goal',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

}
