<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Utilisateur qui a créé le ticket
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Catégorie du ticket
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open'); // État du ticket
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // Agent li t assignat lih ticket
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
