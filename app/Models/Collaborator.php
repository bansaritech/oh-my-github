<?php

namespace App\Models;

use App\Models\Scopes\UserWiseModelScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $casts = [
        'details' => 'array'
    ];

    protected $fillable = ['name'];

    public function repositories()
    {
        return $this->belongsToMany(GithubRepo::class, 'repo_collaborators', 'collaborator_id', 'repo_id');
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
