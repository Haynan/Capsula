<?php

use App\Enums\ClientServiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('partner_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->string('status', 30)->default(ClientServiceStatus::Active->value);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('client_id');
            $table->index('product_id');
            $table->index('partner_id');
            $table->index('renewal_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_services');
    }
};
