<?php

namespace App\Models\Project;

use App\Casts\StatusCast;
use App\Models\User;
use Database\Factories\Project\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;



    protected $fillable = [
        'name',
        'url',
        'description',
        'start',
        'end',
        'status',
        'user_id'
    ];

    // Casts for attributes
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'status' => StatusCast::class
    ];



    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'project_id','id');
    }


    public function sprints()
    {
        return $this->hasMany(Sprint::class,'project_id','id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user','project_id','user_id');
    }









}
