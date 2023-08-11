<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Insproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class InsproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $insproducts = Insproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('insproducts.index', [
            'insproducts' => $insproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('insproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $insproduct_code = IdGenerator::generate([
            'table' => 'insproducts',
            'field' => 'insproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'insproduct_image' => 'image|file|max:2048',
            'insproduct_assetID' => 'nullable|string',
            'insproduct_newassetID' => 'nullable|string',
            'insproduct_instype' => 'nullable|string',
            'insproduct_insbrand' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'insproduct_transfer' => 'nullable|string',
            'insproduct_reser' => 'nullable|string',
            'insproduct_origin' => 'nullable|string',
            'insproduct_sdvin' => 'nullable|string',
            'insproduct_sdvout' => 'nullable|string',
            'insproduct_station' => 'nullable|string',
            'insproduct_requestor' => 'nullable|string',
            'insproduct_project' => 'nullable|string',
            'insproduct_datein' => 'nullable|date',
            'insproduct_dateout' => 'nullable|date',
            'insproduct_dateoffshore' => 'nullable|date',
            'insproduct_tfoffshore' => 'nullable|string',
            'insproduct_curloc' => 'nullable|string',
            'insproduct_targetpdn' => 'nullable|string',
            'insproduct_stockin' => 'nullable|integer',
            'insproduct_stockout' => 'nullable|integer',
            'insproduct_docin' => 'mimes:doc,pdf|max:2048',
            'insproduct_docout' => 'mimes:doc,pdf|max:2048',
            'insproduct_stockqty' => 'nullable|integer',
            'insproduct_uom' => 'nullable|string',
            'insproduct_csrelease' => 'nullable|string',
            'insproduct_csnumber' => 'nullable|string',
            'insproduct_cenumber' => 'nullable|string',
            'insproduct_ronumber' => 'nullable|string',
            'insproduct_startdate' => 'nullable|date',
            'insproduct_enddate' => 'nullable|date',
            'insproduct_price' => 'nullable|string',
            'insproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        // Save insproduct code value
        $validatedData['insproduct_code'] = $insproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('insproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['insproduct_image'] = $fileName;
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('insproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('insproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insproduct_docout'] = $fileName;
        }


        Insproduct::create($validatedData);

        return Redirect::route('insproducts.index')->with('success', 'Instrument has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insproduct $insproduct)
    {
         // Generate a barcode
         $generator = new BarcodeGeneratorHTML();
         $code = $insproduct->insproduct_code ?? '';
 
         if (!empty($code)) {
             $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
         } else {
             $barcode = ''; // Set an empty barcode if $code is empty or null
         }
 
         return view('insproducts.show', [
             'insproduct' => $insproduct,
             'barcode' => $barcode,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insproduct $insproduct)
    {
        return view('insproducts.edit', [
            'insproduct' => $insproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insproduct $insproduct)
    {
        $rules = [
            'insproduct_image' => 'image|file|max:2048',
            'insproduct_assetID' => 'nullable|string',
            'insproduct_newassetID' => 'nullable|string',
            'insproduct_instype' => 'nullable|string',
            'insproduct_insbrand' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'insproduct_transfer' => 'nullable|string',
            'insproduct_reser' => 'nullable|string',
            'insproduct_origin' => 'nullable|string',
            'insproduct_sdvin' => 'nullable|string',
            'insproduct_sdvout' => 'nullable|string',
            'insproduct_station' => 'nullable|string',
            'insproduct_requestor' => 'nullable|string',
            'insproduct_project' => 'nullable|string',
            'insproduct_datein' => 'nullable|date',
            'insproduct_dateout' => 'nullable|date',
            'insproduct_dateoffshore' => 'nullable|date',
            'insproduct_tfoffshore' => 'nullable|string',
            'insproduct_curloc' => 'nullable|string',
            'insproduct_targetpdn' => 'nullable|string',
            'insproduct_stockin' => 'nullable|integer',
            'insproduct_stockout' => 'nullable|integer',
            'insproduct_docin' => 'mimes:doc,pdf|max:2048',
            'insproduct_docout' => 'mimes:doc,pdf|max:2048',
            'insproduct_stockqty' => 'nullable|integer',
            'insproduct_uom' => 'nullable|string',
            'insproduct_csrelease' => 'nullable|string',
            'insproduct_csnumber' => 'nullable|string',
            'insproduct_cenumber' => 'nullable|string',
            'insproduct_ronumber' => 'nullable|string',
            'insproduct_startdate' => 'nullable|date',
            'insproduct_enddate' => 'nullable|date',
            'insproduct_price' => 'nullable|string',
            'insproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('insproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($insproduct->insproduct_image){
                $result = str_replace('storage/', '', $insproduct->insproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['insproduct_image'] = $fileName;

        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('insproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($insproduct->insproduct_docin){
                $result = str_replace('storage/', '', $insproduct->insproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('insproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($insproduct->insproduct_docout){
                $result = str_replace('storage/', '', $insproduct->insproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insproduct_docout'] = $fileName;
        }


        Insproduct::where('id', $insproduct->id)->update($validatedData);

        return Redirect::route('insproducts.index')->with('success', 'Instrument has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insproduct $insproduct)
    {
       /**
         * Delete photo if exists.
         */
        if($insproduct->insproduct_image){
            $result = str_replace('storage/', '', $insproduct->insproduct_image);
                Storage::delete('public/' . $result);
        }
        /**
         * Delete docin if exists.
         */
        if($insproduct->insproduct_docin){
            $result = str_replace('storage/', '', $insproduct->insproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($insproduct->insproduct_docout){
            $result = str_replace('storage/', '', $insproduct->insproduct_docout);
                Storage::delete('public/' . $result);
        }


        Insproduct::destroy($insproduct->id);

        return Redirect::route('insproducts.index')->with('success', 'Instrument has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('insproducts.import');
    }

    public function handleImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'AJ', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'insproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'insproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'insproduct_instype' => $sheet->getCell( 'C' . $row )->getValue(),
                    'insproduct_insbrand' => $sheet->getCell( 'D' . $row )->getValue(),
                    'insproduct_transfer' => $sheet->getCell( 'E' . $row )->getValue(),
                    'insproduct_reser' => $sheet->getCell( 'F' . $row )->getValue(),
                    'insproduct_origin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'insproduct_sdvin' => $sheet->getCell( 'H' . $row )->getValue(),
                    'insproduct_sdvout' => $sheet->getCell( 'I' . $row )->getValue(),
                    'insproduct_station' => $sheet->getCell( 'J' . $row )->getValue(),
                    'insproduct_requestor' => $sheet->getCell( 'K' . $row )->getValue(),
                    'insproduct_project' => $sheet->getCell( 'L' . $row )->getValue(),
                    'insproduct_datein' => $sheet->getCell( 'M' . $row )->getValue(),
                    'insproduct_dateout' => $sheet->getCell( 'N' . $row )->getValue(),
                    'insproduct_dateoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'insproduct_tfoffshore' => $sheet->getCell( 'P' . $row )->getValue(),
                    'insproduct_curloc' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'insproduct_targetpdn' =>$sheet->getCell( 'R' . $row )->getValue(),
                    'insproduct_stockin' => $sheet->getCell( 'S' . $row )->getValue(),
                    'insproduct_stockout' => $sheet->getCell( 'T' . $row )->getValue(),
                    'insproduct_docin' => $sheet->getCell( 'U' . $row )->getValue(),
                    'insproduct_docout' => $sheet->getCell( 'V' . $row )->getValue(),
                    'insproduct_stockqty' => $sheet->getCell( 'W' . $row )->getValue(),
                    'insproduct_uom' => $sheet->getCell( 'X' . $row )->getValue(),
                    'insproduct_csrelease' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'insproduct_csnumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'insproduct_cenumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'insproduct_ronumber' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'insproduct_startdate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'insproduct_enddate' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'insproduct_price' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'insproduct_remark' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'insproduct_image' =>$sheet->getCell( 'AG' . $row )->getValue(),
                    'insproduct_code' =>$sheet->getCell( 'AH' . $row )->getValue(),
                ];
                $startcount++;
            }

            Insproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('insproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('insproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $insproducts = Insproduct::all()->sortBy('insproduct_type');

        $insproduct_array [] = array(
            'Old ID',
            'Asset ID',
            'Instrument Type',
            'Instrument Brand',
            // 'Serial Number',
            'Material Transfer',
            'Reservation Number',
            'Ex Station',
            'SDV In',
            'SDV Out',
            'Station',
            'Requestor',
            'Project',
            'Date In',
            'Date Out',
            'Date to offshore',
            'Material transfer to offshore',
            'Current Location',
            'Target PDN',
            'Stock In',
            'Dok Stok In',
            'Stock Out',
            'Dok Stok Out',
            'Stock Quality',
            'UOM',
            'CS Release',
            'CS Number',
            'CE Number',
            'RO Number',
            'Start Date',
            'End Date',
            'Price Repair',
            'REMARK',
            'Product Image',
            'Product code',
        );

        foreach($insproducts as $insproduct)
        {
            $insproduct_array[] = array(
                'Old ID' => $insproduct->insproduct_assetID,
                'Asset ID' => $insproduct->insproduct_newassetID,
                'Instrument Type' => $insproduct->insproduct_instype,
                'Instrument Brand' => $insproduct->insproduct_insbrand,
                // 'Serial Number' => $insproduct->insproduct_serial,
                'Material Transfer' => $insproduct->insproduct_transfer,
                'Reservation Number' => $insproduct->insproduct_reser,
                'Ex Station' =>  $insproduct->insproduct_origin,
                'SDV In' => $insproduct->insproduct_sdvin,
                'SDV Out' => $insproduct->insproduct_sdvout,
                'Station' => $insproduct->insproduct_station,
                'Requestor' => $insproduct->insproduct_requestor,
                'Project' =>  $insproduct->insproduct_project,
                'Date In' => $insproduct->insproduct_datein,
                'Date Out' => $insproduct->insproduct_dateout,
                'Date to offshore' =>  $insproduct->insproduct_dateoffshore,
                'Material transfer to offshore' => $insproduct->insproduct_tfoffshore,
                'Current Location' => $insproduct->insproduct_curloc,
                'Target PDN' => $insproduct->insproduct_targetpdn,
                'Stock In' => $insproduct->insproduct_stockin,
                'Dok Stok In' => $insproduct->insproduct_docin,
                'Stok Out' =>  $insproduct->insproduct_stockout,
                'Dok Stok Out' => $insproduct->insproduct_docout,
                'Stock Quality' => $insproduct->insproduct_stockqty,
                'UOM' => $insproduct->insproduct_uom,
                'CS Release' => $insproduct->insproduct_csrelease,
                'CS Number' => $insproduct->insproduct_csnumber,
                'CE Number' => $insproduct->insproduct_cenumber,
                'RO Number' => $insproduct->insproduct_ronumber,
                'Start Date' => $insproduct->insproduct_startdate,
                'End Date' => $insproduct->insproduct_enddate,
                'Price Repair' => $insproduct->insproduct_price,
                'REMARK' => $insproduct->insproduct_remark,
                'Product Image' => $insproduct->insproduct_image,
                'Product Code' => $insproduct->insproduct_code,
            );
        }

        $this->exportExcel($insproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($insproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($insproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="insproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}

