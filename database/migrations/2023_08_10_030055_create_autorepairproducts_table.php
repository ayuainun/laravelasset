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
        Schema::create('autorepairproducts', function (Blueprint $table) {
            $table->id();
            $table->string('autorepairproduct_assetID')->nullable();
            $table->string('autorepairproduct_newassetID')->nullable();
            $table->string('autorepairproduct_autobrand')->nullable();
            // $table->string('autorepairproduct_serial')->nullable();
            $table->string('autorepairproduct_transfer')->nullable();
            $table->string('autorepairproduct_reser')->nullable();
            $table->string('autorepairproduct_origin')->nullable();
            $table->string('autorepairproduct_sdvin')->nullable();
            $table->string('autorepairproduct_sdvout')->nullable();
            $table->string('autorepairproduct_station')->nullable();
            $table->string('autorepairproduct_requestor')->nullable();
            $table->string('autorepairproduct_project')->nullable();
            $table->string('autorepairproduct_datein')->nullable();
            $table->string('autorepairproduct_dateout')->nullable();
            $table->string('autorepairproduct_dateoffshore')->nullable();
            $table->string('autorepairproduct_tfoffshore')->nullable();
            $table->string('autorepairproduct_curloc')->nullable();
            $table->string('autorepairproduct_targetpdn')->nullable();
            $table->integer('autorepairproduct_stockin')->nullable();
            $table->string('autorepairproduct_docin')->nullable();
            $table->integer('autorepairproduct_stockout')->nullable();
            $table->string('autorepairproduct_docout')->nullable();
            $table->string('autorepairproduct_stockqty')->nullable();
            $table->string('autorepairproduct_uom')->nullable();
            $table->string('autorepairproduct_csrelease')->nullable();
            $table->string('autorepairproduct_csnumber')->nullable();
            $table->string('autorepairproduct_cenumber')->nullable();
            $table->string('autorepairproduct_ronumber')->nullable();
            $table->string('autorepairproduct_startdate')->nullable();
            $table->string('autorepairproduct_enddate')->nullable();
            $table->string('autorepairproduct_price')->nullable();
            $table->string('autorepairproduct_remark')->nullable();
            $table->string('autorepairproduct_code')->nullable();
            $table->string('autorepairproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorepairproducts');
    }
};