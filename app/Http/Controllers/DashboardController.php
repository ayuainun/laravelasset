<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Insproduct;
use App\Models\Autoproduct;
use App\Models\Bulkproduct;
use App\Models\Partsproduct;
use App\Models\Repairproduct;
use App\Models\Autorepairproduct;
use App\Models\Insrepairproduct;
use App\Models\Unreproduct;
use Carbon\Carbon;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class DashboardController extends Controller
{
    //
    public function index()
    {

        //INCOMING SPARE UNIT
        $sumIn = 0;
        $products = Product::all();
        foreach ($products as $product){
            $sumIn += $product->product_stockin;
        }
        $insproducts = Insproduct::all();
        foreach ($insproducts as $insproduct){
            $sumIn += $insproduct->insproduct_stockin;
        }
        $autoproducts = Autoproduct::all();
        foreach ($autoproducts as $autoproduct){
            $sumIn += $autoproduct->autoproduct_stockin;
        }
        //OUTGOING SPARE UNIT
        $sumOut = 0;
        $products = Product::all();
        foreach ($products as $product){
            $sumOut += $product->product_stockout;
        }
        $insproducts = Insproduct::all();
        foreach ($insproducts as $insproduct){
            $sumOut+= $insproduct->insproduct_stockout;
        }
        $autoproducts = Autoproduct::all();
        foreach ($autoproducts as $autoproduct){
            $sumOut+= $autoproduct->autoproduct_stockout;
        }
        //AT WORKSHOP SPARE UNIT
        $sumQty = 0;
        $products = Product::all();
        foreach ($products as $product){
            $sumQty += $product->product_stockqty;
        }
        $insproducts = Insproduct::all();
        foreach ($insproducts as $insproduct){
            $sumQty += $insproduct->insproduct_stockqty;
        }
        $autoproducts = Autoproduct::all();
        foreach ($autoproducts as $autoproduct){
            $sumQty += $autoproduct->autoproduct_stockqty;
        }

        // INCOMING BULK MATERIAL
        $bulksumIn = 0;
        $bulkproducts = Bulkproduct::all();
        foreach ($bulkproducts as $bulkproduct){
            $bulksumIn += $bulkproduct->bulkproduct_stockin;
        }
        //OUTGOING BULK MATERIAL
        $bulksumOut = 0;
        $bulkproducts = Bulkproduct::all();
        foreach ($bulkproducts as $bulkproduct){
            $bulksumOut += $bulkproduct->bulkproduct_stockout;
        }
        //AT WORKSHOP BULK MATERIAL
        $bulksumQty = 0;
        $bulkproducts = Bulkproduct::all();
        foreach ($bulkproducts as $bulkproduct){
            $bulksumQty += $bulkproduct->bulkproduct_stockqty;
        }

        //INCOMING Spare Part
        $partssumIn = 0;
        $partsproducts = Partsproduct::all();
        foreach ($partsproducts as $partsproduct){
            $partssumIn += $partsproduct->partsproduct_stockin;
        }
        //OUTGOING Spare Part
        $partssumOut = 0;
        $partsproducts = Partsproduct::all();
        foreach ($partsproducts as $partsproduct){
            $partssumOut += $partsproduct->partsproduct_stockout;
        }
        //AT WORKSHOP Spare Part
        $partssumQty = 0;
        $partsproducts = Partsproduct::all();
        foreach ($partsproducts as $partsproduct){
            $partssumQty += $partsproduct->partsproduct_stockqty;
        }

        //INCOMING Repair
        $repairsumIn = 0;
        $repairproducts = Repairproduct::all();
        foreach ($repairproducts as $repairproduct){
            $repairsumIn += $repairproduct->repairproduct_stockin;
        }
        $autorepairproducts = Autorepairproduct::all();
        foreach ($autorepairproducts as $autorepairproduct){
            $repairsumIn += $autorepairproduct->autorepairproduct_stockin;
        }
        $insrepairproducts = Insrepairproduct::all();
        foreach ($insrepairproducts as $insrepairproduct){
            $repairsumIn += $insrepairproduct->insrepairproduct_stockin;
        }
        //OUTGOING Repair
        $repairsumOut = 0;
        $repairproducts = Repairproduct::all();
        foreach ($repairproducts as $repairproduct){
            $repairsumOut += $repairproduct->repairproduct_stockout;
        }
        $autorepairproducts = Autorepairproduct::all();
        foreach ($autorepairproducts as $autorepairproduct){
            $repairsumOut += $autorepairproduct->autorepairproduct_stockout;
        }
        $insrepairproducts = Insrepairproduct::all();
        foreach ($insrepairproducts as $insrepairproduct){
            $repairsumOut += $insrepairproduct->insrepairproduct_stockout;
        }
         //AT WORKSHOP Repair
         $repairsumQty = 0;
         $repairproducts = Repairproduct::all();
         foreach ($repairproducts as $repairproduct){
             $repairsumQty += $repairproduct->repairproduct_stockqty;
         }
         $autorepairproducts = Autorepairproduct::all();
         foreach ($autorepairproducts as $autorepairproduct){
             $repairsumQty += $autorepairproduct->autorepairproduct_stockqty;
         }
         $insrepairproducts = Insrepairproduct::all();
         foreach ($insrepairproducts as $insrepairproduct){
             $repairsumQty += $insrepairproduct->insrepairproduct_stockqty;
         }

         //INCOMING Unrepairable
         $unresumIn = 0;
         $unreproducts = Unreproduct::all();
         foreach ($unreproducts as $unreproduct){
             $unresumIn += $unreproduct->unreproduct_stockin;
         }
         //OUTGOING Unrepairable
         $unresumOut = 0;
         $unreproducts = Unreproduct::all();
         foreach ($unreproducts as $unreproduct){
             $unresumOut += $unreproduct->unreproduct_stockout;
         }
         //AT WORKSHOP Unrepairable
         $unresumQty = 0;
         $unreproducts = Unreproduct::all();
         foreach ($unreproducts as $unreproduct){
             $unresumQty += $unreproduct->unreproduct_stockqty;
         }
        

        return view('dashboard.index', [
            'sumin' => $sumIn,
            'sumout' => $sumOut,
            'sumqty' => $sumQty,
            'bulksumin' => $bulksumIn,
            'bulksumout' => $bulksumOut,
            'bulksumqty' => $bulksumQty,
            'partssumin' => $partssumIn,
            'partssumout' => $partssumOut,
            'partssumqty' => $partssumQty,
            'repairsumin' => $repairsumIn,
            'repairsumout' => $repairsumOut,
            'repairsumqty' => $repairsumQty,
            'unresumin' => $unresumIn,
            'unresumout' => $unresumOut,
            'unresumqty' => $unresumQty
        ]);

    }
}
