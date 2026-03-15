<?php

use App\Enums\ProposalStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('partner_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title', 150);
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('installments', 50)->nullable();
            $table->date('valid_until')->nullable();
            $table->string('status', 30)->default(ProposalStatus::Draft->value);
            $table->text('details')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('opportunity_id');
            $table->index('partner_id');
            $table->index('status');
            $table->index('valid_until');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
