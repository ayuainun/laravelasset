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
                        Edit Item
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('autorepairproducts.index') }}">Product Automation</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('autorepairproducts.update', $autorepairproduct->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- autorepairproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Automation Image</div>
                    <div class="card-body text-center">
                        <!-- autorepairproduct image -->
                        <img class="img-account-profile mb-2" src="{{ $autorepairproduct->autorepairproduct_image ? asset($autorepairproduct->autorepairproduct_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- autorepairproduct image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- autorepairproduct image input -->
                        <input class="form-control form-control-solid mb-2 @error('autorepairproduct_image') is-invalid @enderror" type="file"  id="image" name="autorepairproduct_image" accept="image/*" onchange="previewImage();">
                        @error('autorepairproduct_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: autorepairproduct Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Detail Automation
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (autorepairproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_assetID') is-invalid @enderror" id="autorepairproduct_assetID" name="autorepairproduct_assetID" type="text" placeholder="" value="{{ old('autorepairproduct_assetID', $autorepairproduct->autorepairproduct_assetID) }}" autocomplete="off"/>
                                @error('autorepairproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_newassetID') is-invalid @enderror" id="autorepairproduct_newassetID" name="autorepairproduct_newassetID" type="text" placeholder="" value="{{ old('autorepairproduct_newassetID', $autorepairproduct->autorepairproduct_newassetID) }}" autocomplete="off"/>
                                @error('autorepairproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of autorepairproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_autobrand">Automation Brand</label>
                                <select class="form-select form-control-solid @error('autorepairproduct_autobrand') is-invalid @enderror" id="autorepairproduct_autobrand" name="autorepairproduct_autobrand">
                                    <option selected="" disabled="">Select a brand:</option>
                                    <option value="" {{ old('autorepairproduct_autobrand') === null ? 'selected' : '' }}>N/A</option>
                                        <option value="ABB" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'ABB' ? 'selected' : '' }}>ABB</option>
                                        <option value="Allen-Bradley (Rockwell Automation)" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Allen-Bradley (Rockwell Automation)' ? 'selected' : '' }}>Allen-Bradley (Rockwell Automation)</option>
                                        <option value="Beckhoff" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Beckhoff' ? 'selected' : '' }}>Beckhoff</option>
                                        <option value="Bosch Rexroth" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Bosch Rexroth' ? 'selected' : '' }}>Bosch Rexroth</option>
                                        <option value="Delta V" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Delta V' ? 'selected' : '' }}>Delta V</option>
                                        <option value="GE Fanuc" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'GE Fanuc' ? 'selected' : '' }}>GE Fanuc</option>
                                        <option value="Honeywell" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Honeywell' ? 'selected' : '' }}>Honeywell</option>
                                        <option value="Mitsubishi Electric" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Mitsubishi Electric' ? 'selected' : '' }}>Mitsubishi Electric</option>
                                        <option value="Omron" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Omron' ? 'selected' : '' }}>Omron</option>
                                        <option value="Schneider Electric" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Schneider Electric' ? 'selected' : '' }}>Schneider Electric</option>
                                        <option value="Siemens" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Siemens' ? 'selected' : '' }}>Siemens</option>
                                        <option value="Yokogawa" {{ old('autorepairproduct_autobrand', $autorepairproduct->autorepairproduct_autobrand) == 'Yokogawa' ? 'selected' : '' }}>Yokogawa</option>
                                </select>
                                @error('autorepairproduct_autobrand')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct serial) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('autorepairproduct_serial') is-invalid @enderror" id="autorepairproduct_serial" name="autorepairproduct_serial" type="text" placeholder="" value="{{ old('autorepairproduct_serial', $autorepairproduct->autorepairproduct_serial) }}" autocomplete="off"/>
                                @error('autorepairproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autorepairproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_datein') is-invalid @enderror" name="autorepairproduct_datein" id="autorepairproduct_datein" type="date" placeholder="" value="{{ old('autorepairproduct_datein', $autorepairproduct->autorepairproduct_datein) }}" autocomplete="off"/>
                                @error('autorepairproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_transfer">Material Transfer</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_transfer') is-invalid @enderror" id="autorepairproduct_transfer" name="autorepairproduct_transfer" type="text" placeholder="" value="{{ old('autorepairproduct_transfer', $autorepairproduct->autorepairproduct_transfer) }}" autocomplete="off"/>
                                @error('autorepairproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_reser') is-invalid @enderror" id="autorepairproduct_reser" name="autorepairproduct_reser" type="text" placeholder="" value="{{ old('autorepairproduct_reser', $autorepairproduct->autorepairproduct_reser) }}" autocomplete="off"/>
                                @error('autorepairproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_origin">Ex Station</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_origin') is-invalid @enderror" id="autorepairproduct_origin" name="autorepairproduct_origin" type="text" placeholder="" value="{{ old('autorepairproduct_origin', $autorepairproduct->autorepairproduct_origin) }}" autocomplete="off"/>
                                @error('autorepairproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_sdvin') is-invalid @enderror" id="autorepairproduct_sdvin" name="autorepairproduct_sdvin" type="text" placeholder="" value="{{ old('autorepairproduct_sdvin', $autorepairproduct->autorepairproduct_sdvin) }}" autocomplete="off"/>
                                @error('autorepairproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_sdvout') is-invalid @enderror" id="autorepairproduct_sdvout" name="autorepairproduct_sdvout" type="text" placeholder="" value="{{ old('autorepairproduct_sdvout', $autorepairproduct->autorepairproduct_sdvout) }}" autocomplete="off"/>
                                @error('autorepairproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_station') is-invalid @enderror" id="autorepairproduct_station" name="autorepairproduct_station" type="text" placeholder="" value="{{ old('autorepairproduct_station', $autorepairproduct->autorepairproduct_station) }}" autocomplete="off"/>
                                @error('autorepairproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_requestor') is-invalid @enderror" id="autorepairproduct_requestor" name="autorepairproduct_requestor" type="text" placeholder="" value="{{ old('autorepairproduct_requestor', $autorepairproduct->autorepairproduct_requestor) }}" autocomplete="off"/>
                                @error('autorepairproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_project') is-invalid @enderror" id="autorepairproduct_project" name="autorepairproduct_project" type="text" placeholder="" value="{{ old('autorepairproduct_project', $autorepairproduct->autorepairproduct_project) }}" autocomplete="off"/>
                                @error('autorepairproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autorepairproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_dateout') is-invalid @enderror" name="autorepairproduct_dateout" id="autorepairproduct_dateout" type="date" value="{{ old('autorepairproduct_dateout', $autorepairproduct->autorepairproduct_dateout) }}" autocomplete="off">
                                @error('autorepairproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autorepairproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_dateoffshore') is-invalid @enderror" name="autorepairproduct_dateoffshore" id="autorepairproduct_dateoffshore" type="date" value="{{ old('autorepairproduct_dateoffshore', $autorepairproduct->autorepairproduct_dateoffshore) }}" autocomplete="off">
                                @error('autorepairproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_tfoffshore') is-invalid @enderror" id="autorepairproduct_tfoffshore" name="autorepairproduct_tfoffshore" type="text" placeholder="" value="{{ old('autorepairproduct_tfoffshore', $autorepairproduct->autorepairproduct_tfoffshore) }}" autocomplete="off"/>
                                @error('autorepairproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_curloc') is-invalid @enderror" id="autorepairproduct_curloc" name="autorepairproduct_curloc" type="text" placeholder="" value="{{ old('autorepairproduct_curloc', $autorepairproduct->autorepairproduct_curloc) }}" autocomplete="off"/>
                                @error('autorepairproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockIn) -->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="autorepairproduct_stockin">Stock In</label>
                                    <input class="form-control form-control-solid @error('autorepairproduct_stockin') is-invalid @enderror" id="autorepairproduct_stockin" name="autorepairproduct_stockin" type="text" placeholder="" value="{{ old('autorepairproduct_stockin', $autorepairproduct->autorepairproduct_stockin) }}" autocomplete="off"/>
                                    @error('autorepairproduct_stockin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('autorepairproduct_docin') is-invalid @enderror" type="file"  id="autorepairproduct_docin" name="autorepairproduct_docin" accept=".pdf,.doc,.docx">
                                @error('autorepairproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_stockout') is-invalid @enderror" id="autorepairproduct_stockout" name="autorepairproduct_stockout" type="text" placeholder="" value="{{ old('autorepairproduct_stockout', $autorepairproduct->autorepairproduct_stockout) }}" autocomplete="off"/>
                                @error('autorepairproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('autorepairproduct_docout') is-invalid @enderror" type="file"  id="autorepairproduct_docout" name="autorepairproduct_docout" accept=".pdf,.doc,.docx">
                                @error('autorepairproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_stockqty">Stock Quality</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_stockqty') is-invalid @enderror" id="autorepairproduct_stockqty" name="autorepairproduct_stockqty" type="text" placeholder="" value="{{ old('autorepairproduct_stockqty', $autorepairproduct->autorepairproduct_stockqty) }}" autocomplete="off"/>
                                @error('autorepairproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('autorepairproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('autorepairproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('autorepairproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('autorepairproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('autorepairproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>
                            </div>
                            <!-- Form Group (type of autorepairproduct UOM) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_uom">UOM</label>
                                <select class="form-select form-control-solid @error('autorepairproduct_uom') is-invalid @enderror" id="autorepairproduct_uom" name="autorepairproduct_uom">
                                    <option selected="" disabled="">Select a uom:</option>
                                    <option value="" {{ old('autorepairproduct_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                @error('autorepairproduct_uom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autorepairproduct_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_targetpdn') is-invalid @enderror" name="autorepairproduct_targetpdn" id="autorepairproduct_targetpdn" type="date" value="{{ old('autorepairproduct_targetpdn', $autorepairproduct->autorepairproduct_targetpdn) }}">
                                @error('autorepairproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_csrelease') is-invalid @enderror" id="autorepairproduct_csrelease" name="autorepairproduct_csrelease" type="text" placeholder="" value="{{ old('autorepairproduct_csrelease', $autorepairproduct->autorepairproduct_csrelease) }}" autocomplete="off"/>
                                @error('autorepairproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_csnumber') is-invalid @enderror" id="autorepairproduct_csnumber" name="autorepairproduct_csnumber" type="text" placeholder="" value="{{ old('autorepairproduct_csnumber', $autorepairproduct->autorepairproduct_csnumber) }}" autocomplete="off"/>
                                @error('autorepairproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_cenumber') is-invalid @enderror" id="autorepairproduct_cenumber" name="autorepairproduct_cenumber" type="text" placeholder="" value="{{ old('autorepairproduct_cenumber', $autorepairproduct->autorepairproduct_cenumber) }}" autocomplete="off"/>
                                @error('autorepairproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_ronumber') is-invalid @enderror" id="autorepairproduct_ronumber" name="autorepairproduct_ronumber" type="text" placeholder="" value="{{ old('autorepairproduct_ronumber', $autorepairproduct->autorepairproduct_ronumber) }}" autocomplete="off"/>
                                @error('autorepairproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autorepairproduct_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_startdate') is-invalid @enderror" name="autorepairproduct_startdate" id="autorepairproduct_startdate" type="date" value="{{ old('autorepairproduct_startdate', $autorepairproduct->autorepairproduct_startdate) }}">
                                @error('autorepairproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autorepairproduct_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_enddate') is-invalid @enderror" name="autorepairproduct_enddate" id="autorepairproduct_enddate" type="date" value="{{ old('autorepairproduct_enddate', $autorepairproduct->autorepairproduct_enddate) }}">
                                @error('autorepairproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <!-- Form Group (autorepairproduct price) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_price">Repair Price</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_price') is-invalid @enderror" id="autorepairproduct_price" name="autorepairproduct_price" type="text" placeholder="" value="{{ old('autorepairproduct_price', $autorepairproduct->autorepairproduct_price) }}" autocomplete="off"/>
                                @error('autorepairproduct_price')
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
                                    var productPriceInput = document.getElementById('autorepairproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('autorepairproduct_price').value;
                                    document.getElementById('autorepairproduct_price').value = formatRupiah(initialValue);
                                </script>      
                            </div>
                            <!-- Form Group (status) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="autorepairproduct_status" >Status</label>
                                    <select class="form-control form-control-solid @error('autorepairproduct_status') is-invalid @enderror" id="autorepairproduct_status" name="autorepairproduct_status" status="text" placeholder="" value="{{ old('autorepairproduct_status', $autorepairproduct->autorepairproduct_status) }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a status:</option>
                                    <option value="" {{ old('autorepairproduct_status') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Incoming</option>
                                        <option>Outgoing</option>
                                        <option>At Workshop</option>
                                    </select>
                                    @error('autorepairproduct_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>  
                            <!-- Form Group (autorepairproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('autorepairproduct_remark') is-invalid @enderror" id="autorepairproduct_remark" name="autorepairproduct_remark" type="text" placeholder="" value="{{ old('autorepairproduct_remark', $autorepairproduct->autorepairproduct_remark) }}" autocomplete="off"/>
                                @error('autorepairproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('autorepairproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: autorepairproduct Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
