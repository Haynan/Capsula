<?php

use App\Enums\OpportunityStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->string('title', 150);
            $table->string('status', 30)->default(OpportunityStatus::Open->value);
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->date('expected_close_date')->nullable();
            $table->dateTime('next_action_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('lead_id');
            $table->index('client_id');
            $table->index('product_id');
            $table->index('status');
            $table->index('expected_close_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
