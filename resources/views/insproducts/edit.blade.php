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
                        Edit Instrument
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('insproducts.index') }}">Instrument</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('insproducts.update', $insproduct->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Instrument Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ $insproduct->insproduct_image ? asset($insproduct->insproduct_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- insproduct image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('insproduct_image') is-invalid @enderror" type="file"  id="image" name="insproduct_image" accept="image/*" onchange="previewImage();">
                        @error('insproduct_image')
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
                        Instrument Detail
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (insproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('insproduct_assetID') is-invalid @enderror" id="insproduct_assetID" name="insproduct_assetID" type="text" placeholder="" value="{{ old('insproduct_assetID', $insproduct->insproduct_assetID) }}" autocomplete="off"/>
                                @error('insproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('insproduct_newassetID') is-invalid @enderror" id="insproduct_newassetID" name="insproduct_newassetID" type="text" placeholder="" value="{{ old('insproduct_newassetID', $insproduct->insproduct_newassetID) }}" autocomplete="off"/>
                                @error('insproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of insproduct type) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="insproduct_instype">Instrument Type</label>
                                    <select class="form-control form-control-solid @error('insproduct_instype') is-invalid @enderror" id="insproduct_instype" name="insproduct_instype" autocomplete="off">
                                        <option selected="" disabled="">Select a type:</option>
                                        <option value="" {{ old('insproduct_instype') === null ? 'selected' : '' }}>N/A</option>
                                        <option value="ABB" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'ABB' ? 'selected' : '' }}>ABB</option>
                                        <option value="Brooks Instrument" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Brooks Instrument' ? 'selected' : '' }}>Brooks Instrument</option>
                                        <option value="Endress+Hauser" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Endress+Hauser' ? 'selected' : '' }}>Endress+Hauser</option>
                                        <option value="Floboss" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Floboss' ? 'selected' : '' }}>Floboss</option>
                                        <option value="Foxboro" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Foxboro' ? 'selected' : '' }}>Foxboro</option>
                                        <option value="GE Measurement & Control Solutions" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'GE Measurement & Control Solutions' ? 'selected' : '' }}>GE Measurement & Control Solutions</option>
                                        <option value="Honeywell" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Honeywell' ? 'selected' : '' }}>Honeywell</option>
                                        <option value="Krohne" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Krohne' ? 'selected' : '' }}>Krohne</option>
                                        <option value="Micro Motion" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Micro Motion' ? 'selected' : '' }}>Micro Motion</option>
                                        <option value="Omega Engineering" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Omega Engineering' ? 'selected' : '' }}>Omega Engineering</option>
                                        <option value="Rosemount" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Rosemount' ? 'selected' : '' }}>Rosemount</option>
                                        <option value="Schneider Electric" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Schneider Electric' ? 'selected' : '' }}>Schneider Electric</option>
                                        <option value="Siemens" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Siemens' ? 'selected' : '' }}>Siemens</option>
                                        <option value="Vega" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Vega' ? 'selected' : '' }}>Vega</option>
                                        <option value="WIKA" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'WIKA' ? 'selected' : '' }}>WIKA</option>
                                        <option value="Yokogawa" {{ old('insproduct_instype', $insproduct->insproduct_instype) == 'Yokogawa' ? 'selected' : '' }}>Yokogawa</option>
                                    </select>
                                    @error('insproduct_instype')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of insproduct brand) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="insproduct_insbrand" >Instrument Brand</label>
                                    <select class="form-control form-control-solid @error('insproduct_insbrand') is-invalid @enderror" id="insproduct_insbrand" name="insproduct_insbrand" type="text" placeholder="" value="{{ old('insproduct_insbrand') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a brand:</option>
                                    <option value="" {{ old('insproduct_insbrand') === null ? 'selected' : '' }}>N/A</option>
                                    <option value="ABB" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'ABB' ? 'selected' : '' }}>ABB</option>
                                        <option value="Brooks Instrument" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Brooks Instrument' ? 'selected' : '' }}>Brooks Instrument</option>
                                        <option value="Endress+Hauser" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Endress+Hauser' ? 'selected' : '' }}>Endress+Hauser</option>
                                        <option value="Floboss" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Floboss' ? 'selected' : '' }}>Floboss</option>
                                        <option value="Foxboro" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Foxboro' ? 'selected' : '' }}>Foxboro</option>
                                        <option value="GE Measurement & Control Solutions" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'GE Measurement & Control Solutions' ? 'selected' : '' }}>GE Measurement & Control Solutions</option>
                                        <option value="Honeywell" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Honeywell' ? 'selected' : '' }}>Honeywell</option>
                                        <option value="Krohne" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Krohne' ? 'selected' : '' }}>Krohne</option>
                                        <option value="Micro Motion" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Micro Motion' ? 'selected' : '' }}>Micro Motion</option>
                                        <option value="Omega Engineering" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Omega Engineering' ? 'selected' : '' }}>Omega Engineering</option>
                                        <option value="Rosemount" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Rosemount' ? 'selected' : '' }}>Rosemount</option>
                                        <option value="Schneider Electric" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Schneider Electric' ? 'selected' : '' }}>Schneider Electric</option>
                                        <option value="Siemens" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Siemens' ? 'selected' : '' }}>Siemens</option>
                                        <option value="Vega" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Vega' ? 'selected' : '' }}>Vega</option>
                                        <option value="WIKA" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'WIKA' ? 'selected' : '' }}>WIKA</option>
                                        <option value="Yokogawa" {{ old('insproduct_insbrand', $insproduct->insproduct_insbrand) == 'Yokogawa' ? 'selected' : '' }}>Yokogawa</option>
                                    </select>
                                    @error('insproduct_insbrand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <!-- Form Group (insproduct serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('insproduct_serial') is-invalid @enderror" id="insproduct_serial" name="insproduct_serial" type="text" placeholder="" value="{{ old('insproduct_serial', $insproduct->insproduct_serial) }}" autocomplete="off"/>
                                @error('insproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (product transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_transfer">Asset Transfer Ref.</label>
                                <input class="form-control form-control-solid @error('insproduct_transfer') is-invalid @enderror" id="insproduct_transfer" name="insproduct_transfer" type="text" placeholder="" value="{{ old('insproduct_transfer', $insproduct->insproduct_transfer) }}" autocomplete="off"/>
                                @error('insproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('insproduct_reser') is-invalid @enderror" id="insproduct_reser" name="insproduct_reser" type="text" placeholder="" value="{{ old('insproduct_reser', $insproduct->insproduct_reser) }}" autocomplete="off"/>
                                @error('insproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_origin">Ex Station</label>
                                <input class="form-control form-control-solid @error('insproduct_origin') is-invalid @enderror" id="insproduct_origin" name="insproduct_origin" type="text" placeholder="" value="{{ old('insproduct_origin', $insproduct->insproduct_origin) }}" autocomplete="off"/>
                                @error('insproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('insproduct_sdvin') is-invalid @enderror" id="insproduct_sdvin" name="insproduct_sdvin" type="text" placeholder="" value="{{ old('insproduct_sdvin', $insproduct->insproduct_sdvin) }}" autocomplete="off"/>
                                @error('insproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('insproduct_sdvout') is-invalid @enderror" id="insproduct_sdvout" name="insproduct_sdvout" type="text" placeholder="" value="{{ old('insproduct_sdvout', $insproduct->insproduct_sdvout) }}" autocomplete="off"/>
                                @error('insproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('insproduct_station') is-invalid @enderror" id="insproduct_station" name="insproduct_station" type="text" placeholder="" value="{{ old('insproduct_station', $insproduct->insproduct_station) }}" autocomplete="off"/>
                                @error('insproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('insproduct_requestor') is-invalid @enderror" id="insproduct_requestor" name="insproduct_requestor" type="text" placeholder="" value="{{ old('insproduct_requestor', $insproduct->insproduct_requestor) }}" autocomplete="off"/>
                                @error('insproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('insproduct_project') is-invalid @enderror" id="insproduct_project" name="insproduct_project" type="text" placeholder="" value="{{ old('insproduct_project', $insproduct->insproduct_project) }}" autocomplete="off"/>
                                @error('insproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_datein') is-invalid @enderror" name="insproduct_datein" id="insproduct_datein" type="date" placeholder="" value="{{ old('insproduct_datein', $insproduct->insproduct_datein) }}" autocomplete="off"/>
                                @error('insproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_dateout') is-invalid @enderror" name="insproduct_dateout" id="insproduct_dateout" type="date" placeholder="" value="{{ old('insproduct_dateout', $insproduct->insproduct_dateout) }}" autocomplete="off"/>
                                @error('insproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_dateoffshore">Date to offshore</span></label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_dateoffshore') is-invalid @enderror" name="insproduct_dateoffshore" id="insproduct_dateoffshore" type="date" value="{{ old('insproduct_dateoffshore', $insproduct->insproduct_dateoffshore) }}" autocomplete="off"/>
                                @error('insproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct transfer offshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('insproduct_tfoffshore') is-invalid @enderror" id="insproduct_tfoffshore" name="insproduct_tfoffshore" type="text" placeholder="" value="{{ old('insproduct_tfoffshore', $insproduct->insproduct_tfoffshore) }}" autocomplete="off"/>
                                @error('insproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('insproduct_curloc') is-invalid @enderror" id="insproduct_curloc" name="insproduct_curloc" type="text" placeholder="" value="{{ old('insproduct_curloc', $insproduct->insproduct_curloc) }}" autocomplete="off"/>
                                @error('insproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>        
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_targetpdn">Target PDN</span></label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_targetpdn') is-invalid @enderror" name="insproduct_targetpdn" id="insproduct_targetpdn" type="date" value="{{ old('insproduct_targetpdn', $insproduct->insproduct_targetpdn) }}" autocomplete="off"/>
                                @error('insproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>               
                            <!-- Form Group (stockIn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_stockin">Stock In<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('insproduct_stockin') is-invalid @enderror" id="insproduct_stockin" name="insproduct_stockin" type="text" placeholder="" value="{{ old('insproduct_stockin', $insproduct->insproduct_stockin) }}" autocomplete="off"/>
                                @error('insproduct_stockin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('insproduct_docin') is-invalid @enderror" type="file"  id="insproduct_docin" name="insproduct_docin" accept=".pdf,.doc,.docx">
                                @error('insproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('insproduct_stockout') is-invalid @enderror" id="insproduct_stockout" name="insproduct_stockout" type="text" placeholder="" value="{{ old('insproduct_stockout', $insproduct->insproduct_stockout) }}" autocomplete="off"/>
                                @error('insproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('insproduct_docout') is-invalid @enderror" type="file"  id="insproduct_docout" name="insproduct_docout" accept=".pdf,.doc,.docx">
                                @error('insproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_stockqty">Stock Quality<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('insproduct_stockqty') is-invalid @enderror" id="insproduct_stockqty" name="insproduct_stockqty" type="text" placeholder="" value="{{ old('insproduct_stockqty', $insproduct->insproduct_stockqty) }}" autocomplete="off"/>
                                @error('insproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('insproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('insproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('insproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('insproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('insproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>
                            </div>
                            <!-- Form Group (type of insproduct UOM) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="insproduct_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('insproduct_uom') is-invalid @enderror" id="insproduct_uom" name="insproduct_uom" type="text" placeholder="" value="{{ old('insproduct_uom', $insproduct->insproduct_uom) }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a UOM:</option>
                                    <option value="" {{ old('insproduct_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('insproduct_uom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (insproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('insproduct_csrelease') is-invalid @enderror" id="insproduct_csrelease" name="insproduct_csrelease" type="text" placeholder="" value="{{ old('insproduct_csrelease', $insproduct->insproduct_csrelease) }}" autocomplete="off"/>
                                @error('insproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('insproduct_csnumber') is-invalid @enderror" id="insproduct_csnumber" name="insproduct_csnumber" type="text" placeholder="" value="{{ old('insproduct_csnumber', $insproduct->insproduct_csnumber) }}" autocomplete="off"/>
                                @error('insproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('insproduct_cenumber') is-invalid @enderror" id="insproduct_cenumber" name="insproduct_cenumber" type="text" placeholder="" value="{{ old('insproduct_cenumber', $insproduct->insproduct_cenumber) }}" autocomplete="off"/>
                                @error('insproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('insproduct_ronumber') is-invalid @enderror" id="insproduct_ronumber" name="insproduct_ronumber" type="text" placeholder="" value="{{ old('insproduct_ronumber', $insproduct->insproduct_ronumber) }}" autocomplete="off"/>
                                @error('insproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_startdate') is-invalid @enderror" name="insproduct_startdate" id="insproduct_startdate" type="date" value="{{ old('insproduct_startdate', $insproduct->insproduct_startdate) }}" autocomplete="off"/>
                                @error('insproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_enddate') is-invalid @enderror" name="insproduct_enddate" id="insproduct_enddate" type="date" value="{{ old('insproduct_enddate', $insproduct->insproduct_enddate) }}" autocomplete="off"/>
                                @error('insproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="insproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('insproduct_price') is-invalid @enderror" name="insproduct_price" id="insproduct_price" type="text" value="{{ old('insproduct_price', $insproduct->insproduct_price) }}" autocomplete="off"/>
                                @error('insproduct_price')
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
                                    var productPriceInput = document.getElementById('insproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('insproduct_price').value;
                                    document.getElementById('insproduct_price').value = formatRupiah(initialValue);
                                </script>    
                            </div>    
                            <!-- Form Group (insproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('insproduct_remark') is-invalid @enderror" id="insproduct_remark" name="insproduct_remark" type="text" placeholder="" value="{{ old('insproduct_remark', $insproduct->insproduct_remark) }}" autocomplete="off"/>
                                @error('insproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('insproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: insproduct Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
