<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Autorepairproduct;
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

class AutorepairproductController extends Controller
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

        $autorepairproducts = Autorepairproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('autorepairproducts.index', [
            'autorepairproducts' => $autorepairproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autorepairproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $autorepairproduct_code = IdGenerator::generate([
            'table' => 'autorepairproducts',
            'field' => 'autorepairproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'autorepairproduct_image' => 'image|file|max:2048',
            'autorepairproduct_status' => 'nullable|string',
            'autorepairproduct_assetID' => 'nullable|string',
            'autorepairproduct_newassetID' => 'nullable|string',
            'autorepairproduct_autobrand' => 'nullable|string',
            'autorepairproduct_datein' => 'nullable|date',
            'autorepairproduct_transfer' => 'nullable|string',
            'autorepairproduct_reser' => 'nullable|string',
            'autorepairproduct_origin' => 'nullable|string',
            'autorepairproduct_sdvin' => 'nullable|string',
            'autorepairproduct_sdvout' => 'nullable|string',
            'autorepairproduct_station' => 'nullable|string',
            'autorepairproduct_requestor' => 'nullable|string',
            'autorepairproduct_project' => 'nullable|string',
            'autorepairproduct_dateout' => 'nullable|date',
            'autorepairproduct_dateoffshore' => 'nullable|date',
            'autorepairproduct_tfoffshore' => 'nullable|string',
            'autorepairproduct_curloc' => 'nullable|string',
            'autorepairproduct_stockin' => 'nullable|integer',
            'autorepairproduct_stockout' => 'nullable|integer',
            'autorepairproduct_docin' => 'mimes:doc,pdf|max:2048',
            'autorepairproduct_docout' => 'mimes:doc,pdf|max:2048',
            'autorepairproduct_dateout' => 'nullable|date',
            'autorepairproduct_stockqty' => 'nullable|integer',
            'autorepairproduct_uom' => 'nullable|string',
            'autorepairproduct_targetpdn' => 'nullable|string',
            'autorepairproduct_csrelease' => 'nullable|string',
            'autorepairproduct_csnumber' => 'nullable|string',
            'autorepairproduct_cenumber' => 'nullable|string',
            'autorepairproduct_ronumber' => 'nullable|string',
            'autorepairproduct_startdate' => 'nullable|date',
            'autorepairproduct_enddate' => 'nullable|date',
            'autorepairproduct_price' => 'nullable|string',
            'autorepairproduct_remark' => 'nullable|string',


        ];

        $validatedData = $request->validate($rules);

        // Save autorepairproduct code value
        $validatedData['autorepairproduct_code'] = $autorepairproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('autorepairproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['autorepairproduct_image'] = $fileName;
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('autorepairproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autorepairproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('autorepairproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autorepairproduct_docout'] = $fileName;
        }


        Autorepairproduct::create($validatedData);

        return Redirect::route('autorepairproducts.index')->with('success', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Autorepairproduct $autorepairproduct)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $code = $autorepairproduct->autorepairproduct_code ?? '';

        if (!empty($code)) {
            $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        } else {
            $barcode = ''; // Set an empty barcode if $code is empty or null
        }

        return view('autorepairproducts.show', [
            'autorepairproduct' => $autorepairproduct,
            'barcode' => $barcode,
        ]);
    }
    public function generatePdf($id)
    {
        $product = Autorepairproduct::find($id);

        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $html = view('dashboard.body.main')->render(); // Render the entire content
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('autorepairproduct_show.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Autorepairproduct $autorepairproduct)
    {
        return view('autorepairproducts.edit', [

            'autorepairproduct' => $autorepairproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autorepairproduct $autorepairproduct)
    {
        $rules = [
            'autorepairproduct_image' => 'image|file|max:2048',
            'autorepairproduct_status' => 'nullable|string',
            'autorepairproduct_assetID' => 'nullable|string',
            'autorepairproduct_newassetID' => 'nullable|string',
            'autorepairproduct_autobrand' => 'nullable|string',
            'autorepairproduct_datein' => 'nullable|date',
            'autorepairproduct_transfer' => 'nullable|string',
            'autorepairproduct_reser' => 'nullable|string',
            'autorepairproduct_origin' => 'nullable|string',
            'autorepairproduct_sdvin' => 'nullable|string',
            'autorepairproduct_sdvout' => 'nullable|string',
            'autorepairproduct_station' => 'nullable|string',
            'autorepairproduct_requestor' => 'nullable|string',
            'autorepairproduct_project' => 'nullable|string',
            'autorepairproduct_dateout' => 'nullable|date',
            'autorepairproduct_dateoffshore' => 'nullable|date',
            'autorepairproduct_tfoffshore' => 'nullable|string',
            'autorepairproduct_curloc' => 'nullable|string',
            'autorepairproduct_stockin' => 'nullable|integer',
            'autorepairproduct_stockout' => 'nullable|integer',
            'autorepairproduct_docin' => 'mimes:doc,pdf|max:2048',
            'autorepairproduct_docout' => 'mimes:doc,pdf|max:2048',
            'autorepairproduct_dateout' => 'nullable|date',
            'autorepairproduct_stockqty' => 'nullable|integer',
            'autorepairproduct_uom' => 'nullable|string',
            'autorepairproduct_targetpdn' => 'nullable|string',
            'autorepairproduct_csrelease' => 'nullable|string',
            'autorepairproduct_csnumber' => 'nullable|string',
            'autorepairproduct_cenumber' => 'nullable|string',
            'autorepairproduct_ronumber' => 'nullable|string',
            'autorepairproduct_startdate' => 'nullable|date',
            'autorepairproduct_enddate' => 'nullable|date',
            'autorepairproduct_price' => 'nullable|string',
            'autorepairproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('autorepairproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($autorepairproduct->autorepairproduct_image){
                $result = str_replace('storage/', '', $autorepairproduct->autorepairproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['autorepairproduct_image'] = $fileName;
        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('autorepairproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($autorepairproduct->autorepairproduct_docin){
                $result = str_replace('storage/', '', $autorepairproduct->autorepairproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autorepairproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('autorepairproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($autorepairproduct->autorepairproduct_docout){
                $result = str_replace('storage/', '', $autorepairproduct->autorepairproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autorepairproduct_docout'] = $fileName;
        }


        Autorepairproduct::where('id', $autorepairproduct->id)->update($validatedData);

        return Redirect::route('autorepairproducts.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autorepairproduct $autorepairproduct)
    {
        /**
         * Delete photo if exists.
         */
        if($autorepairproduct->autorepairproduct_image){
            $result = str_replace('storage/', '', $autorepairproduct->autorepairproduct_image);
            Storage::delete('public/' . $result);

        }

        /**
         * Delete docin if exists.
         */
        if($autorepairproduct->autorepairproduct_docin){
            $result = str_replace('storage/', '', $autorepairproduct->autorepairproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($autorepairproduct->autorepairproduct_docout){
            $result = str_replace('storage/', '', $autorepairproduct->autorepairproduct_docout);
                Storage::delete('public/' . $result);
        }

        Autorepairproduct::destroy($autorepairproduct->id);

        return Redirect::route('autorepairproducts.index')->with('success', 'Product has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('autorepairproducts.import');
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
                    'autorepairproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'autorepairproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'autorepairproduct_brand' => $sheet->getCell( 'C' . $row )->getValue(),
                    'autorepairproduct_datein' => $sheet->getCell( 'D' . $row )->getValue(),
                    'autorepairproduct_transfer' => $sheet->getCell( 'E' . $row )->getValue(),
                    'autorepairproduct_reser' => $sheet->getCell( 'F' . $row )->getValue(),
                    'autorepairproduct_origin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'autorepairproduct_sdvin' => $sheet->getCell( 'H' . $row )->getValue(),
                    'autorepairproduct_sdvout' => $sheet->getCell( 'I' . $row )->getValue(),
                    'autorepairproduct_station' => $sheet->getCell( 'J' . $row )->getValue(),
                    'autorepairproduct_requestor' => $sheet->getCell( 'K' . $row )->getValue(),
                    'autorepairproduct_project' => $sheet->getCell( 'L' . $row )->getValue(),
                    'autorepairproduct_dateout' => $sheet->getCell( 'M' . $row )->getValue(),
                    'autorepairproduct_dateoffshore' => $sheet->getCell( 'N' . $row )->getValue(),
                    'autorepairproduct_tfoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'autorepairproduct_curloc' => $sheet->getCell( 'P' . $row )->getValue(),
                    'autorepairproduct_stockin' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'autorepairproduct_stockout' => $sheet->getCell( 'R' . $row )->getValue(),
                    'autorepairproduct_docin' => $sheet->getCell( 'S' . $row )->getValue(),
                    'autorepairproduct_docout' => $sheet->getCell( 'T' . $row )->getValue(),
                    'autorepairproduct_stockqty' => $sheet->getCell( 'U' . $row )->getValue(),
                    'autorepairproduct_uom' => $sheet->getCell( 'V' . $row )->getValue(),
                    'autorepairproduct_targetpdn' =>$sheet->getCell( 'W' . $row )->getValue(),
                    'autorepairproduct_csrelease' =>$sheet->getCell( 'X' . $row )->getValue(),
                    'autorepairproduct_csnumber' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'autorepairproduct_cenumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'autorepairproduct_ronumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'autorepairproduct_startdate' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'autorepairproduct_enddate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'autorepairproduct_price' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'autorepairproduct_remark' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'autorepairproduct_image' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'autorepairproduct_code' =>$sheet->getCell( 'AG' . $row )->getValue(),
                    'autorepairproduct_status' =>$sheet->getCell( 'AH' . $row )->getValue(),
                
                ];
                $startcount++;
            }

            Autorepairproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('autorepairproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('autorepairproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data autorepairproducts.
     */
    function export(){
        $autorepairproducts = Autorepairproduct::all()->sortBy('autorepairproduct_name');

        $autorepairproduct_array [] = array(
            'Old ID',
            'Asset ID',
            'Automation Brand',
            'Date In',
            'Material Transfer',
            'Reservation Number',
            'Ex Station',
            'SDV In',
            'SDV Out',
            'Station',
            'Requestor',
            'Project',
            'Date Out',
            'Date to offshore',
            'Material transfer to offshore',
            'Current Location',
            'Stock In',
            'Stock Out',
            'Dok Stok In',
            'Dok Stok Out',
            'Stock Quality',
            'UOM',
            'Target PDN',
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

        foreach($autorepairproducts as $autorepairproduct)
        {
            $autorepairproduct_array[] = array(
                'Old ID' => $autorepairproduct->autorepairproduct_assetID,
                'Asset ID' => $autorepairproduct->autorepairproduct_newassetID,
                'Automation Brand' => $autorepairproduct->autorepairproduct_autobrand,
                'Date In' => $autorepairproduct->autorepairproduct_datein,
                'Material Transfer' => $autorepairproduct->autorepairproduct_transfer,
                'Reservation Number' => $autorepairproduct->autorepairproduct_reser,
                'Ex Station' =>  $autorepairproduct->autorepairproduct_origin,
                'SDV In' => $autorepairproduct->autorepairproduct_sdvin,
                'SDV Out' => $autorepairproduct->autorepairproduct_sdvout,
                'Station' => $autorepairproduct->autorepairproduct_station,
                'Requestor' => $autorepairproduct->autorepairproduct_requestor,
                'Project' =>  $autorepairproduct->autorepairproduct_project,
                'Date Out' => $autorepairproduct->autorepairproduct_dateout,
                'Date to offshore' =>  $autorepairproduct->autorepairproduct_dateoffshore,
                'Material transfer to offshore' => $autorepairproduct->autorepairproduct_tfoffshore,
                'Current Location' => $autorepairproduct->autorepairproduct_curloc,
                'Stock In' => $autorepairproduct->autorepairproduct_stockin,
                'Stock Out' => $autorepairproduct->autorepairproduct_docin,
                'Dok Stok In' =>  $autorepairproduct->autorepairproduct_stockout,
                'Dok Stok Out' => $autorepairproduct->autorepairproduct_docout,
                'Stock Quality' => $autorepairproduct->autorepairproduct_stockqty,
                'UOM' => $autorepairproduct->autorepairproduct_uom,
                'Target PDN' => $autorepairproduct->autorepairproduct_targetpdn,
                'CS Release' => $autorepairproduct->autorepairproduct_csrelease,
                'CS Number' => $autorepairproduct->autorepairproduct_csnumber,
                'CE Number' => $autorepairproduct->autorepairproduct_cenumber,
                'RO Number' => $autorepairproduct->autorepairproduct_ronumber,
                'Start Date' => $autorepairproduct->autorepairproduct_startdate,
                'End Date' => $autorepairproduct->autorepairproduct_enddate,
                'Price Repair' => $autorepairproduct->autorepairproduct_price,
                'REMARK' => $autorepairproduct->autorepairproduct_remark,
                'autorepairproduct Image' => $autorepairproduct->autorepairproduct_image,
                'autorepairproduct Code' => $autorepairproduct->autorepairproduct_code,
                'Status' => $autorepairproduct->autorepairproduct_status,
                
            );
        }

        $this->exportExcel($autorepairproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($autorepairproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($autorepairproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="autorepairproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}
