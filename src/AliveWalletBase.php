<?php

namespace Alive2212\LaravelWalletService;

use Alive2212\LaravelSmartRestful\BaseModel;
use App\User;

class AliveWalletBase extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'user_id',
        'title',
        'subtitle',
        'description',
        'revoked',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return null
     */
    public function getQueueableRelations()
    {
        return null;
        // TODO: Implement getQueueableRelations() method.
    }
}
