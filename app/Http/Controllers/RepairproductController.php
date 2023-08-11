<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Repairproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RepairproductController extends Controller
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

        $repairproducts = Repairproduct::with([])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('repairproducts.index', [
            'repairproducts' => $repairproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('repairproducts.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $repairproduct_code = IdGenerator::generate([
            'table' => 'repairproducts',
            'field' => 'repairproduct_code',
            'length' => 4,
            'prefix' => 'Vlv'
        ]);

        $rules = [
            'repairproduct_image' => 'image|file|max:2048',
            'repairproduct_assetID' => 'nullable|string',
            'repairproduct_newassetID' => 'nullable|string',
            'repairproduct_equip' =>'nullable|string',
            'repairproduct_unit' => 'nullable|string',
            'repairproduct_end' => 'nullable|string',
            'repairproduct_size' => 'nullable|string',
            'repairproduct_rating' => 'nullable|string',
            'repairproduct_brand' => 'nullable|string',
            'repairproduct_valvemodel' => 'nullable|string',
            'repairproduct_serial' => 'nullable|string',
            'repairproduct_condi' => 'nullable|string',
            'repairproduct_actbrand' => 'nullable|string',
            'repairproduct_acttype' => 'nullable|string',
            'repairproduct_actsize' => 'nullable|string',
            'repairproduct_fail' => 'nullable|string',
            'repairproduct_actcond' => 'nullable|string',
            'repairproduct_posbrand' => 'nullable|string',
            'repairproduct_posmodel' => 'nullable|string',
            'repairproduct_inputsignal' => 'nullable|string',
            'repairproduct_poscond' => 'nullable|string',
            'repairproduct_other' => 'nullable|string',
            'repairproduct_datein' => 'nullable|date',
            'repairproduct_transfer' => 'nullable|string',
            'repairproduct_reser' => 'nullable|string',
            'repairproduct_origin' => 'nullable|string',
            'repairproduct_sdvin' => 'nullable|string',
            'repairproduct_sdvout' => 'nullable|string',
            'repairproduct_station' => 'nullable|string',
            'repairproduct_requestor' => 'nullable|string',
            'repairproduct_project' => 'nullable|string',
            'repairproduct_dateout' => 'nullable|date',
            'repairproduct_dateoffshore' => 'nullable|date',
            'repairproduct_tfoffshore' => 'nullable|string',
            'repairproduct_curloc' => 'nullable|string',
            'repairproduct_stockin' => 'nullable|integer',
            'repairproduct_stockout' => 'nullable|integer',
            'repairproduct_docin' => 'mimes:doc,pdf|max:2048',
            'repairproduct_docout' => 'mimes:doc,pdf|max:2048',
            'repairproduct_dateout' => 'nullable|date',
            'repairproduct_stockqty' => 'nullable|integer',
            'repairproduct_uom' => 'nullable|string',
            'repairproduct_targetpdn' => 'nullable|string',
            'repairproduct_csrelease' => 'nullable|string',
            'repairproduct_csnumber' => 'nullable|string',
            'repairproduct_cenumber' => 'nullable|string',
            'repairproduct_ronumber' => 'nullable|string',
            'repairproduct_startdate' => 'nullable|date',
            'repairproduct_enddate' => 'nullable|date',
            'repairproduct_price' => 'nullable|string',
            'repairproduct_remark' => 'nullable|string',


        ];

        $validatedData = $request->validate($rules);

        // Save repairproduct code value
        $validatedData['repairproduct_code'] = $repairproduct_code;

        /**
         * Handle upload image
         */
        if ($file = $request->file('repairproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/'; 

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['repairproduct_image'] = $fileName;
        }

        /**
         * Handle upload pdf docin
         */
        if ($file = $request->file('repairproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['repairproduct_docin'] = $fileName;
        }

        /**
         * Handle upload pdf docout
         */
        if ($file = $request->file('repairproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/'; 

            /**
             * Upload an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['repairproduct_docout'] = $fileName;
        }

        Repairproduct::create($validatedData);

        return Redirect::route('repairproducts.index')->with('success', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Repairproduct $repairproduct)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();
        $code = $repairproduct->repairproduct_code ?? '';

        if (!empty($code)) {
            $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        } else {
            $barcode = ''; // Set an empty barcode if $code is empty or null
        }

        return view('repairproducts.show', [
            'repairproduct' => $repairproduct,
            'barcode' => $barcode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repairproduct $repairproduct)
    {
        return view('repairproducts.edit', [
            'repairproduct' => $repairproduct
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repairproduct $repairproduct)
    {
        $rules = [
            'repairproduct_image' => 'image|file|max:2048',
            'repairproduct_assetID' => 'nullable|string',
            'repairproduct_newassetID' => 'nullable|string',
            'repairproduct_equip' =>'nullable|string',
            'repairproduct_unit' => 'nullable|string',
            'repairproduct_end' => 'nullable|string',
            'repairproduct_size' => 'nullable|string',
            'repairproduct_rating' => 'nullable|string',
            'repairproduct_brand' => 'nullable|string',
            'repairproduct_valvemodel' => 'nullable|string',
            'repairproduct_serial' => 'nullable|string',
            'repairproduct_condi' => 'nullable|string',
            'repairproduct_actbrand' => 'nullable|string',
            'repairproduct_acttype' => 'nullable|string',
            'repairproduct_actsize' => 'nullable|string',
            'repairproduct_fail' => 'nullable|string',
            'repairproduct_actcond' => 'nullable|string',
            'repairproduct_posbrand' => 'nullable|string',
            'repairproduct_posmodel' => 'nullable|string',
            'repairproduct_inputsignal' => 'nullable|string',
            'repairproduct_poscond' => 'nullable|string',
            'repairproduct_other' => 'nullable|string',
            'repairproduct_datein' => 'nullable|date',
            'repairproduct_transfer' => 'nullable|string',
            'repairproduct_reser' => 'nullable|string',
            'repairproduct_origin' => 'nullable|string',
            'repairproduct_sdvin' => 'nullable|string',
            'repairproduct_sdvout' => 'nullable|string',
            'repairproduct_station' => 'nullable|string',
            'repairproduct_requestor' => 'nullable|string',
            'repairproduct_project' => 'nullable|string',
            'repairproduct_dateout' => 'nullable|date',
            'repairproduct_dateoffshore' => 'nullable|date',
            'repairproduct_tfoffshore' => 'nullable|string',
            'repairproduct_curloc' => 'nullable|string',
            'repairproduct_stockin' => 'nullable|integer',
            'repairproduct_stockout' => 'nullable|integer',
            'repairproduct_docin' => 'mimes:doc,pdf|max:2048',
            'repairproduct_docout' => 'mimes:doc,pdf|max:2048',
            'repairproduct_dateout' => 'nullable|date',
            'repairproduct_stockqty' => 'nullable|integer',
            'repairproduct_uom' => 'nullable|string',
            'repairproduct_targetpdn' => 'nullable|string',
            'repairproduct_csrelease' => 'nullable|string',
            'repairproduct_csnumber' => 'nullable|string',
            'repairproduct_cenumber' => 'nullable|string',
            'repairproduct_ronumber' => 'nullable|string',
            'repairproduct_startdate' => 'nullable|date',
            'repairproduct_enddate' => 'nullable|date',
            'repairproduct_price' => 'nullable|string',
            'repairproduct_remark' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('repairproduct_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/img/products/';

            /**
             * Delete photo if exists.
             */
            if($repairproduct->repairproduct_image){
                $result = str_replace('storage/', '', $repairproduct->repairroduct_image);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/img/products/'.$fileName;
            $validatedData['repairproduct_image'] = $fileName;
        }

        /**
         * Handle upload an docin
         */
        if ($file = $request->file('repairproduct_docin')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docin if exists.
             */
            if($repairproduct->repairproduct_docin){
                $result = str_replace('storage/', '', $repairproduct->repairproduct_docin);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docin to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['repairproduct_docin'] = $fileName;
        }

        /**
         * Handle upload an docout
         */
        if ($file = $request->file('repairproduct_docout')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/assets/documents/products/';

            /**
             * Delete docout if exists.
             */
            if($repairproduct->repairproduct_docout){
                $result = str_replace('storage/', '', $repairproduct->repairproduct_docout);
                Storage::delete('public/' . $result);
            }

            /**
             * Store an docout to Storage
             */
            $file->storeAs($path, $fileName);
            $fileName = 'storage/assets/documents/products/'.$fileName;
            $validatedData['repairproduct_docout'] = $fileName;
        }


        Repairproduct::where('id', $repairproduct->id)->update($validatedData);

        return Redirect::route('repairproducts.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repairproduct $repairproduct)
    {
        /**
         * Delete photo if exists.
         */
        if($repairproduct->repairproduct_image){
            $result = str_replace('storage/', '', $repairproduct->repairproduct_image);
                Storage::delete('public/' . $result);
        }

        /**
         * Delete docin if exists.
         */
        if($repairproduct->repairproduct_docin){
            $result = str_replace('storage/', '', $repairproduct->repairproduct_docin);
                Storage::delete('public/' . $result);
        }

         /**
         * Delete docout if exists.
         */
        if($repairproduct->repairproduct_docout){
            $result = str_replace('storage/', '', $repairproduct->repairproduct_docout);
                Storage::delete('public/' . $result);
        }

        Repairproduct::destroy($repairproduct->id);

        return Redirect::route('repairproducts.index')->with('success', 'Product has been deleted!');
    }

    /**
     * Handle export data products.
     */
    public function import()
    {
        return view('repairproducts.import');
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
            $column_range = range( 'BA', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'repairproduct_assetID' => $sheet->getCell( 'A' . $row )->getValue(),
                    'repairproduct_newassetID' => $sheet->getCell( 'B' . $row )->getValue(),
                    'repairproduct_equip' => $sheet->getCell( 'C' . $row )->getValue(),
                    'repairproduct_unit' => $sheet->getCell( 'D' . $row )->getValue(),
                    'repairproduct_end' => $sheet->getCell( 'E' . $row )->getValue(),
                    'repairproduct_size' => $sheet->getCell( 'F' . $row )->getValue(),
                    'repairproduct_rating' => $sheet->getCell( 'G' . $row )->getValue(),
                    'repairproduct_brand' => $sheet->getCell( 'H' . $row )->getValue(),
                    'repairproduct_valvemodel' => $sheet->getCell( 'I' . $row )->getValue(),
                    'repairproduct_serial' => $sheet->getCell( 'J' . $row )->getValue(),
                    'repairproduct_condi' => $sheet->getCell( 'K' . $row )->getValue(),
                    'repairproduct_actbrand' => $sheet->getCell( 'L' . $row )->getValue(),
                    'repairproduct_acttype' => $sheet->getCell( 'M' . $row )->getValue(),
                    'repairproduct_actsize' => $sheet->getCell( 'N' . $row )->getValue(),
                    'repairproduct_fail' => $sheet->getCell( 'O' . $row )->getValue(),
                    'repairproduct_actcond' => $sheet->getCell( 'P' . $row )->getValue(),
                    'repairproduct_posbrand' => $sheet->getCell( 'Q' . $row )->getValue(),
                    'repairproduct_posmodel' => $sheet->getCell( 'R' . $row )->getValue(),
                    'repairproduct_inputsignal' => $sheet->getCell( 'S' . $row )->getValue(),
                    'repairproduct_poscond' => $sheet->getCell( 'T' . $row )->getValue(),
                    'repairproduct_other' => $sheet->getCell( 'U' . $row )->getValue(),
                    'repairproduct_datein' => $sheet->getCell( 'V' . $row )->getValue(),
                    'repairproduct_transfer' => $sheet->getCell( 'W' . $row )->getValue(),
                    'repairproduct_reser' => $sheet->getCell( 'X' . $row )->getValue(),
                    'repairproduct_origin' => $sheet->getCell( 'Y' . $row )->getValue(),
                    'repairproduct_sdvin' => $sheet->getCell( 'Z' . $row )->getValue(),
                    'repairproduct_sdvout' => $sheet->getCell( 'AA' . $row )->getValue(),
                    'repairproduct_station' => $sheet->getCell( 'AB' . $row )->getValue(),
                    'repairproduct_requestor' => $sheet->getCell( 'AC' . $row )->getValue(),
                    'repairproduct_project' => $sheet->getCell( 'AD' . $row )->getValue(),
                    'repairproduct_dateout' => $sheet->getCell( 'AE' . $row )->getValue(),
                    'repairproduct_dateoffshore' => $sheet->getCell( 'AF' . $row )->getValue(),
                    'repairproduct_tfoffshore' => $sheet->getCell( 'AG' . $row )->getValue(),
                    'repairproduct_curloc' => $sheet->getCell( 'AH' . $row )->getValue(),
                    'repairproduct_stockin' => $sheet->getCell( 'AI' . $row )->getValue(),
                    'repairproduct_stockout' => $sheet->getCell( 'AJ' . $row )->getValue(),
                    'repairproduct_docin' => $sheet->getCell( 'AK' . $row )->getValue(),
                    'repairproduct_docout' => $sheet->getCell( 'AL' . $row )->getValue(),
                    'repairproduct_stockqty' => $sheet->getCell( 'AM' . $row )->getValue(),
                    'repairproduct_uom' => $sheet->getCell( 'AN' . $row )->getValue(),
                    'repairproduct_targetpdn' =>$sheet->getCell( 'AO' . $row )->getValue(),
                    'repairproduct_csrelease' =>$sheet->getCell( 'AP' . $row )->getValue(),
                    'repairproduct_csnumber' =>$sheet->getCell( 'AQ' . $row )->getValue(),
                    'repairproduct_cenumber' =>$sheet->getCell( 'AR' . $row )->getValue(),
                    'repairproduct_ronumber' =>$sheet->getCell( 'AS' . $row )->getValue(),
                    'repairproduct_startdate' =>$sheet->getCell( 'AT' . $row )->getValue(),
                    'repairproduct_enddate' =>$sheet->getCell( 'AU' . $row )->getValue(),
                    'repairproduct_price' =>$sheet->getCell( 'AV' . $row )->getValue(),
                    'repairproduct_remark' =>$sheet->getCell( 'AW' . $row )->getValue(),
                    'repairproduct_image' =>$sheet->getCell( 'AX' . $row )->getValue(),
                    'repairproduct_code' =>$sheet->getCell( 'AY' . $row )->getValue(),
                ];
                $startcount++;
            }

            Repairproduct::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('repairproducts.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('repairproducts.index')->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $repairproducts = Repairproduct::all()->sortBy('repairproduct_name');

        $repairproduct_array [] = array(
            'Old ID',
            'Asset ID',
            'Equipment',
            'Valve Type',
            'End Connection',
            'Valve Size (Inch)',
            'Valve Rating',
            'Valve Brand',
            'Valve Model',
            'Serial Number',
            'Valve Condition',
            'Actuator Brand',
            'Actuator Type',
            'Actuator Size',
            'Fail Position',
            'Actuator Condition',
            'Positioner Brand',
            'Positioner Model',
            'Input Signal',
            'Positioner Condition',
            'Other Accessories',
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
            'TARGET PDN',
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

        foreach($repairproducts as $repairproduct)
        {
            $repairproduct_array[] = array(
                'Old ID' => $repairproduct->repairproduct_assetID,
                'Asset ID' => $repairproduct->repairproduct_newassetID,
                'Equipment' => $repairproduct->repairproduct_equip,
                'Valve Type' => $repairproduct->repairproduct_unit,
                'End Connection' => $repairproduct->repairproduct_end,
                'Valve Size (Inch)' =>  $repairproduct->repairproduct_size,
                'Valve Rating' => $repairproduct->repairproduct_rating,
                'Valve Brand' => $repairproduct->repairproduct_brand,
                'Valve Model' => $repairproduct->repairproduct_valvemodel,
                'Serial Number' => $repairproduct->repairproduct_serial,
                'Valve Condition' => $repairproduct->repairproduct_condi,
                'Actuator Brand' => $repairproduct->repairproduct_actbrand,
                'Actuator Type' => $repairproduct->repairproduct_acttype,
                'Actuator Size' => $repairproduct->repairproduct_actsize,
                'Fail Position' =>  $repairproduct->repairproduct_fail,
                'Actuator Condition' => $repairproduct->repairproduct_actcond,
                'Positioner Brand' => $repairproduct->repairproduct_posbrand,
                'Positioner Model' => $repairproduct->repairproduct_posmodel,
                'Input Signal' => $repairproduct->repairproduct_inputsignal,
                'Positioner Condition' => $repairproduct->repairproduct_poscond,
                'Other Accessories' => $repairproduct->repairproduct_other,
                'Date In' => $repairproduct->repairproduct_datein,
                'Material Transfer' => $repairproduct->repairproduct_transfer,
                'Reservation Number' => $repairproduct->repairproduct_reser,
                'Ex Station' =>  $repairproduct->repairproduct_origin,
                'SDV In' => $repairproduct->repairproduct_sdvin,
                'SDV Out' => $repairproduct->repairproduct_sdvout,
                'Station' => $repairproduct->repairproduct_station,
                'Requestor' => $repairproduct->repairproduct_requestor,
                'Project' =>  $repairproduct->repairproduct_project,
                'Date Out' => $repairproduct->repairproduct_dateout,
                'Date to offshore' =>  $repairproduct->repairproduct_dateoffshore,
                'Material transfer to offshore' => $repairproduct->repairproduct_tfoffshore,
                'Current Location' => $repairproduct->repairproduct_curloc,
                'Stock In' => $repairproduct->repairproduct_stockin,
                'Stock Out' => $repairproduct->repairproduct_docin,
                'Dok Stok In' =>  $repairproduct->repairproduct_stockout,
                'Dok Stok Out' => $repairproduct->repairproduct_docout,
                'Stock Quality' => $repairproduct->repairproduct_stockqty,
                'UOM' => $repairproduct->repairproduct_uom,
                'TARGET PDN' => $repairproduct->repairproduct_targetpdn,
                'CS Release' => $repairproduct->repairproduct_csrelease,
                'CS Number' => $repairproduct->repairproduct_csnumber,
                'CE Number' => $repairproduct->repairproduct_cenumber,
                'RO Number' => $repairproduct->repairproduct_ronumber,
                'Start Date' => $repairproduct->repairproduct_startdate,
                'End Date' => $repairproduct->repairproduct_enddate,
                'Price Repair' => $repairproduct->repairproduct_price,
                'REMARK' => $repairproduct->repairproduct_remark,
                'Product Image' => $repairproduct->repairproduct_image,
                'Product Code' => $repairproduct->repairproduct_code,
            );
        }

        $this->exportExcel($repairproduct_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($repairproducts){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($repairproducts);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="repairproducts.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

}
