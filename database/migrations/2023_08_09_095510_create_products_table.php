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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_status')->nullable();
            $table->string('product_assetID')->nullable();
            $table->string('product_newassetID')->nullable();
            $table->string('product_equip')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_end')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_rating')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('product_valvemodel')->nullable();
            $table->string('product_serial')->nullable();
            $table->string('product_condi')->nullable();
            $table->string('product_actbrand')->nullable();
            $table->string('product_acttype')->nullable();
            $table->string('product_actsize')->nullable();
            $table->string('product_fail')->nullable();
            $table->string('product_actcond')->nullable();
            $table->string('product_posbrand')->nullable();
            $table->string('product_posmodel')->nullable();
            $table->string('product_inputsignal')->nullable();
            $table->string('product_poscond')->nullable();
            $table->string('product_other')->nullable();
            $table->string('product_datein')->nullable();
            $table->string('product_transfer')->nullable();
            $table->string('product_reser')->nullable();
            $table->string('product_origin')->nullable();
            $table->string('product_sdvin')->nullable();
            $table->string('product_sdvout')->nullable();
            $table->string('product_station')->nullable();
            $table->string('product_requestor')->nullable();
            $table->string('product_project')->nullable();
            $table->string('product_dateout')->nullable();
            $table->string('product_dateoffshore')->nullable();
            $table->string('product_tfoffshore')->nullable();
            $table->string('product_curloc')->nullable();
            $table->integer('product_stockin')->nullable();
            $table->string('product_docin')->nullable();
            $table->integer('product_stockout')->nullable();
            $table->string('product_docout')->nullable();
            $table->string('product_stockqty')->nullable();
            $table->string('product_uom')->nullable();
            $table->string('product_targetpdn')->nullable();
            $table->string('product_csrelease')->nullable();
            $table->string('product_csnumber')->nullable();
            $table->string('product_cenumber')->nullable();
            $table->string('product_ronumber')->nullable();
            $table->string('product_startdate')->nullable();
            $table->string('product_enddate')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_remark')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
