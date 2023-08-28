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
        Schema::create('autoproducts', function (Blueprint $table) {
            $table->id();
            $table->string('autoproduct_status')->nullable();
            $table->string('autoproduct_assetID')->nullable();
            $table->string('autoproduct_newassetID')->nullable();
            $table->string('autoproduct_brand')->nullable();
            // $table->string('autoproduct_serial')->nullable();
            $table->string('autoproduct_transfer')->nullable();
            $table->string('autoproduct_reser')->nullable();
            $table->string('autoproduct_origin')->nullable();
            $table->string('autoproduct_sdvin')->nullable();
            $table->string('autoproduct_sdvout')->nullable();
            $table->string('autoproduct_station')->nullable();
            $table->string('autoproduct_requestor')->nullable();
            $table->string('autoproduct_project')->nullable();
            $table->string('autoproduct_datein')->nullable();
            $table->string('autoproduct_dateout')->nullable();
            $table->string('autoproduct_dateoffshore')->nullable();
            $table->string('autoproduct_tfoffshore')->nullable();
            $table->string('autoproduct_curloc')->nullable();
            $table->string('autoproduct_targetpdn')->nullable();
            $table->integer('autoproduct_stockin')->nullable();
            $table->string('autoproduct_docin')->nullable();
            $table->integer('autoproduct_stockout')->nullable();
            $table->string('autoproduct_docout')->nullable();
            $table->string('autoproduct_stockqty')->nullable();
            $table->string('autoproduct_uom')->nullable();
            $table->string('autoproduct_csrelease')->nullable();
            $table->string('autoproduct_csnumber')->nullable();
            $table->string('autoproduct_cenumber')->nullable();
            $table->string('autoproduct_ronumber')->nullable();
            $table->string('autoproduct_startdate')->nullable();
            $table->string('autoproduct_enddate')->nullable();
            $table->string('autoproduct_price')->nullable();
            $table->string('autoproduct_remark')->nullable();
            $table->string('autoproduct_code')->nullable();
            $table->string('autoproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autoproducts');
    }
};
