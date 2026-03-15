<?php

use App\Enums\LeadPriority;
use App\Enums\LeadStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 150);
            $table->string('phone', 30);
            $table->string('whatsapp', 30)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('state', 2)->nullable();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('source', 100)->default('site');
            $table->string('origin_page', 150)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 30)->default(LeadStatus::New->value);
            $table->string('priority', 20)->default(LeadPriority::Normal->value);
            $table->timestamp('consent_at');
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('converted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('priority');
            $table->index('product_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
