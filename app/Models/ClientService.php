<?php

namespace App\Models;

use App\Enums\ClientServiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'product_id',
        'partner_id',
        'title',
        'description',
        'start_date',
        'renewal_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => ClientServiceStatus::class,
            'start_date' => 'date',
            'renewal_date' => 'date',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
