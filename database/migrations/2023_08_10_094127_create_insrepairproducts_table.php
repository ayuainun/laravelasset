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
        Schema::create('insrepairproducts', function (Blueprint $table) {
            $table->id();
            $table->string('insrepairproduct_status')->nullable();
            $table->string('insrepairproduct_assetID')->nullable();
            $table->string('insrepairproduct_newassetID')->nullable();
            $table->string('insrepairproduct_instype')->nullable();
            $table->string('insrepairproduct_insbrand')->nullable();
            // $table->string('insrepairproduct_serial')->nullable();
            $table->string('insrepairproduct_transfer')->nullable();
            $table->string('insrepairproduct_reser')->nullable();
            $table->string('insrepairproduct_origin')->nullable();
            $table->string('insrepairproduct_sdvin')->nullable();
            $table->string('insrepairproduct_sdvout')->nullable();
            $table->string('insrepairproduct_station')->nullable();
            $table->string('insrepairproduct_requestor')->nullable();
            $table->string('insrepairproduct_project')->nullable();
            $table->string('insrepairproduct_datein')->nullable();
            $table->string('insrepairproduct_dateout')->nullable();
            $table->string('insrepairproduct_dateoffshore')->nullable();
            $table->string('insrepairproduct_tfoffshore')->nullable();
            $table->string('insrepairproduct_curloc')->nullable();
            $table->string('insrepairproduct_targetpdn')->nullable();
            $table->integer('insrepairproduct_stockin')->nullable();
            $table->string('insrepairproduct_docin')->nullable();
            $table->integer('insrepairproduct_stockout')->nullable();
            $table->string('insrepairproduct_docout')->nullable();
            $table->string('insrepairproduct_stockqty')->nullable();
            $table->string('insrepairproduct_uom')->nullable();
            $table->string('insrepairproduct_csrelease')->nullable();
            $table->string('insrepairproduct_csnumber')->nullable();
            $table->string('insrepairproduct_cenumber')->nullable();
            $table->string('insrepairproduct_ronumber')->nullable();
            $table->string('insrepairproduct_startdate')->nullable();
            $table->string('insrepairproduct_enddate')->nullable();
            $table->string('insrepairproduct_price')->nullable();
            $table->string('insrepairproduct_remark')->nullable();
            $table->string('insrepairproduct_code')->nullable();
            $table->string('insrepairproduct_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insrepairproducts');
    }
};
