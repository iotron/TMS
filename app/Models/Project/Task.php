<?php

namespace App\Models\Project;

use App\Casts\PriorityCast;
use App\Casts\StatusCast;
use App\Models\User;
use Database\Factories\Project\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;



    protected $fillable = [
        'name',
        'url',
        'description',
        'priority',
        'status',
        'start',
        'end',
        'project_id',
        'user_id',
    ];

    // Casts for attributes
    protected $casts = [
        'priority' => PriorityCast::class,
        'status' => StatusCast::class,
        'start' => 'datetime',
        'end' => 'datetime',
    ];



    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }







}
