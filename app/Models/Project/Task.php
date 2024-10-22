<?php

namespace App\Models\Project;

use App\Casts\PriorityCast;
use App\Casts\StatusCast;
use App\Models\User;
use Database\Factories\Project\TaskFactory;
use Guava\Calendar\Contracts\Eventable;
use Guava\Calendar\ValueObjects\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model implements Eventable
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


//    public function toEvent(): Event|array {
//        return Event::make($this)
//            ->title($this->name)
//            ->start($this->start)
//            ->end($this->end);
//    }


    public function toEvent(): Event|array {
        return Event::make($this)
            ->title($this->name)
            ->start($this->start ?? now()) // Use current time as a fallback
            ->end($this->end ?? now()->addHour()); // Default to one hour later
    }



}
