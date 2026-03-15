<?php

use App\Enums\ClientType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('type', 10)->default(ClientType::Individual->value);
            $table->string('name', 150);
            $table->string('document', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('address')->nullable();
            $table->text('notes_summary')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('type');
            $table->index('name');
            $table->index('document');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
