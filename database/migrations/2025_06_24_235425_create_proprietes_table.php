<?php

use App\Models\User;
use App\Models\TypePropriete;
use App\Models\TypeTransaction;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('proprietes', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->text('description');
    $table->string('adresse');
    $table->string('ville');
    $table->string('prix');
    $table->string('surface');
    $table->string('chambres');
    $table->string('salle_bains');
    // $table->string('image')->nullable();
    $table->enum('statut', ['Disponible', 'Occupé'])->default('Disponible');

    // Relations
    $table->foreignIdFor(TypePropriete::class)->constrained()->onDelete('cascade');
    $table->foreignIdFor(TypeTransaction::class)->constrained()->onDelete('cascade');
    $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietes');
    }
};
