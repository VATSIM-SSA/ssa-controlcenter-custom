<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('callsign', 30);
            $table->string('name', 30);
            $table->string('fir', 4);
            $table->unsignedInteger('rating');
        });

        // Denmark
        DB::table('positions')->insert([
            ['callsign' => 'EKAH_APP', 'name' => 'Aarhus Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKAH_TWR', 'name' => 'Aarhus Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKBI_APP', 'name' => 'Billund Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKBI_TWR', 'name' => 'Billund Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKBI_F_APP', 'name' => 'Billund Arrival', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKCH_E_DEP', 'name' => 'Kastrup Departure', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKCH_F_APP', 'name' => 'Kastrup Final', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKCH_DEP', 'name' => 'Kastrup Departure', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKCH_E_APP', 'name' => 'Copenhagen Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKCH_DEL', 'name' => 'Kastrup Delivery', 'fir' => 'EKDK', 'rating' => 2],
            ['callsign' => 'EKCH_GND', 'name' => 'Kastrup Apron', 'fir' => 'EKDK', 'rating' => 2],
            ['callsign' => 'EKCH_APP', 'name' => 'Copenhagen Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKCH_A_TWR', 'name' => 'Kastrup Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKCH_C_TWR', 'name' => 'Kastrup Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKCH_D_TWR', 'name' => 'Kastrup Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKCH_TWR', 'name' => 'Kastrup Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKCH_A_GND', 'name' => 'Kastrup Apron', 'fir' => 'EKDK', 'rating' => 2],
            ['callsign' => 'EKDK_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_B_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_C_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_D_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_S_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_N_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_V_CTR', 'name' => 'Copenhagen Control', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKDK_I_CTR', 'name' => 'Copenhagen Information', 'fir' => 'EKDK', 'rating' => 5],
            ['callsign' => 'EKEB_I_TWR', 'name' => 'Esbjerg AFIS', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKKA_APP', 'name' => 'Karup Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKKA_TWR', 'name' => 'Karup Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKOD_I_TWR', 'name' => 'Odense AFIS', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKRK_APP', 'name' => 'Roskilde Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKRK_TWR', 'name' => 'Roskilde Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKRN_TWR', 'name' => 'Rønne Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKSB_I_TWR', 'name' => 'Sønderborg AFIS', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKSP_TWR', 'name' => 'Skrydstrup Approach', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKSP_APP', 'name' => 'Skrydstrup Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKYT_TWR', 'name' => 'Aalborg Tower', 'fir' => 'EKDK', 'rating' => 3],
            ['callsign' => 'EKYT_APP', 'name' => 'Aalborg Approach', 'fir' => 'EKDK', 'rating' => 4],
            ['callsign' => 'EKYT_F_APP', 'name' => 'Aalborg Arrival', 'fir' => 'EKDK', 'rating' => 4],
        ]);;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
