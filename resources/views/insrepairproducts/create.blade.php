@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Add Instrument
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('insrepairproducts.index') }}">Instrument</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('insrepairproducts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Instrument Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset('aassets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('insrepairproduct_image') is-invalid @enderror" type="file"  id="image" name="insrepairproduct_image" accept="image/*" onchange="previewImage();">
                        @error('insrepairproduct_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Instrument Details
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (insrepairproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_assetID') is-invalid @enderror" id="insrepairproduct_assetID" name="insrepairproduct_assetID" type="text" placeholder="" value="{{ old('insrepairproduct_assetID') }}" autocomplete="off"/>
                                @error('insrepairproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_newassetID') is-invalid @enderror" id="insrepairproduct_newassetID" name="insrepairproduct_newassetID" type="text" placeholder="" value="{{ old('insrepairproduct_newassetID') }}" autocomplete="off"/>
                                @error('insrepairproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of insrepairproduct type) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="small mb-1" for="insrepairproduct_instype">Instrument Type</label>
                                <select class="form-control form-control-solid @error('insrepairproduct_instype') is-invalid @enderror" id="insrepairproduct_instype" name="insrepairproduct_instype" type="text" placeholder="" value="{{ old('insrepairproduct_instype') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a type:</option>
                                    <option value="" {{ old('insrepairproduct_instype') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Analyzer</option>
                                        </option>Detector - Flame</option>
                                        </option>Detector - Gas</option>
                                        </option>Flow Computer</option>
                                        </option>Flowmeter - Coriolis</option>
                                        </option>Flowmeter - Magnetic</option>
                                        </option>Flowmeter - Orifice</option>
                                        </option>Flowmeter - PD</option>
                                        </option>Flowmeter - Thermal Mass</option>
                                        </option>Flowmeter - Turbine</option>
                                        </option>Flowmeter - Ultrasonic</option>
                                        </option>Flowmeter - Vortex</option>
                                        </option>Sensor</option>
                                        </option>Switch - Pressure</option>
                                        </option>Switch - Temperature</option>
                                        </option>Switch - Vibration</option>
                                        </option>Transmitter - Flow</option>
                                        </option>Transmitter - Level</option>
                                        </option>Transmitter - Pressure</option>
                                        </option>Transmitter - Temperature</option>
                                        </option>Brooks Instrument</option>
                                        <option>Daniel</option>
                                        <option>Endress+Hauser</option>
                                        <option>Floboss</option>
                                        <option>Foxboro</option>
                                        <option>GE Measurement & Control Solutions</option>
                                        <option>Honeywell</option>
                                        <option>Rosemount</option>
                                        <option>Krohne</option>
                                        <option>Micro Motion</option>
                                        <option>Omega Engineering</option>
                                        <option>Rosemount</option>
                                        <option>Schneider Electric</option>
                                        <option>Siemens</option>
                                        <option>Vega</option>
                                        <option>WIKA</option>
                                        <option>Yokogawa</option>
                                    </select>
                                    @error('insrepairproduct_instype')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                           <!-- Form Group (type of insrepairproduct brand) -->
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="insrepairproduct_insbrand">Instrument brand</label>
                                    <select class="form-control form-control-solid @error('insrepairproduct_insbrand') is-invalid @enderror" id="insrepairproduct_insbrand" name="insrepairproduct_insbrand" type="text" placeholder="" value="{{ old('insrepairproduct_insbrand') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a brand:</option>
                                    <option value="" {{ old('insrepairproduct_insbrand') === null ? 'selected' : '' }}>N/A</option>
                                    <option>ABB</option>
                                    <option>Brooks Instrument</option>
                                    <option>Daniel</option>
                                    <option>Endress+Hauser</option>
                                    <option>Floboss</option>
                                    <option>Foxboro</option>
                                    <option>GE Measurement & Control Solutions</option>
                                    <option>Honeywell</option>
                                    <option>Rosemount</option>
                                    <option>Krohne</option>
                                    <option>Micro Motion</option>
                                    <option>Omega Engineering</option>
                                    <option>Rosemount</option>
                                    <option>Schneider Electric</option>
                                    <option>Siemens</option>
                                    <option>Vega</option>
                                    <option>WIKA</option>
                                    <option>Yokogawa</option>
                                    </select>
                                    @error('insproduct_insbrand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <!-- Form Group (insrepairproduct serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('insrepairproduct_serial') is-invalid @enderror" id="insrepairproduct_serial" name="insrepairproduct_serial" type="text" placeholder="" value="{{ old('insrepairproduct_serial') }}" autocomplete="off"/>
                                @error('insrepairproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (insrepairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_transfer">Material Transfer </label>
                                <input class="form-control form-control-solid @error('insrepairproduct_transfer') is-invalid @enderror" id="insrepairproduct_transfer" name="insrepairproduct_transfer" type="text" placeholder="" value="{{ old('insrepairproduct_transfer') }}" autocomplete="off"/>
                                @error('insrepairproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_reser') is-invalid @enderror" id="insrepairproduct_reser" name="insrepairproduct_reser" type="text" placeholder="" value="{{ old('insrepairproduct_reser') }}" autocomplete="off"/>
                                @error('insrepairproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <!-- Form Group (insrepairproduct origin) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_origin">Ex Station </label>
                                <input class="form-control form-control-solid @error('insrepairproduct_origin') is-invalid @enderror" id="insrepairproduct_origin" name="insrepairproduct_origin" type="text" placeholder="" value="{{ old('insrepairproduct_origin') }}" autocomplete="off"/>
                                @error('insrepairproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_sdvin') is-invalid @enderror" id="insrepairproduct_sdvin" name="insrepairproduct_sdvin" type="text" placeholder="" value="{{ old('insrepairproduct_sdvin') }}" autocomplete="off"/>
                                @error('insrepairproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_sdvout') is-invalid @enderror" id="insrepairproduct_sdvout" name="insrepairproduct_sdvout" type="text" placeholder="" value="{{ old('insrepairproduct_sdvout') }}" autocomplete="off"/>
                                @error('insrepairproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_station') is-invalid @enderror" id="insrepairproduct_station" name="insrepairproduct_station" type="text" placeholder="" value="{{ old('insrepairproduct_station') }}" autocomplete="off"/>
                                @error('insrepairproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_requestor') is-invalid @enderror" id="insrepairproduct_requestor" name="insrepairproduct_requestor" type="text" placeholder="" value="{{ old('insrepairproduct_requestor') }}" autocomplete="off"/>
                                @error('insrepairproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_project') is-invalid @enderror" id="insrepairproduct_project" name="insrepairproduct_project" type="text" placeholder="" value="{{ old('insrepairproduct_project') }}" autocomplete="off"/>
                                @error('insrepairproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_datein') is-invalid @enderror" name="insrepairproduct_datein" id="insrepairproduct_datein" type="date" value="{{ old('insrepairproduct_datein') }}" autocomplete="off"/>
                                @error('insrepairproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_dateout') is-invalid @enderror" name="insrepairproduct_dateout" id="insrepairproduct_dateout" type="date" value="{{ old('insrepairproduct_dateout') }}" autocomplete="off"/>
                                @error('insrepairproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_dateoffshore') is-invalid @enderror" name="insrepairproduct_dateoffshore" id="insrepairproduct_dateoffshore" type="date" value="{{ old('insrepairproduct_dateoffshore') }}" autocomplete="off"/>
                                @error('insrepairproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct transfer offshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_tfoffshore') is-invalid @enderror" id="insrepairproduct_tfoffshore" name="insrepairproduct_tfoffshore" type="text" placeholder="" value="{{ old('insrepairproduct_tfoffshore') }}" autocomplete="off"/>
                                @error('insrepairproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_curloc') is-invalid @enderror" id="insrepairproduct_curloc" name="insrepairproduct_curloc" type="text" placeholder="" value="{{ old('insrepairproduct_curloc') }}" autocomplete="off"/>
                                @error('insrepairproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_targetpdn') is-invalid @enderror" name="insrepairproduct_targetpdn" id="insrepairproduct_targetpdn" type="date" value="{{ old('insrepairproduct_targetpdn') }}" autocomplete="off"/>
                                @error('insrepairproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>                        
                            <!-- Form Group (stockIn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_stockin">Stock In</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_stockin') is-invalid @enderror" id="insrepairproduct_stockin" name="insrepairproduct_stockin" type="text" placeholder="" value="{{ old('insrepairproduct_stockin') }}" autocomplete="off" />
                                @error('insrepairproduct_stockin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('insrepairproduct_docin') is-invalid @enderror" type="file"  id="insrepairproduct_docin" name="insrepairproduct_docin" accept=".pdf,.doc,.docx">
                                @error('insrepairproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_stockout') is-invalid @enderror" id="insrepairproduct_stockout" name="insrepairproduct_stockout" type="text" placeholder="" value="{{ old('insrepairproduct_stockout') }}" autocomplete="off"/>
                                @error('insrepairproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('insrepairproduct_docout') is-invalid @enderror" type="file"  id="insrepairproduct_docout" name="insrepairproduct_docout" accept=".pdf,.doc,.docx">
                                @error('insrepairproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_stockqty">Stock Quality</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_stockqty') is-invalid @enderror" id="insrepairproduct_stockqty" name="insrepairproduct_stockqty" type="text" placeholder="" value="{{ old('insrepairproduct_stockqty') }}" autocomplete="off"/>
                                @error('insrepairproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('insrepairproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('insrepairproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('insrepairproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('insrepairproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('insrepairproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>                                
                            </div>
                            <!-- Form Group (type of insrepairproduct UOM) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="insrepairproduct_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('insrepairproduct_uom') is-invalid @enderror" id="insrepairproduct_uom" name="insrepairproduct_uom" type="text" placeholder="" value="{{ old('insrepairproduct_uom') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a UOM:</option>
                                    <option value="" {{ old('insrepairproduct_uom') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Box</option>
                                        <option>Bundle</option>
                                        <option>Carton</option>
                                        <option>Case</option>
                                        <option>Dozen</option>
                                        <option>Each</option>
                                        <option>Gallon</option>
                                        <option>Joint (3 meter)</option>
                                        <option>Joint (6 meter)</option>
                                        <option>Kilogram</option>
                                        <option>Liter</option>
                                        <option>Meter</option>
                                        <option>Ounce</option>
                                        <option>Pair</option>
                                        <option>Pallet</option>
                                        <option>Pc</option>
                                        <option>Pound</option>
                                        <option>Roll</option>
                                        <option>Set</option>
                                        <option>Ton</option>
                                    </select>
                                    @error('insrepairproduct_uom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (insrepairproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_csrelease') is-invalid @enderror" id="insrepairproduct_csrelease" name="insrepairproduct_csrelease" type="text" placeholder="" value="{{ old('insrepairproduct_csrelease') }}" autocomplete="off"/>
                                @error('insrepairproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_csnumber') is-invalid @enderror" id="insrepairproduct_csnumber" name="insrepairproduct_csnumber" type="text" placeholder="" value="{{ old('insrepairproduct_csnumber') }}" autocomplete="off"/>
                                @error('insrepairproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_cenumber') is-invalid @enderror" id="insrepairproduct_cenumber" name="insrepairproduct_cenumber" type="text" placeholder="" value="{{ old('insrepairproduct_cenumber') }}" autocomplete="off"/>
                                @error('insrepairproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_ronumber') is-invalid @enderror" id="insrepairproduct_ronumber" name="insrepairproduct_ronumber" type="text" placeholder="" value="{{ old('insrepairproduct_ronumber') }}" autocomplete="off"/>
                                @error('insrepairproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_startdate') is-invalid @enderror" name="insrepairproduct_startdate" id="insrepairproduct_startdate" type="date" value="{{ old('insrepairproduct_startdate') }}" autocomplete="off"/>
                                @error('insrepairproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_enddate') is-invalid @enderror" name="insrepairproduct_enddate" id="insrepairproduct_enddate" type="date" value="{{ old('insrepairproduct_enddate') }}" autocomplete="off"/>
                                @error('insrepairproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insrepairproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_price') is-invalid @enderror" name="insrepairproduct_price" id="insrepairproduct_price" type="text" value="{{ old('insrepairproduct_price') }}" autocomplete="off"/>
                                @error('insrepairproduct_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk mengubah format input menjadi rupiah
                                    function formatRupiah(angka) {
                                        var number_string = angka.toString().replace(/[^,\d]/g, ''),
                                            split = number_string.split(','),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                
                                        if (ribuan) {
                                            separator = sisa ? '.' : '';
                                            rupiah += separator + ribuan.join('.');
                                        }
                                
                                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                        return rupiah;
                                    }
                                
                                    // Event listener untuk mengubah format rupiah saat input berubah
                                    var productPriceInput = document.getElementById('insrepairproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('insrepairproduct_price').value;
                                    document.getElementById('product_price').value = formatRupiah(initialValue);
                                </script>    
                            </div>    
                             <!-- Form Group (status) -->
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="insrepairproduct_status" >Status</label>
                                    <select class="form-control form-control-solid @error('insrepairproduct_status') is-invalid @enderror" id="insrepairproduct_status" name="insrepairproduct_status" status="text" placeholder="" value="{{ old('insrepairproduct_status') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a status:</option>
                                    <option value="" {{ old('insrepairproduct_status') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Incoming</option>
                                        <option>Outgoing</option>
                                        <option>At Workshop</option>
                                    </select>
                                    @error('insrepairproduct_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>  
                            <!-- Form Group (insrepairproduct Remark) -->
                            <div class="col-md-15">
                                <label class="small mb-1" for="insrepairproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('insrepairproduct_remark') is-invalid @enderror" id="insrepairproduct_remark" name="insrepairproduct_remark" type="text" placeholder="" value="{{ old('insrepairproduct_remark') }}" autocomplete="off"/>
                                @error('insrepairproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('insrepairproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
