<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Autoproduct;
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

class AutoproductController extends Controller
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

        $autoproducts = Autoproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('autoproducts.index', [
            'autoproducts' => $autoproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autoproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $autoproduct_code = IdGenerator::generate([
            'table' => 'autoproducts',
            'field' => 'autoproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'autoproduct_image' => 'image|file|max:2048',
            'autoproduct_status' => 'nullable|string',
            'autoproduct_assetID' => 'nullable|string',
            'autoproduct_newassetID' => 'nullable|string',
            'autoproduct_brand' => 'nullable|string',
            'autoproduct_datein' => 'nullable|date',
            'autoproduct_transfer' => 'nullable|string',
            'autoproduct_reser' => 'nullable|string',
            'autoproduct_origin' => 'nullable|string',
            'autoproduct_sdvin' => 'nullable|string',
            'autoproduct_sdvout' => 'nullable|string',
            'autoproduct_station' => 'nullable|string',
            'autoproduct_requestor' => 'nullable|string',
            'autoproduct_project' => 'nullable|string',
            'autoproduct_dateout' => 'nullable|date',
            'autoproduct_dateoffshore' => 'nullable|date',
            'autoproduct_tfoffshore' => 'nullable|string',
            'autoproduct_curloc' => 'nullable|string',
            'autoproduct_stockin' => 'nullable|integer',
            'autoproduct_stockout' => 'nullable|integer',
            'autoproduct_docin' => 'mimes:doc,pdf|max:2048',
            'autoproduct_docout' => 'mimes:doc,pdf|max:2048',
            'autoproduct_dateout' => 'nullable|date',
            'autoproduct_stockqty' => 'nullable|integer',
            'autoproduct_uom' => 'nullable|string',
            'autoproduct_targetpdn' => 'nullable|string',
            'autoproduct_csrelease' => 'nullable|string',
            'autoproduct_csnumber' => 'nullable|string',
            'autoproduct_cenumber' => 'nullable|string',
            'autoproduct_ronumber' => 'nullable|string',
            'autoproduct_startdate' => 'nullable|date',
            'autoproduct_enddate' => 'nullable|date',
            'autoproduct_price' => 'nullable|string',
            'autoproduct_remark' => 'nullable|string',


        ];

        $validatedData = $request->validate($rules);

        // Save autoproduct code value
        $validatedData['autoproduct_code'] = $autoproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('autoproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['autoproduct_image'] = $fileName;

        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('autoproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autoproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('autoproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autoproduct_docout'] = $fileName;
        }


        Autoproduct::create($validatedData);

        return Redirect::route('autoproducts.index')->with('success', 'Product has been created!');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Autoproduct $autoproduct)
    // {
    //     // Generate a barcode
    //     $generator = new BarcodeGeneratorHTML();

    //     $barcode = $generator->getBarcode($autoproduct->autoproduct_code, $generator::TYPE_CODE_128);

    //     return view('autoproducts.show', [
    //         'autoproduct' => $autoproduct,
    //         'barcode' => $barcode,
    //     ]);
    // }

        public function show(Autoproduct $autoproduct)
        {
            // Generate a barcode
            $generator = new BarcodeGeneratorHTML();
            $code = $autoproduct->autoproduct_code ?? '';

            if (!empty($code)) {
                $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
            } else {
                $barcode = ''; // Set an empty barcode if $code is empty or null
            }

            return view('autoproducts.show', [
                'autoproduct' => $autoproduct,
                'barcode' => $barcode,
            ]);
        }
        public function generatePdf($id)
        {
            $product = Autoproduct::find($id);

            $pdfOptions = new Options();
            $pdfOptions->set('isHtml5ParserEnabled', true);
            $pdfOptions->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($pdfOptions);
            $html = view('dashboard.body.main')->render(); // Render the entire content
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $dompdf->stream('autoproduct_show.pdf');
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Autoproduct $autoproduct)
    {
        return view('autoproducts.edit', [
            'autoproduct' => $autoproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autoproduct $autoproduct)
    {
        $rules = [
            'autoproduct_image' => 'image|file|max:2048',
            'autoproduct_status' => 'nullable|string',
            'autoproduct_assetID' => 'nullable|string',
            'autoproduct_newassetID' => 'nullable|string',
            'autoproduct_brand' => 'nullable|string',
            'autoproduct_datein' => 'nullable|date',
            'autoproduct_transfer' => 'nullable|string',
            'autoproduct_reser' => 'nullable|string',
            'autoproduct_origin' => 'nullable|string',
            'autoproduct_sdvin' => 'nullable|string',
            'autoproduct_sdvout' => 'nullable|string',
            'autoproduct_station' => 'nullable|string',
            'autoproduct_requestor' => 'nullable|string',
            'autoproduct_project' => 'nullable|string',
            'autoproduct_dateout' => 'nullable|date',
            'autoproduct_dateoffshore' => 'nullable|date',
            'autoproduct_tfoffshore' => 'nullable|string',
            'autoproduct_curloc' => 'nullable|string',
            'autoproduct_stockin' => 'nullable|integer',
            'autoproduct_stockout' => 'nullable|integer',
            'autoproduct_docin' => 'mimes:doc,pdf|max:2048',
            'autoproduct_docout' => 'mimes:doc,pdf|max:2048',
            'autoproduct_dateout' => 'nullable|date',
            'autoproduct_stockqty' => 'nullable|integer',
            'autoproduct_uom' => 'nullable|string',
            'autoproduct_targetpdn' => 'nullable|string',
            'autoproduct_csrelease' => 'nullable|string',
            'autoproduct_csnumber' => 'nullable|string',
            'autoproduct_cenumber' => 'nullable|string',
            'autoproduct_ronumber' => 'nullable|string',
            'autoproduct_startdate' => 'nullable|date',
            'autoproduct_enddate' => 'nullable|date',
            'autoproduct_price' => 'nullable|string',
            'autoproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('autoproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($autoproduct->autoproduct_image){
                $result = str_replace('storage/', '', $autoproduct->autoproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['autoproduct_image'] = $fileName;
        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('autoproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($autoproduct->autoproduct_docin){
                $result = str_replace('storage/', '', $autoproduct->autoproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autoproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('autoproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($autoproduct->autoproduct_docout){
                $result = str_replace('storage/', '', $autoproduct->autoproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['autoproduct_docout'] = $fileName;
        }

        Autoproduct::where('id', $autoproduct->id)->update($validatedData);

        return Redirect::route('autoproducts.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autoproduct $autoproduct)
    {
       /**
         * Delete photo if exists.
         */
        if($autoproduct->autoproduct_image){
            $result = str_replace('storage/', '', $autoproduct->autoproduct_image);
                Storage::delete('public/' . $result);
        }

        /**
         * Delete docin if exists.
         */
        if($autoproduct->autoproduct_docin){
            $result = str_replace('storage/', '', $autoproduct->autoproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($autoproduct->autoproduct_docout){
            $result = str_replace('storage/', '', $autoproduct->autoproduct_docout);
                Storage::delete('public/' . $result);
        }

        Autoproduct::destroy($autoproduct->id);

        return Redirect::route('autoproducts.index')->with('success', 'Product has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('autoproducts.import');
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
                    'autoproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'autoproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'autoproduct_brand' => $sheet->getCell( 'C' . $row )->getValue(),
                    'autoproduct_datein' => $sheet->getCell( 'D' . $row )->getValue(),
                    'autoproduct_transfer' => $sheet->getCell( 'E' . $row )->getValue(),
                    'autoproduct_reser' => $sheet->getCell( 'F' . $row )->getValue(),
                    'autoproduct_origin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'autoproduct_sdvin' => $sheet->getCell( 'H' . $row )->getValue(),
                    'autoproduct_sdvout' => $sheet->getCell( 'I' . $row )->getValue(),
                    'autoproduct_station' => $sheet->getCell( 'J' . $row )->getValue(),
                    'autoproduct_requestor' => $sheet->getCell( 'K' . $row )->getValue(),
                    'autoproduct_project' => $sheet->getCell( 'L' . $row )->getValue(),
                    'autoproduct_dateout' => $sheet->getCell( 'M' . $row )->getValue(),
                    'autoproduct_dateoffshore' => $sheet->getCell( 'N' . $row )->getValue(),
                    'autoproduct_tfoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'autoproduct_curloc' => $sheet->getCell( 'P' . $row )->getValue(),
                    'autoproduct_stockin' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'autoproduct_stockout' => $sheet->getCell( 'R' . $row )->getValue(),
                    'autoproduct_docin' => $sheet->getCell( 'S' . $row )->getValue(),
                    'autoproduct_docout' => $sheet->getCell( 'T' . $row )->getValue(),
                    'autoproduct_stockqty' => $sheet->getCell( 'U' . $row )->getValue(),
                    'autoproduct_uom' => $sheet->getCell( 'V' . $row )->getValue(),
                    'autoproduct_targetpdn' =>$sheet->getCell( 'W' . $row )->getValue(),
                    'autoproduct_csrelease' =>$sheet->getCell( 'X' . $row )->getValue(),
                    'autoproduct_csnumber' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'autoproduct_cenumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'autoproduct_ronumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'autoproduct_startdate' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'autoproduct_enddate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'autoproduct_price' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'autoproduct_remark' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'autoproduct_image' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'autoproduct_code' =>$sheet->getCell( 'AG' . $row )->getValue(),
                    'autoproduct_status' =>$sheet->getCell( 'AH' . $row )->getValue(),

                ];
                $startcount++;
            }

            Autoproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('autoproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('autoproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data autoproducts.
     */
    function export(){
        $autoproducts = Autoproduct::all()->sortBy('autoproduct_name');

        $autoproduct_array [] = array(
            'Old ID',
            'New ID',
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

        foreach($autoproducts as $autoproduct)
        {
            $autoproduct_array[] = array(
                'Old ID' => $autoproduct->autoproduct_assetID,
                'New ID' => $autoproduct->autoproduct_newassetID,
                'Automation Brand' => $autoproduct->autoproduct_brand,
                'Date In' => $autoproduct->autoproduct_datein,
                'Material Transfer' => $autoproduct->autoproduct_transfer,
                'Reservation Number' => $autoproduct->autoproduct_reser,
                'Ex Station' =>  $autoproduct->autoproduct_origin,
                'SDV In' => $autoproduct->autoproduct_sdvin,
                'SDV Out' => $autoproduct->autoproduct_sdvout,
                'Station' => $autoproduct->autoproduct_station,
                'Requestor' => $autoproduct->autoproduct_requestor,
                'Project' =>  $autoproduct->autoproduct_project,
                'Date Out' => $autoproduct->autoproduct_dateout,
                'Date to offshore' =>  $autoproduct->autoproduct_dateoffshore,
                'Material transfer to offshore' => $autoproduct->autoproduct_tfoffshore,
                'Current Location' => $autoproduct->autoproduct_curloc,
                'Stock In' => $autoproduct->autoproduct_stockin,
                'Stock Out' => $autoproduct->autoproduct_docin,
                'Dok Stok In' =>  $autoproduct->autoproduct_stockout,
                'Dok Stok Out' => $autoproduct->autoproduct_docout,
                'Stock Quality' => $autoproduct->autoproduct_stockqty,
                'UOM' => $autoproduct->autoproduct_uom,
                'Target PDN' => $autoproduct->autoproduct_targetpdn,
                'CS Release' => $autoproduct->autoproduct_csrelease,
                'CS Number' => $autoproduct->autoproduct_csnumber,
                'CE Number' => $autoproduct->autoproduct_cenumber,
                'RO Number' => $autoproduct->autoproduct_ronumber,
                'Start Date' => $autoproduct->autoproduct_startdate,
                'End Date' => $autoproduct->autoproduct_enddate,
                'Price Repair' => $autoproduct->autoproduct_price,
                'REMARK' => $autoproduct->autoproduct_remark,
                'Product Image' => $autoproduct->autoproduct_image,
                'Product Code' => $autoproduct->autoproduct_code,
                'Status' => $autoproduct->autoproduct_status,

            );
        }

        $this->exportExcel($autoproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($autoproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($autoproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="autoproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}
