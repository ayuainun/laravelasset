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
        Schema::create('repairproducts', function (Blueprint $table) {
            $table->id();
            $table->string('repairproduct_status')->nullable();
            $table->string('repairproduct_assetID')->nullable();
            $table->string('repairproduct_newassetID')->nullable();
            $table->string('repairproduct_equip')->nullable();
            $table->string('repairproduct_unit')->nullable();
            $table->string('repairproduct_end')->nullable();
            $table->string('repairproduct_size')->nullable();
            $table->string('repairproduct_rating')->nullable();
            $table->string('repairproduct_brand')->nullable();
            $table->string('repairproduct_valvemodel')->nullable();
            $table->string('repairproduct_serial')->nullable();
            $table->string('repairproduct_condi')->nullable();
            $table->string('repairproduct_actbrand')->nullable();
            $table->string('repairproduct_acttype')->nullable();
            $table->string('repairproduct_actsize')->nullable();
            $table->string('repairproduct_fail')->nullable();
            $table->string('repairproduct_actcond')->nullable();
            $table->string('repairproduct_posbrand')->nullable();
            $table->string('repairproduct_posmodel')->nullable();
            $table->string('repairproduct_inputsignal')->nullable();
            $table->string('repairproduct_poscond')->nullable();
            $table->string('repairproduct_other')->nullable();
            $table->string('repairproduct_datein')->nullable();
            $table->string('repairproduct_transfer')->nullable();
            $table->string('repairproduct_reser')->nullable();
            $table->string('repairproduct_origin')->nullable();
            $table->string('repairproduct_sdvin')->nullable();
            $table->string('repairproduct_sdvout')->nullable();
            $table->string('repairproduct_station')->nullable();
            $table->string('repairproduct_requestor')->nullable();
            $table->string('repairproduct_project')->nullable();
            $table->string('repairproduct_dateout')->nullable();
            $table->string('repairproduct_dateoffshore')->nullable();
            $table->string('repairproduct_tfoffshore')->nullable();
            $table->string('repairproduct_curloc')->nullable();
            $table->integer('repairproduct_stockin')->nullable();
            $table->string('repairproduct_docin')->nullable();
            $table->integer('repairproduct_stockout')->nullable();
            $table->string('repairproduct_docout')->nullable();
            $table->string('repairproduct_stockqty')->nullable();
            $table->string('repairproduct_uom')->nullable();
            $table->string('repairproduct_targetpdn')->nullable();
            $table->string('repairproduct_csrelease')->nullable();
            $table->string('repairproduct_csnumber')->nullable();
            $table->string('repairproduct_cenumber')->nullable();
            $table->string('repairproduct_ronumber')->nullable();
            $table->string('repairproduct_startdate')->nullable();
            $table->string('repairproduct_enddate')->nullable();
            $table->string('repairproduct_price')->nullable();
            $table->string('repairproduct_remark')->nullable();
            $table->string('repairproduct_code')->nullable();
            $table->string('repairproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairproducts');
    }
};
