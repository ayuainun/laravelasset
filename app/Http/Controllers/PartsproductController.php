<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Partsproduct;
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

class PartsproductController extends Controller
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

        $partsproducts = Partsproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('partsproducts.index', [
            'partsproducts' => $partsproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partsproducts.create', [
  
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $partsproduct_code = IdGenerator::generate([
            'table' => 'partsproducts',
            'field' => 'partsproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'partsproduct_image' => 'image|file|max:2048',
            'partsproduct_status' => 'nullable|string',
            'partsproduct_assetID' => 'nullable|string',
            'partsproduct_newassetID' => 'nullable|string',
            'partsproduct_desc' => 'nullable|string',
            'partsproduct_partnumber' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'partsproduct_transfer' => 'nullable|string',
            'partsproduct_reser' => 'nullable|string',
            'partsproduct_origin' => 'nullable|string',
            'partsproduct_sdvin' => 'nullable|string',
            'partsproduct_sdvout' => 'nullable|string',
            'partsproduct_station' => 'nullable|string',
            'partsproduct_requestor' => 'nullable|string',
            'partsproduct_project' => 'nullable|string',
            'partsproduct_datein' => 'nullable|date',
            'partsproduct_dateout' => 'nullable|date',
            'partsproduct_dateoffshore' => 'nullable|date',
            'partsproduct_tfoffshore' => 'nullable|string',
            'partsproduct_curloc' => 'nullable|string',
            'partsproduct_targetpdn' => 'nullable|string',
            'partsproduct_stockin' => 'nullable|integer',
            'partsproduct_stockout' => 'nullable|integer',
            'partsproduct_docin' => 'mimes:doc,pdf|max:2048',
            'partsproduct_docout' => 'mimes:doc,pdf|max:2048',
            'partsproduct_stockqty' => 'nullable|integer',
            'partsproduct_uom' => 'nullable|string',
            'partsproduct_csrelease' => 'nullable|string',
            'partsproduct_csnumber' => 'nullable|string',
            'partsproduct_cenumber' => 'nullable|string',
            'partsproduct_ronumber' => 'nullable|string',
            'partsproduct_startdate' => 'nullable|date',
            'partsproduct_enddate' => 'nullable|date',
            'partsproduct_price' => 'nullable|string',
            'partsproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        // Save partsproduct code value
        $validatedData['partsproduct_code'] = $partsproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('partsproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['partsproduct_image'] = $fileName;
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('partsproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['partsproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('partsproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['partsproduct_docout'] = $fileName;
        }


        Partsproduct::create($validatedData);

        return Redirect::route('partsproducts.index')->with('success', 'Spare Parts has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partsproduct $partsproduct)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $code = $partsproduct->partsproduct_code ?? '';

        if (!empty($code)) {
            $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        } else {
            $barcode = ''; // Set an empty barcode if $code is empty or null
        }

        return view('partsproducts.show', [
            'partsproduct' => $partsproduct,
            'barcode' => $barcode,
        ]);
    }

    public function generatePdf($id)
        {
            $product = Partsproduct::find($id);

            $pdfOptions = new Options();
            $pdfOptions->set('isHtml5ParserEnabled', true);
            $pdfOptions->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($pdfOptions);
            $html = view('dashboard.body.main')->render(); // Render the entire content
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $dompdf->stream('partsproduct_show.pdf');
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partsproduct $partsproduct)
    {
        return view('partsproducts.edit', [
            'partsproduct' => $partsproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partsproduct $partsproduct)
    {
        $rules = [
            'partsproduct_image' => 'image|file|max:2048',
            'partsproduct_status' => 'nullable|string',
            'partsproduct_assetID' => 'nullable|string',
            'partsproduct_newassetID' => 'nullable|string',
            'partsproduct_desc' => 'nullable|string',
            'partsproduct_partnumber' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'partsproduct_transfer' => 'nullable|string',
            'partsproduct_reser' => 'nullable|string',
            'partsproduct_origin' => 'nullable|string',
            'partsproduct_sdvin' => 'nullable|string',
            'partsproduct_sdvout' => 'nullable|string',
            'partsproduct_station' => 'nullable|string',
            'partsproduct_requestor' => 'nullable|string',
            'partsproduct_project' => 'nullable|string',
            'partsproduct_datein' => 'nullable|date',
            'partsproduct_dateout' => 'nullable|date',
            'partsproduct_dateoffshore' => 'nullable|date',
            'partsproduct_tfoffshore' => 'nullable|string',
            'partsproduct_curloc' => 'nullable|string',
            'partsproduct_targetpdn' => 'nullable|string',
            'partsproduct_stockin' => 'nullable|integer',
            'partsproduct_stockout' => 'nullable|integer',
            'partsproduct_docin' => 'mimes:doc,pdf|max:2048',
            'partsproduct_docout' => 'mimes:doc,pdf|max:2048',
            'partsproduct_stockqty' => 'nullable|integer',
            'partsproduct_uom' => 'nullable|string',
            'partsproduct_csrelease' => 'nullable|string',
            'partsproduct_csnumber' => 'nullable|string',
            'partsproduct_cenumber' => 'nullable|string',
            'partsproduct_ronumber' => 'nullable|string',
            'partsproduct_startdate' => 'nullable|date',
            'partsproduct_enddate' => 'nullable|date',
            'partsproduct_price' => 'nullable|string',
            'partsproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('partsproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($partsproduct->partsproduct_image){
                $result = str_replace('storage/', '', $partsproduct->partsproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['partsproduct_image'] = $fileName;

        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('partsproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($partsproduct->partsproduct_docin){
                $result = str_replace('storage/', '', $partsproduct->partsproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['partsproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('partsproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($partsproduct->partsproduct_docout){
                $result = str_replace('storage/', '', $partsproduct->partsproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['partsproduct_docout'] = $fileName;
        }

        Partsproduct::where('id', $partsproduct->id)->update($validatedData);

        return Redirect::route('partsproducts.index')->with('success', 'Spare Parts has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partsproduct $partsproduct)
    {
        /**
         * Delete photo if exists.
         */
        if($partsproduct->partsproduct_image){
            $result = str_replace('storage/', '', $partsproduct->partsproduct_image);
                Storage::delete('public/' . $result);
        }

        /**
         * Delete docin if exists.
         */
        if($partsproduct->partsproduct_docin){
            $result = str_replace('storage/', '', $partsproduct->partsproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($partsproduct->partsproduct_docout){
            $result = str_replace('storage/', '', $partsproduct->partsproduct_docout);
                Storage::delete('public/' . $result);
        }


        Partsproduct::destroy($partsproduct->id);

        return Redirect::route('partsproducts.index')->with('success', 'Spare Parts has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('partsproducts.import');
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
                    'partsproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'partsproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'partsproduct_desc' => $sheet->getCell( 'C' . $row )->getValue(),
                    'partsproduct_partnumber' => $sheet->getCell( 'D' . $row )->getValue(),
                    'partsproduct_transfer' => $sheet->getCell( 'E' . $row )->getValue(),
                    'partsproduct_reser' => $sheet->getCell( 'F' . $row )->getValue(),
                    'partsproduct_origin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'partsproduct_sdvin' => $sheet->getCell( 'H' . $row )->getValue(),
                    'partsproduct_sdvout' => $sheet->getCell( 'I' . $row )->getValue(),
                    'partsproduct_station' => $sheet->getCell( 'J' . $row )->getValue(),
                    'partsproduct_requestor' => $sheet->getCell( 'K' . $row )->getValue(),
                    'partsproduct_project' => $sheet->getCell( 'L' . $row )->getValue(),
                    'partsproduct_datein' => $sheet->getCell( 'M' . $row )->getValue(),
                    'partsproduct_dateout' => $sheet->getCell( 'N' . $row )->getValue(),
                    'partsproduct_dateoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'partsproduct_tfoffshore' => $sheet->getCell( 'P' . $row )->getValue(),
                    'partsproduct_curloc' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'partsproduct_targetpdn' =>$sheet->getCell( 'R' . $row )->getValue(),
                    'partsproduct_stockin' => $sheet->getCell( 'S' . $row )->getValue(),
                    'partsproduct_stockout' => $sheet->getCell( 'T' . $row )->getValue(),
                    'partsproduct_docin' => $sheet->getCell( 'U' . $row )->getValue(),
                    'partsproduct_docout' => $sheet->getCell( 'V' . $row )->getValue(),
                    'partsproduct_stockqty' => $sheet->getCell( 'W' . $row )->getValue(),
                    'partsproduct_uom' => $sheet->getCell( 'X' . $row )->getValue(),
                    'partsproduct_csrelease' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'partsproduct_csnumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'partsproduct_cenumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'partsproduct_ronumber' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'partsproduct_startdate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'partsproduct_enddate' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'partsproduct_price' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'partsproduct_remark' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'partsproduct_image' =>$sheet->getCell( 'AG' . $row )->getValue(),
                    'partsproduct_code' =>$sheet->getCell( 'AH' . $row )->getValue(),
                    'partsproduct_status' =>$sheet->getCell( 'AI' . $row )->getValue(),
                ];
                $startcount++;
            }

            Partsproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('partsproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('partsproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $partsproducts = Partsproduct::all()->sortBy('partsproduct_type');

        $partsproduct_array [] = array(
            'Old ID',
            'New ID',
            'Description',
            'Part Number',
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

        foreach($partsproducts as $partsproduct)
        {
            $partsproduct_array[] = array(
                'Old ID' => $partsproduct->partsproduct_assetID,
                'New ID' => $partsproduct->partsproduct_newassetID,
                'Description' => $partsproduct->partsproduct_desc,
                'Part Number' => $partsproduct->partsproduct_partnumber,
                // 'Serial Number' => $partsproduct->partsproduct_serial,
                'Material Transfer' => $partsproduct->partsproduct_transfer,
                'Reservation Number' => $partsproduct->partsproduct_reser,
                'Ex Station' =>  $partsproduct->partsproduct_origin,
                'SDV In' => $partsproduct->partsproduct_sdvin,
                'SDV Out' => $partsproduct->partsproduct_sdvout,
                'Station' => $partsproduct->partsproduct_station,
                'Requestor' => $partsproduct->partsproduct_requestor,
                'Project' =>  $partsproduct->partsproduct_project,
                'Date In' => $partsproduct->partsproduct_datein,
                'Date Out' => $partsproduct->partsproduct_dateout,
                'Date to offshore' =>  $partsproduct->partsproduct_dateoffshore,
                'Material transfer to offshore' => $partsproduct->partsproduct_tfoffshore,
                'Current Location' => $partsproduct->partsproduct_curloc,
                'Target PDN' => $partsproduct->partsproduct_targetpdn,
                'Stock In' => $partsproduct->partsproduct_stockin,
                'Dok Stok In' => $partsproduct->partsproduct_docin,
                'Stok Out' =>  $partsproduct->partsproduct_stockout,
                'Dok Stok Out' => $partsproduct->partsproduct_docout,
                'Stock Quality' => $partsproduct->partsproduct_stockqty,
                'UOM' => $partsproduct->partsproduct_uom,
                'CS Release' => $partsproduct->partsproduct_csrelease,
                'CS Number' => $partsproduct->partsproduct_csnumber,
                'CE Number' => $partsproduct->partsproduct_cenumber,
                'RO Number' => $partsproduct->partsproduct_ronumber,
                'Start Date' => $partsproduct->partsproduct_startdate,
                'End Date' => $partsproduct->partsproduct_enddate,
                'Price Repair' => $partsproduct->partsproduct_price,
                'REMARK' => $partsproduct->partsproduct_remark,
                'Product Image' => $partsproduct->partsproduct_image,
                'Product Code' => $partsproduct->partsproduct_code,
                'Status' => $partsproduct->partsproduct_status,

            );
        }

        $this->exportExcel($partsproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($partsproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($partsproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="partsproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}

