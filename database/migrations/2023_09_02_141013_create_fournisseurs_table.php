<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('entreprise');
            $table->string('email');
            $table->string('mobile');
            $table->string('domaine_activites_1');
            $table->string('fixe');
            $table->string('rccm');
            $table->string('cc');
            $table->string('date_dfe');
            $table->string('situation_geo');
            $table->string('sous_domaine')->nullable();
            $table->string('produits_services');
            $table->string('validite_arf');
            $table->string('validite_cnps');
            $table->string('interloc_nom');
            $table->string('interloc_fonction');
            $table->string('interloc_contact');
            $table->string('interloc_email');
            $table->string('status');
            $table->boolean('blaklist')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
};
