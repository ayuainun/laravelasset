<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Bulkproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BulkproductController extends Controller
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

        $bulkproducts = Bulkproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('bulkproducts.index', [
            'bulkproducts' => $bulkproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bulkproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bulkproduct_code = IdGenerator::generate([
            'table' => 'bulkproducts',
            'field' => 'bulkproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'bulkproduct_image' => 'image|file|max:2048',
            'bulkproduct_assetID' => 'nullable|string',
            'bulkproduct_newassetID' => 'nullable|string',
            'bulkproduct_bulktype' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'bulkproduct_transfer' => 'nullable|string',
            'bulkproduct_reser' => 'nullable|string',
            'bulkproduct_origin' => 'nullable|string',
            'bulkproduct_sdvin' => 'nullable|string',
            'bulkproduct_sdvout' => 'nullable|string',
            'bulkproduct_station' => 'nullable|string',
            'bulkproduct_requestor' => 'nullable|string',
            'bulkproduct_project' => 'nullable|string',
            'bulkproduct_datein' => 'nullable|date',
            'bulkproduct_dateout' => 'nullable|date',
            'bulkproduct_dateoffshore' => 'nullable|date',
            'bulkproduct_tfoffshore' => 'nullable|string',
            'bulkproduct_curloc' => 'nullable|string',
            'bulkproduct_targetpdn' => 'nullable|string',
            'bulkproduct_stockin' => 'nullable|integer',
            'bulkproduct_stockout' => 'nullable|integer',
            'bulkproduct_docin' => 'mimes:doc,pdf|max:2048',
            'bulkproduct_docout' => 'mimes:doc,pdf|max:2048',
            'bulkproduct_stockqty' => 'nullable|integer',
            'bulkproduct_uom' => 'nullable|string',
            'bulkproduct_csrelease' => 'nullable|string',
            'bulkproduct_csnumber' => 'nullable|string',
            'bulkproduct_cenumber' => 'nullable|string',
            'bulkproduct_ronumber' => 'nullable|string',
            'bulkproduct_startdate' => 'nullable|date',
            'bulkproduct_enddate' => 'nullable|date',
            'bulkproduct_price' => 'nullable|string',
            'bulkproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        // Save bulkproduct code value
        $validatedData['bulkproduct_code'] = $bulkproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('bulkproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['bulkproduct_image'] = $fileName;
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('bulkproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['bulkproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('bulkproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['bulkproduct_docout'] = $fileName;
        }


        Bulkproduct::create($validatedData);

        return Redirect::route('bulkproducts.index')->with('success', 'Bulk Material has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bulkproduct $bulkproduct)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $code = $bulkproduct->bulkproduct_code ?? '';

        if (!empty($code)) {
            $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        } else {
            $barcode = ''; // Set an empty barcode if $code is empty or null
        }

        return view('bulkproducts.show', [
            'bulkproduct' => $bulkproduct,
            'barcode' => $barcode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bulkproduct $bulkproduct)
    {
        return view('bulkproducts.edit', [
            'bulkproduct' => $bulkproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bulkproduct $bulkproduct)
    {
        $rules = [
            'bulkproduct_image' => 'image|file|max:2048',
            'bulkproduct_assetID' => 'nullable|string',
            'bulkproduct_newassetID' => 'nullable|string',
            'bulkproduct_bulktype' => 'nullable|string',
            // 'product_serial' => 'nullable|string',
            'bulkproduct_transfer' => 'nullable|string',
            'bulkproduct_reser' => 'nullable|string',
            'bulkproduct_origin' => 'nullable|string',
            'bulkproduct_sdvin' => 'nullable|string',
            'bulkproduct_sdvout' => 'nullable|string',
            'bulkproduct_station' => 'nullable|string',
            'bulkproduct_requestor' => 'nullable|string',
            'bulkproduct_project' => 'nullable|string',
            'bulkproduct_datein' => 'nullable|date',
            'bulkproduct_dateout' => 'nullable|date',
            'bulkproduct_dateoffshore' => 'nullable|date',
            'bulkproduct_tfoffshore' => 'nullable|string',
            'bulkproduct_curloc' => 'nullable|string',
            'bulkproduct_targetpdn' => 'nullable|string',
            'bulkproduct_stockin' => 'nullable|integer',
            'bulkproduct_stockout' => 'nullable|integer',
            'bulkproduct_docin' => 'mimes:doc,pdf|max:2048',
            'bulkproduct_docout' => 'mimes:doc,pdf|max:2048',
            'bulkproduct_stockqty' => 'nullable|integer',
            'bulkproduct_uom' => 'nullable|string',
            'bulkproduct_csrelease' => 'nullable|string',
            'bulkproduct_csnumber' => 'nullable|string',
            'bulkproduct_cenumber' => 'nullable|string',
            'bulkproduct_ronumber' => 'nullable|string',
            'bulkproduct_startdate' => 'nullable|date',
            'bulkproduct_enddate' => 'nullable|date',
            'bulkproduct_price' => 'nullable|string',
            'bulkproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('bulkproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($bulkproduct->bulkproduct_image){
                $result = str_replace('storage/', '', $bulkproduct->bulkproduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['bulkproduct_image'] = $fileName;
        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('bulkproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($bulkproduct->bulkproduct_docin){
                $result = str_replace('storage/', '', $bulkproduct->bulkproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['bulkproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('bulkproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($bulkproduct->bulkproduct_docout){
                $result = str_replace('storage/', '', $bulkproduct->bulkproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['bulkproduct_docout'] = $fileName;
        }


        Bulkproduct::where('id', $bulkproduct->id)->update($validatedData);

        return Redirect::route('bulkproducts.index')->with('success', 'Bulk Material has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulkproduct $bulkproduct)
    {
        /**
         * Delete photo if exists.
         */
        if($bulkproduct->bulkproduct_image){
            $result = str_replace('storage/', '', $bulkproduct->bulkproduct_image);
                Storage::delete('public/' . $result);
        }

        /**
         * Delete docin if exists.
         */
        if($bulkproduct->bulkproduct_docin){
            $result = str_replace('storage/', '', $bulkproduct->bulkproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($bulkproduct->bulkproduct_docout){
            $result = str_replace('storage/', '', $bulkproduct->bulkproduct_docout);
                Storage::delete('public/' . $result);
        }


        Bulkproduct::destroy($bulkproduct->id);

        return Redirect::route('bulkproducts.index')->with('success', 'Bulk Material has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('bulkproducts.import');
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
            $column_range = range( 'AI', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'bulkproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'bulkproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'bulkproduct_bulktype' => $sheet->getCell( 'C' . $row )->getValue(),
                    'bulkproduct_transfer' => $sheet->getCell( 'D' . $row )->getValue(),
                    'bulkproduct_reser' => $sheet->getCell( 'E' . $row )->getValue(),
                    'bulkproduct_origin' => $sheet->getCell( 'F' . $row )->getValue(),
                    'bulkproduct_sdvin' => $sheet->getCell( 'G' . $row )->getValue(),
                    'bulkproduct_sdvout' => $sheet->getCell( 'H' . $row )->getValue(),
                    'bulkproduct_station' => $sheet->getCell( 'I' . $row )->getValue(),
                    'bulkproduct_requestor' => $sheet->getCell( 'J' . $row )->getValue(),
                    'bulkproduct_project' => $sheet->getCell( 'K' . $row )->getValue(),
                    'bulkproduct_datein' => $sheet->getCell( 'L' . $row )->getValue(),
                    'bulkproduct_dateout' => $sheet->getCell( 'M' . $row )->getValue(),
                    'bulkproduct_dateoffshore' => $sheet->getCell( 'N' . $row )->getValue(),
                    'bulkproduct_tfoffshore' => $sheet->getCell( 'O' . $row )->getValue(),
                    'bulkproduct_curloc' => $sheet->getCell( 'P' . $row )->getValue(),
                    'bulkproduct_targetpdn' =>$sheet->getCell( 'Q' . $row )->getValue(),
                    'bulkproduct_stockin' => $sheet->getCell( 'R' . $row )->getValue(),
                    'bulkproduct_stockout' => $sheet->getCell( 'S' . $row )->getValue(),
                    'bulkproduct_docin' => $sheet->getCell( 'T' . $row )->getValue(),
                    'bulkproduct_docout' => $sheet->getCell( 'U' . $row )->getValue(),
                    'bulkproduct_stockqty' => $sheet->getCell( 'V' . $row )->getValue(),
                    'bulkproduct_uom' => $sheet->getCell( 'W' . $row )->getValue(),
                    'bulkproduct_csrelease' =>$sheet->getCell( 'X' . $row )->getValue(),
                    'bulkproduct_csnumber' =>$sheet->getCell( 'Y' . $row )->getValue(),
                    'bulkproduct_cenumber' =>$sheet->getCell( 'Z' . $row )->getValue(),
                    'bulkproduct_ronumber' =>$sheet->getCell( 'AA' . $row )->getValue(),
                    'bulkproduct_startdate' =>$sheet->getCell( 'AB' . $row )->getValue(),
                    'bulkproduct_enddate' =>$sheet->getCell( 'AC' . $row )->getValue(),
                    'bulkproduct_price' =>$sheet->getCell( 'AD' . $row )->getValue(),
                    'bulkproduct_remark' =>$sheet->getCell( 'AE' . $row )->getValue(),
                    'bulkproduct_image' =>$sheet->getCell( 'AF' . $row )->getValue(),
                    'bulkproduct_code' =>$sheet->getCell( 'AG' . $row )->getValue(),
                ];
                $startcount++;
            }

            Bulkproduct::bulkert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('bulkproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('bulkproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $bulkproducts = Bulkproduct::all()->sortBy('bulkproduct_type');

        $bulkproduct_array [] = array(
            'Old ID',
            'Asset ID',
            'Bulk Material Type',
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

        foreach($bulkproducts as $bulkproduct)
        {
            $bulkproduct_array[] = array(
                'Old ID' => $bulkproduct->bulkproduct_assetID,
                'Asset ID' => $bulkproduct->bulkproduct_newassetID,
                'Bulk Material Type' => $bulkproduct->bulkproduct_bulktype,
                // 'Serial Number' => $bulkproduct->bulkproduct_serial,
                'Material Transfer' => $bulkproduct->bulkproduct_transfer,
                'Reservation Number' => $bulkproduct->bulkproduct_reser,
                'Ex Station' =>  $bulkproduct->bulkproduct_origin,
                'SDV In' => $bulkproduct->bulkproduct_sdvin,
                'SDV Out' => $bulkproduct->bulkproduct_sdvout,
                'Station' => $bulkproduct->bulkproduct_station,
                'Requestor' => $bulkproduct->bulkproduct_requestor,
                'Project' =>  $bulkproduct->bulkproduct_project,
                'Date In' => $bulkproduct->bulkproduct_datein,
                'Date Out' => $bulkproduct->bulkproduct_dateout,
                'Date to offshore' =>  $bulkproduct->bulkproduct_dateoffshore,
                'Material transfer to offshore' => $bulkproduct->bulkproduct_tfoffshore,
                'Current Location' => $bulkproduct->bulkproduct_curloc,
                'Target PDN' => $bulkproduct->bulkproduct_targetpdn,
                'Stock In' => $bulkproduct->bulkproduct_stockin,
                'Dok Stok In' => $bulkproduct->bulkproduct_docin,
                'Stok Out' =>  $bulkproduct->bulkproduct_stockout,
                'Dok Stok Out' => $bulkproduct->bulkproduct_docout,
                'Stock Quality' => $bulkproduct->bulkproduct_stockqty,
                'UOM' => $bulkproduct->bulkproduct_uom,
                'CS Release' => $bulkproduct->bulkproduct_csrelease,
                'CS Number' => $bulkproduct->bulkproduct_csnumber,
                'CE Number' => $bulkproduct->bulkproduct_cenumber,
                'RO Number' => $bulkproduct->bulkproduct_ronumber,
                'Start Date' => $bulkproduct->bulkproduct_startdate,
                'End Date' => $bulkproduct->bulkproduct_enddate,
                'Price Repair' => $bulkproduct->bulkproduct_price,
                'REMARK' => $bulkproduct->bulkproduct_remark,
                'Product Image' => $bulkproduct->bulkproduct_image,
                'Product Code' => $bulkproduct->bulkproduct_code,
            );
        }

        $this->exportExcel($bulkproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($bulkproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($bulkproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="bulkproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}

