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
        Schema::create('insproducts', function (Blueprint $table) {
            $table->id();
            $table->string('insproduct_status')->nullable();
            $table->string('insproduct_assetID')->nullable();
            $table->string('insproduct_newassetID')->nullable();
            $table->string('insproduct_instype')->nullable();
            $table->string('insproduct_insbrand')->nullable();
            // $table->string('insproduct_serial')->nullable();
            $table->string('insproduct_transfer')->nullable();
            $table->string('insproduct_reser')->nullable();
            $table->string('insproduct_origin')->nullable();
            $table->string('insproduct_sdvin')->nullable();
            $table->string('insproduct_sdvout')->nullable();
            $table->string('insproduct_station')->nullable();
            $table->string('insproduct_requestor')->nullable();
            $table->string('insproduct_project')->nullable();
            $table->string('insproduct_datein')->nullable();
            $table->string('insproduct_dateout')->nullable();
            $table->string('insproduct_dateoffshore')->nullable();
            $table->string('insproduct_tfoffshore')->nullable();
            $table->string('insproduct_curloc')->nullable();
            $table->string('insproduct_targetpdn')->nullable();
            $table->integer('insproduct_stockin')->nullable();
            $table->string('insproduct_docin')->nullable();
            $table->integer('insproduct_stockout')->nullable();
            $table->string('insproduct_docout')->nullable();
            $table->string('insproduct_stockqty')->nullable();
            $table->string('insproduct_uom')->nullable();
            $table->string('insproduct_csrelease')->nullable();
            $table->string('insproduct_csnumber')->nullable();
            $table->string('insproduct_cenumber')->nullable();
            $table->string('insproduct_ronumber')->nullable();
            $table->string('insproduct_startdate')->nullable();
            $table->string('insproduct_enddate')->nullable();
            $table->string('insproduct_price')->nullable();
            $table->string('insproduct_remark')->nullable();
            $table->string('insproduct_code')->nullable();
            $table->string('insproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insproducts');
    }
};
