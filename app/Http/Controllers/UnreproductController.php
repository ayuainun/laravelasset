<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Unreproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class UnreproductController extends Controller
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

        $unreproducts = Unreproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('unreproducts.index', [
            'unreproducts' => $unreproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unreproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unreproduct_code = IdGenerator::generate([
            'table' => 'unreproducts',
            'field' => 'unreproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'unreproduct_image' => 'image|file|max:2048',
            'unreproduct_status' => 'nullable|string',
            'unreproduct_assetID' => 'nullable|string',
            'unreproduct_newassetID' => 'nullable|string',
            'unreproduct_desc' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'unreproduct_transfer' => 'nullable|string',
            'unreproduct_reser' => 'nullable|string',
            'unreproduct_origin' => 'nullable|string',
            'unreproduct_sdvin' => 'nullable|string',
            'unreproduct_sdvout' => 'nullable|string',
            'unreproduct_station' => 'nullable|string',
            'unreproduct_requestor' => 'nullable|string',
            'unreproduct_project' => 'nullable|string',
            'unreproduct_datein' => 'nullable|date',
            'unreproduct_dateout' => 'nullable|date',
            'unreproduct_dateoffshore' => 'nullable|date',
            'unreproduct_tfoffshore' => 'nullable|string',
            'unreproduct_curloc' => 'nullable|string',
            'unreproduct_targetpdn' => 'nullable|string',
            'unreproduct_stockin' => 'nullable|integer',
            'unreproduct_stockout' => 'nullable|integer',
            'unreproduct_docin' => 'mimes:doc,pdf|max:2048',
            'unreproduct_docout' => 'mimes:doc,pdf|max:2048',
            'unreproduct_stockqty' => 'nullable|integer',
            'unreproduct_uom' => 'nullable|string',
            'unreproduct_csrelease' => 'nullable|string',
            'unreproduct_csnumber' => 'nullable|string',
            'unreproduct_cenumber' => 'nullable|string',
            'unreproduct_ronumber' => 'nullable|string',
            'unreproduct_startdate' => 'nullable|date',
            'unreproduct_enddate' => 'nullable|date',
            'unreproduct_price' => 'nullable|string',
            'unreproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        // Save unreproduct code value
        $validatedData['unreproduct_code'] = $unreproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('unreproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['unreproduct_image'] = $fileName;
        
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('unreproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['unreproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('unreproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['unreproduct_docout'] = $fileName;
        }


        Unreproduct::create($validatedData);

        return Redirect::route('unreproducts.index')->with('success', 'Unrepairable Asset has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unreproduct $unreproduct)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $code = $unreproduct->unreproduct_code ?? '';

        if (!empty($code)) {
            $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        } else {
            $barcode = ''; // Set an empty barcode if $code is empty or null
        }

        return view('unreproducts.show', [
            'unreproduct' => $unreproduct,
            'barcode' => $barcode,
        ]);
    }
    public function generatePdf($id)
        {
            $product = Unreproduct::find($id);

            $pdfOptions = new Options();
            $pdfOptions->set('isHtml5ParserEnabled', true);
            $pdfOptions->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($pdfOptions);
            $html = view('dashboard.body.main')->render(); // Render the entire content
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $dompdf->stream('unreproduct_show.pdf');
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unreproduct $unreproduct)
    {
        return view('unreproducts.edit', [
            'unreproduct' => $unreproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unreproduct $unreproduct)
    {
        $rules = [
            'unreproduct_image' => 'image|file|max:2048',
            'unreproduct_status' => 'nullable|string',
            'unreproduct_assetID' => 'nullable|string',
            'unreproduct_newassetID' => 'nullable|string',
            'unreproduct_desc' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'unreproduct_transfer' => 'nullable|string',
            'unreproduct_reser' => 'nullable|string',
            'unreproduct_origin' => 'nullable|string',
            'unreproduct_sdvin' => 'nullable|string',
            'unreproduct_sdvout' => 'nullable|string',
            'unreproduct_station' => 'nullable|string',
            'unreproduct_requestor' => 'nullable|string',
            'unreproduct_project' => 'nullable|string',
            'unreproduct_datein' => 'nullable|date',
            'unreproduct_dateout' => 'nullable|date',
            'unreproduct_dateoffshore' => 'nullable|date',
            'unreproduct_tfoffshore' => 'nullable|string',
            'unreproduct_curloc' => 'nullable|string',
            'unreproduct_targetpdn' => 'nullable|string',
            'unreproduct_stockin' => 'nullable|integer',
            'unreproduct_stockout' => 'nullable|integer',
            'unreproduct_docin' => 'mimes:doc,pdf|max:2048',
            'unreproduct_docout' => 'mimes:doc,pdf|max:2048',
            'unreproduct_stockqty' => 'nullable|integer',
            'unreproduct_uom' => 'nullable|string',
            'unreproduct_csrelease' => 'nullable|string',
            'unreproduct_csnumber' => 'nullable|string',
            'unreproduct_cenumber' => 'nullable|string',
            'unreproduct_ronumber' => 'nullable|string',
            'unreproduct_startdate' => 'nullable|date',
            'unreproduct_enddate' => 'nullable|date',
            'unreproduct_price' => 'nullable|string',
            'unreproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('unreproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($unreproduct->unreproduct_image){
                $result = str_replace('storage/', '', $unreproduct->unreproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['unreproduct_image'] = $fileName;
        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('unreproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($unreproduct->unreproduct_docin){
                $result = str_replace('storage/', '', $unreproduct->unreproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['unreproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('unreproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($unreproduct->unreproduct_docout){
                $result = str_replace('storage/', '', $unreproduct->unreproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['unreproduct_docout'] = $fileName;
        }

        Unreproduct::where('id', $unreproduct->id)->update($validatedData);

        return Redirect::route('unreproducts.index')->with('success', 'Unrepairable Asset has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unreproduct $unreproduct)
    {
       /**
         * Delete photo if exists.
         */
        if($unreproduct->unreproduct_image){
            $result = str_replace('storage/', '', $unreproduct->unreproduct_image);
                Storage::delete('public/' . $result);
        }

        /**
         * Delete docin if exists.
         */
        if($unreproduct->unreproduct_docin){
            $result = str_replace('storage/', '', $unreproduct->unreproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($unreproduct->unreproduct_docout){
            $result = str_replace('storage/', '', $unreproduct->unreproduct_docout);
                Storage::delete('public/' . $result);
        }
        
        Unreproduct::destroy($unreproduct->id);

        return Redirect::route('unreproducts.index')->with('success', 'Unrepairable Asset has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('unreproducts.import');
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
            $column_range = range( 'AK', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'unreproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'unreproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'unreproduct_desc' => $sheet->getCell( 'C' . $row )->getValue(),
                    'unreproduct_transfer' => $sheet->getCell( 'E' . $row )->getValue(),
                    'unreproduct_reser' => $sheet->getCell( 'F' . $row )->getValue(),
                    'unreproduct_origin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'unreproduct_sdvin' => $sheet->getCell( 'H' . $row )->getValue(),
                    'unreproduct_sdvout' => $sheet->getCell( 'I' . $row )->getValue(),
                    'unreproduct_station' => $sheet->getCell( 'J' . $row )->getValue(),
                    'unreproduct_requestor' => $sheet->getCell( 'K' . $row )->getValue(),
                    'unreproduct_project' => $sheet->getCell( 'L' . $row )->getValue(),
                    'unreproduct_datein' => $sheet->getCell( 'M' . $row )->getValue(),
                    'unreproduct_dateout' => $sheet->getCell( 'N' . $row )->getValue(),
                    'unreproduct_dateoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'unreproduct_tfoffshore' => $sheet->getCell( 'P' . $row )->getValue(),
                    'unreproduct_curloc' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'unreproduct_targetpdn' =>$sheet->getCell( 'R' . $row )->getValue(),
                    'unreproduct_stockin' => $sheet->getCell( 'S' . $row )->getValue(),
                    'unreproduct_stockout' => $sheet->getCell( 'T' . $row )->getValue(),
                    'unreproduct_docin' => $sheet->getCell( 'U' . $row )->getValue(),
                    'unreproduct_docout' => $sheet->getCell( 'V' . $row )->getValue(),
                    'unreproduct_stockqty' => $sheet->getCell( 'W' . $row )->getValue(),
                    'unreproduct_uom' => $sheet->getCell( 'X' . $row )->getValue(),
                    'unreproduct_csrelease' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'unreproduct_csnumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'unreproduct_cenumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'unreproduct_ronumber' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'unreproduct_startdate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'unreproduct_enddate' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'unreproduct_price' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'unreproduct_remark' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'unreproduct_image' =>$sheet->getCell( 'AG' . $row )->getValue(),
                    'unreproduct_code' =>$sheet->getCell( 'AH' . $row )->getValue(),
                    'unreproduct_status' =>$sheet->getCell( 'AI' . $row )->getValue(),
                    
                ];
                $startcount++;
            }

            Unreproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('unreproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('unreproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $unreproducts = Unreproduct::all()->sortBy('unreproduct_newassetID');

        $unreproduct_array [] = array(
            'Old ID',
            'New ID',
            'Description',
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
            'Status',

        );

        foreach($unreproducts as $unreproduct)
        {
            $unreproduct_array[] = array(
                'Old ID' => $unreproduct->unreproduct_assetID,
                'New ID' => $unreproduct->unreproduct_newassetID,
                'Description' => $unreproduct->unreproduct_desc,
                // 'Serial Number' => $unreproduct->unreproduct_serial,
                'Material Transfer' => $unreproduct->unreproduct_transfer,
                'Reservation Number' => $unreproduct->unreproduct_reser,
                'Ex Station' =>  $unreproduct->unreproduct_origin,
                'SDV In' => $unreproduct->unreproduct_sdvin,
                'SDV Out' => $unreproduct->unreproduct_sdvout,
                'Station' => $unreproduct->unreproduct_station,
                'Requestor' => $unreproduct->unreproduct_requestor,
                'Project' =>  $unreproduct->unreproduct_project,
                'Date In' => $unreproduct->unreproduct_datein,
                'Date Out' => $unreproduct->unreproduct_dateout,
                'Date to offshore' =>  $unreproduct->unreproduct_dateoffshore,
                'Material transfer to offshore' => $unreproduct->unreproduct_tfoffshore,
                'Current Location' => $unreproduct->unreproduct_curloc,
                'Target PDN' => $unreproduct->unreproduct_targetpdn,
                'Stock In' => $unreproduct->unreproduct_stockin,
                'Dok Stok In' => $unreproduct->unreproduct_docin,
                'Stok Out' =>  $unreproduct->unreproduct_stockout,
                'Dok Stok Out' => $unreproduct->unreproduct_docout,
                'Stock Quality' => $unreproduct->unreproduct_stockqty,
                'UOM' => $unreproduct->unreproduct_uom,
                'CS Release' => $unreproduct->unreproduct_csrelease,
                'CS Number' => $unreproduct->unreproduct_csnumber,
                'CE Number' => $unreproduct->unreproduct_cenumber,
                'RO Number' => $unreproduct->unreproduct_ronumber,
                'Start Date' => $unreproduct->unreproduct_startdate,
                'End Date' => $unreproduct->unreproduct_enddate,
                'Price Repair' => $unreproduct->unreproduct_price,
                'REMARK' => $unreproduct->unreproduct_remark,
                'Product Image' => $unreproduct->unreproduct_image,
                'Product Code' => $unreproduct->unreproduct_code,
                'Status' => $unreproduct->unreproduct_status,

            );
        }

        $this->exportExcel($unreproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($unreproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($unreproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="unreproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}

