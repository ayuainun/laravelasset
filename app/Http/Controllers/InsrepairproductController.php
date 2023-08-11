<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Insrepairproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class InsrepairproductController extends Controller
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

        $insrepairproducts = Insrepairproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('insrepairproducts.index', [
            'insrepairproducts' => $insrepairproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('insrepairproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $insrepairproduct_code = IdGenerator::generate([
            'table' => 'insrepairproducts',
            'field' => 'insrepairproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'insrepairproduct_image' => 'image|file|max:2048',
            'insrepairproduct_assetID' => 'nullable|string',
            'insrepairproduct_newassetID' => 'nullable|string',
            'insrepairproduct_instype' => 'nullable|string',
            'insrepairproduct_insbrand' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'insrepairproduct_transfer' => 'nullable|string',
            'insrepairproduct_reser' => 'nullable|string',
            'insrepairproduct_origin' => 'nullable|string',
            'insrepairproduct_sdvin' => 'nullable|string',
            'insrepairproduct_sdvout' => 'nullable|string',
            'insrepairproduct_station' => 'nullable|string',
            'insrepairproduct_requestor' => 'nullable|string',
            'insrepairproduct_project' => 'nullable|string',
            'insrepairproduct_datein' => 'nullable|date',
            'insrepairproduct_dateout' => 'nullable|date',
            'insrepairproduct_dateoffshore' => 'nullable|date',
            'insrepairproduct_tfoffshore' => 'nullable|string',
            'insrepairproduct_curloc' => 'nullable|string',
            'insrepairproduct_targetpdn' => 'nullable|string',
            'insrepairproduct_stockin' => 'nullable|integer',
            'insrepairproduct_stockout' => 'nullable|integer',
            'insrepairproduct_docin' => 'mimes:doc,pdf|max:2048',
            'insrepairproduct_docout' => 'mimes:doc,pdf|max:2048',
            'insrepairproduct_stockqty' => 'nullable|integer',
            'insrepairproduct_uom' => 'nullable|string',
            'insrepairproduct_csrelease' => 'nullable|string',
            'insrepairproduct_csnumber' => 'nullable|string',
            'insrepairproduct_cenumber' => 'nullable|string',
            'insrepairproduct_ronumber' => 'nullable|string',
            'insrepairproduct_startdate' => 'nullable|date',
            'insrepairproduct_enddate' => 'nullable|date',
            'insrepairproduct_price' => 'nullable|string',
            'insrepairproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        // Save insrepairproduct code value
        $validatedData['insrepairproduct_code'] = $insrepairproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('insreparproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['insrepairproduct_image'] = $fileName;
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('insrepairproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insrepairproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('insrepairproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insrepairproduct_docout'] = $fileName;
        }

        Insrepairproduct::create($validatedData);

        return Redirect::route('insrepairproducts.index')->with('success', 'Instrument has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insrepairproduct $insrepairproduct)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $code = $insrepairproduct->insrepairproduct_code ?? '';

        if (!empty($code)) {
            $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        } else {
            $barcode = ''; // Set an empty barcode if $code is empty or null
        }

        return view('insrepairproducts.show', [
            'insrepairproduct' => $insrepairproduct,
            'barcode' => $barcode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insrepairproduct $insrepairproduct)
    {
        return view('insrepairproducts.edit', [
            'insrepairproduct' => $insrepairproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insrepairproduct $insrepairproduct)
    {
        $rules = [
            'insrepairproduct_image' => 'image|file|max:2048',
            'insrepairproduct_assetID' => 'nullable|string',
            'insrepairproduct_newassetID' => 'nullable|string',
            'insrepairproduct_instype' => 'nullable|string',
            'insrepairproduct_insbrand' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'insrepairproduct_transfer' => 'nullable|string',
            'insrepairproduct_reser' => 'nullable|string',
            'insrepairproduct_origin' => 'nullable|string',
            'insrepairproduct_sdvin' => 'nullable|string',
            'insrepairproduct_sdvout' => 'nullable|string',
            'insrepairproduct_station' => 'nullable|string',
            'insrepairproduct_requestor' => 'nullable|string',
            'insrepairproduct_project' => 'nullable|string',
            'insrepairproduct_datein' => 'nullable|date',
            'insrepairproduct_dateout' => 'nullable|date',
            'insrepairproduct_dateoffshore' => 'nullable|date',
            'insrepairproduct_tfoffshore' => 'nullable|string',
            'insrepairproduct_curloc' => 'nullable|string',
            'insrepairproduct_targetpdn' => 'nullable|string',
            'insrepairproduct_stockin' => 'nullable|integer',
            'insrepairproduct_stockout' => 'nullable|integer',
            'insrepairproduct_docin' => 'mimes:doc,pdf|max:2048',
            'insrepairproduct_docout' => 'mimes:doc,pdf|max:2048',
            'insrepairproduct_stockqty' => 'nullable|integer',
            'insrepairproduct_uom' => 'nullable|string',
            'insrepairproduct_csrelease' => 'nullable|string',
            'insrepairproduct_csnumber' => 'nullable|string',
            'insrepairproduct_cenumber' => 'nullable|string',
            'insrepairproduct_ronumber' => 'nullable|string',
            'insrepairproduct_startdate' => 'nullable|date',
            'insrepairproduct_enddate' => 'nullable|date',
            'insrepairproduct_price' => 'nullable|string',
            'insrepairproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('insrepairproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($insrepairproduct->insrepairproduct_image){
                $result = str_replace('storage/', '', $insrepairproduct->insrepairproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['insrepairproduct_image'] = $fileName;
        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('insrepairproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($insrepairproduct->insrepairproduct_docin){
                $result = str_replace('storage/', '', $insrepairproduct->insrepairproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insrepairproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('insrepairproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($insrepairproduct->insrepairproduct_docout){
                $result = str_replace('storage/', '', $insrepairproduct->insrepairproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['insrepairproduct_docout'] = $fileName;
        }

        Insrepairproduct::where('id', $insrepairproduct->id)->update($validatedData);

        return Redirect::route('insrepairproducts.index')->with('success', 'Instrument has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insrepairproduct $insrepairproduct)
    {
        /**
         * Delete photo if exists.
         */
        if($insrepairproduct->insrepairproduct_image){
            $result = str_replace('storage/', '', $insrepairproduct->insrepairproduct_image);
                Storage::delete('public/' . $result);
        }

        /**
         * Delete docin if exists.
         */
        if($insrepairproduct->insrepairproduct_docin){
            $result = str_replace('storage/', '', $insrepairproduct->insrepairproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($insrepairproduct->insrepairproduct_docout){
            $result = str_replace('storage/', '', $insrepairproduct->insrepairproduct_docout);
                Storage::delete('public/' . $result);
        }
        
        Insrepairproduct::destroy($insrepairproduct->id);

        return Redirect::route('insrepairproducts.index')->with('success', 'Instrument has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('insrepairproducts.import');
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
                    'insrepairproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'insrepairproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'insrepairproduct_instype' => $sheet->getCell( 'C' . $row )->getValue(),
                    'insrepairproduct_insbrand' => $sheet->getCell( 'D' . $row )->getValue(),
                    'insrepairproduct_transfer' => $sheet->getCell( 'E' . $row )->getValue(),
                    'insrepairproduct_reser' => $sheet->getCell( 'F' . $row )->getValue(),
                    'insrepairproduct_origin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'insrepairproduct_sdvin' => $sheet->getCell( 'H' . $row )->getValue(),
                    'insrepairproduct_sdvout' => $sheet->getCell( 'I' . $row )->getValue(),
                    'insrepairproduct_station' => $sheet->getCell( 'J' . $row )->getValue(),
                    'insrepairproduct_requestor' => $sheet->getCell( 'K' . $row )->getValue(),
                    'insrepairproduct_project' => $sheet->getCell( 'L' . $row )->getValue(),
                    'insrepairproduct_datein' => $sheet->getCell( 'M' . $row )->getValue(),
                    'insrepairproduct_dateout' => $sheet->getCell( 'N' . $row )->getValue(),
                    'insrepairproduct_dateoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'insrepairproduct_tfoffshore' => $sheet->getCell( 'P' . $row )->getValue(),
                    'insrepairproduct_curloc' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'insrepairproduct_targetpdn' =>$sheet->getCell( 'R' . $row )->getValue(),
                    'insrepairproduct_stockin' => $sheet->getCell( 'S' . $row )->getValue(),
                    'insrepairproduct_stockout' => $sheet->getCell( 'T' . $row )->getValue(),
                    'insrepairproduct_docin' => $sheet->getCell( 'U' . $row )->getValue(),
                    'insrepairproduct_docout' => $sheet->getCell( 'V' . $row )->getValue(),
                    'insrepairproduct_stockqty' => $sheet->getCell( 'W' . $row )->getValue(),
                    'insrepairproduct_uom' => $sheet->getCell( 'X' . $row )->getValue(),
                    'insrepairproduct_csrelease' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'insrepairproduct_csnumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'insrepairproduct_cenumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'insrepairproduct_ronumber' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'insrepairproduct_startdate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'insrepairproduct_enddate' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'insrepairproduct_price' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'insrepairproduct_remark' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'insrepairproduct_image' =>$sheet->getCell( 'AG' . $row )->getValue(),
                    'insrepairproduct_code' =>$sheet->getCell( 'AH' . $row )->getValue(),
                ];
                $startcount++;
            }

            Insrepairproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('insrepairproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('insrepairproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $insrepairproducts = Insrepairproduct::all()->sortBy('insrepairproduct_type');

        $insrepairproduct_array [] = array(
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

        foreach($insrepairproducts as $insrepairproduct)
        {
            $insrepairproduct_array[] = array(
                'Old ID' => $insrepairproduct->insrepairproduct_assetID,
                'Asset ID' => $insrepairproduct->insrepairproduct_newassetID,
                'Instrument Type' => $insrepairproduct->insrepairproduct_instype,
                'Instrument Brand' => $insrepairproduct->insrepairproduct_insbrand,
                // 'Serial Number' => $insrepairproduct->insrepairproduct_serial,
                'Material Transfer' => $insrepairproduct->insrepairproduct_transfer,
                'Reservation Number' => $insrepairproduct->insrepairproduct_reser,
                'Ex Station' =>  $insrepairproduct->insrepairproduct_origin,
                'SDV In' => $insrepairproduct->insrepairproduct_sdvin,
                'SDV Out' => $insrepairproduct->insrepairproduct_sdvout,
                'Station' => $insrepairproduct->insrepairproduct_station,
                'Requestor' => $insrepairproduct->insrepairproduct_requestor,
                'Project' =>  $insrepairproduct->insrepairproduct_project,
                'Date In' => $insrepairproduct->insrepairproduct_datein,
                'Date Out' => $insrepairproduct->insrepairproduct_dateout,
                'Date to offshore' =>  $insrepairproduct->insrepairproduct_dateoffshore,
                'Material transfer to offshore' => $insrepairproduct->insrepairproduct_tfoffshore,
                'Current Location' => $insrepairproduct->insrepairproduct_curloc,
                'Target PDN' => $insrepairproduct->insrepairproduct_targetpdn,
                'Stock In' => $insrepairproduct->insrepairproduct_stockin,
                'Dok Stok In' => $insrepairproduct->insrepairproduct_docin,
                'Stok Out' =>  $insrepairproduct->insrepairproduct_stockout,
                'Dok Stok Out' => $insrepairproduct->insrepairproduct_docout,
                'Stock Quality' => $insrepairproduct->insrepairproduct_stockqty,
                'UOM' => $insrepairproduct->insrepairproduct_uom,
                'CS Release' => $insrepairproduct->insrepairproduct_csrelease,
                'CS Number' => $insrepairproduct->insrepairproduct_csnumber,
                'CE Number' => $insrepairproduct->insrepairproduct_cenumber,
                'RO Number' => $insrepairproduct->insrepairproduct_ronumber,
                'Start Date' => $insrepairproduct->insrepairproduct_startdate,
                'End Date' => $insrepairproduct->insrepairproduct_enddate,
                'Price Repair' => $insrepairproduct->insrepairproduct_price,
                'REMARK' => $insrepairproduct->insrepairproduct_remark,
                'Product Image' => $insrepairproduct->insrepairproduct_image,
                'Product Code' => $insrepairproduct->insrepairproduct_code,
            );
        }

        $this->exportExcel($insrepairproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($insrepairproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($insrepairproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="insrepairproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}

