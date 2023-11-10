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
        Schema::create('drafts', function (Blueprint $table) {
            $table->id();
            $table->string('nom_forun');
            $table->string('foru_fourn');
            $table->string('gmail_fourn');
            $table->string('domaine_fourn');
            $table->string('mobile_forun');
            $table->string('fixe');
            $table->string('rccm');
            $table->string('cc');
            $table->string('date_dfe');
            $table->string('situation_geo');
            $table->string('sous_domaine');
            $table->string('produits_services');
            $table->string('validite_arf');
            $table->string('validite_cnps');
            $table->json('interlocuteur');
            $table->string('status');
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
        Schema::dropIfExists('drafts');
    }
};
