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
        Schema::create('partsproducts', function (Blueprint $table) {
            $table->id();
            $table->string('partsproduct_assetID')->nullable();
            $table->string('partsproduct_newassetID')->nullable();
            $table->string('partsproduct_desc')->nullable();
            $table->string('partsproduct_partnumber')->nullable();
            // $table->string('partsproduct_serial')->nullable();
            $table->string('partsproduct_transfer')->nullable();
            $table->string('partsproduct_reser')->nullable();
            $table->string('partsproduct_origin')->nullable();
            $table->string('partsproduct_sdvin')->nullable();
            $table->string('partsproduct_sdvout')->nullable();
            $table->string('partsproduct_station')->nullable();
            $table->string('partsproduct_requestor')->nullable();
            $table->string('partsproduct_project')->nullable();
            $table->string('partsproduct_datein')->nullable();
            $table->string('partsproduct_dateout')->nullable();
            $table->string('partsproduct_dateoffshore')->nullable();
            $table->string('partsproduct_tfoffshore')->nullable();
            $table->string('partsproduct_curloc')->nullable();
            $table->string('partsproduct_targetpdn')->nullable();
            $table->integer('partsproduct_stockin')->nullable();
            $table->string('partsproduct_docin')->nullable();
            $table->integer('partsproduct_stockout')->nullable();
            $table->string('partsproduct_docout')->nullable();
            $table->string('partsproduct_stockqty')->nullable();
            $table->string('partsproduct_uom')->nullable();
            $table->string('partsproduct_csrelease')->nullable();
            $table->string('partsproduct_csnumber')->nullable();
            $table->string('partsproduct_cenumber')->nullable();
            $table->string('partsproduct_ronumber')->nullable();
            $table->string('partsproduct_startdate')->nullable();
            $table->string('partsproduct_enddate')->nullable();
            $table->string('partsproduct_price')->nullable();
            $table->string('partsproduct_remark')->nullable();
            $table->string('partsproduct_code')->nullable();
            $table->string('partsproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partsproducts');
    }
};