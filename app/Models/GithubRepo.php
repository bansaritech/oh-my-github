<?php

namespace App\Models;

use App\Models\Scopes\UserWiseModelScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubRepo extends Model
{
    use HasFactory;

    protected $casts = [
        'details' => 'array'
    ];

    protected $fillable = ['name', 'fork'];

    public function collaborators()
    {
        return $this->belongsToMany(Collaborator::class, 'repo_collaborators', 'repo_id', 'collaborator_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserWiseModelScope);
    }

}
