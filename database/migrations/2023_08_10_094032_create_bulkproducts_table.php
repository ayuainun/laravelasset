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
        Schema::create('bulkproducts', function (Blueprint $table) {
            $table->id();
            $table->string('bulkproduct_status')->nullable();
            $table->string('bulkproduct_assetID')->nullable();
            $table->string('bulkproduct_newassetID')->nullable();
            $table->string('bulkproduct_bulktype')->nullable();
            $table->string('bulkproduct_serial')->nullable();
            $table->string('bulkproduct_datein')->nullable();
            $table->string('bulkproduct_transfer')->nullable();
            $table->string('bulkproduct_reser')->nullable();
            $table->string('bulkproduct_origin')->nullable();
            $table->string('bulkproduct_sdvin')->nullable();
            $table->string('bulkproduct_sdvout')->nullable();
            $table->string('bulkproduct_station')->nullable();
            $table->string('bulkproduct_requestor')->nullable();
            $table->string('bulkproduct_project')->nullable();
            $table->string('bulkproduct_dateout')->nullable();
            $table->string('bulkproduct_dateoffshore')->nullable();
            $table->string('bulkproduct_tfoffshore')->nullable();
            $table->string('bulkproduct_curloc')->nullable();
            $table->integer('bulkproduct_stockin')->nullable();
            $table->string('bulkproduct_docin')->nullable();
            $table->integer('bulkproduct_stockout')->nullable();
            $table->string('bulkproduct_docout')->nullable();
            $table->string('bulkproduct_stockqty')->nullable();
            $table->string('bulkproduct_uom')->nullable();
            $table->string('bulkproduct_targetpdn')->nullable();
            $table->string('bulkproduct_csrelease')->nullable();
            $table->string('bulkproduct_csnumber')->nullable();
            $table->string('bulkproduct_cenumber')->nullable();
            $table->string('bulkproduct_ronumber')->nullable();
            $table->string('bulkproduct_startdate')->nullable();
            $table->string('bulkproduct_enddate')->nullable();
            $table->string('bulkproduct_price')->nullable();
            $table->string('bulkproduct_remark')->nullable();
            $table->string('bulkproduct_code')->nullable();
            $table->string('bulkproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulkproducts');
    }
};
