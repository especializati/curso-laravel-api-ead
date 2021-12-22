<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = ['description', 'support_id', 'user_id'];

    protected $table = 'reply_support';

    protected $touches = ['support'];

    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
