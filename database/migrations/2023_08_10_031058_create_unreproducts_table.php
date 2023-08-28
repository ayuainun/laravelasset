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
        Schema::create('unreproducts', function (Blueprint $table) {
            $table->id();
            $table->string('unreproduct_status')->nullable();
            $table->string('unreproduct_assetID')->nullable();
            $table->string('unreproduct_newassetID')->nullable();
            $table->string('unreproduct_desc')->nullable();
            // $table->string('unreproduct_serial')->nullable();
            $table->string('unreproduct_transfer')->nullable();
            $table->string('unreproduct_reser')->nullable();
            $table->string('unreproduct_origin')->nullable();
            $table->string('unreproduct_sdvin')->nullable();
            $table->string('unreproduct_sdvout')->nullable();
            $table->string('unreproduct_station')->nullable();
            $table->string('unreproduct_requestor')->nullable();
            $table->string('unreproduct_project')->nullable();
            $table->string('unreproduct_datein')->nullable();
            $table->string('unreproduct_dateout')->nullable();
            $table->string('unreproduct_dateoffshore')->nullable();
            $table->string('unreproduct_tfoffshore')->nullable();
            $table->string('unreproduct_curloc')->nullable();
            $table->string('unreproduct_targetpdn')->nullable();
            $table->integer('unreproduct_stockin')->nullable();
            $table->string('unreproduct_docin')->nullable();
            $table->integer('unreproduct_stockout')->nullable();
            $table->string('unreproduct_docout')->nullable();
            $table->string('unreproduct_stockqty')->nullable();
            $table->string('unreproduct_uom')->nullable();
            $table->string('unreproduct_csrelease')->nullable();
            $table->string('unreproduct_csnumber')->nullable();
            $table->string('unreproduct_cenumber')->nullable();
            $table->string('unreproduct_ronumber')->nullable();
            $table->string('unreproduct_startdate')->nullable();
            $table->string('unreproduct_enddate')->nullable();
            $table->string('unreproduct_price')->nullable();
            $table->string('unreproduct_remark')->nullable();
            $table->string('unreproduct_code')->nullable();
            $table->string('unreproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unreproducts');
    }
};
