<?php

namespace App\Models;

use App\Enums\ProposalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'opportunity_id',
        'partner_id',
        'title',
        'amount',
        'installments',
        'valid_until',
        'status',
        'details',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'valid_until' => 'date',
            'status' => ProposalStatus::class,
        ];
    }

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'noteable')->latest();
    }
}
