<?php

namespace App\Models\Project;

use Database\Factories\Project\SprintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'sprint_id','id');
    }



}
