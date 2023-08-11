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
                    <li class="breadcrumb-item"><a href="{{ route('autoproducts.index') }}">Product Automation</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('autoproducts.update', $autoproduct->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- autoproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Automation Image</div>
                    <div class="card-body text-center">
                        <!-- autoproduct image -->
                        <img class="img-account-profile mb-2" src="{{ $autoproduct->autoproduct_image ? asset($autoproduct->autoproduct_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- autoproduct image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- autoproduct image input -->
                        <input class="form-control form-control-solid mb-2 @error('autoproduct_image') is-invalid @enderror" type="file"  id="image" name="autoproduct_image" accept="image/*" onchange="previewImage();">
                        @error('autoproduct_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: autoproduct Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Data Master
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (autoproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('autoproduct_assetID') is-invalid @enderror" id="autoproduct_assetID" name="autoproduct_assetID" type="text" placeholder="" value="{{ old('autoproduct_assetID', $autoproduct->autoproduct_assetID) }}" autocomplete="off"/>
                                @error('autoproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('autoproduct_newassetID') is-invalid @enderror" id="autoproduct_newassetID" name="autoproduct_newassetID" type="text" placeholder="" value="{{ old('autoproduct_newassetID', $autoproduct->autoproduct_newassetID) }}" autocomplete="off"/>
                                @error('autoproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of autoproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_brand">Automation Brand <span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('autoproduct_brand') is-invalid @enderror" id="autoproduct_brand" name="autoproduct_brand">
                                    <option selected="" disabled="">Select a brand:</option>
                                    <option value="" {{ old('autoproduct_brand') === null ? 'selected' : '' }}>N/A</option>
                                        <option value="ABB" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'ABB' ? 'selected' : '' }}>ABB</option>
                                        <option value="Allen-Bradley (Rockwell Automation)" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Allen-Bradley (Rockwell Automation)' ? 'selected' : '' }}>Allen-Bradley (Rockwell Automation)</option>
                                        <option value="Beckhoff" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Beckhoff' ? 'selected' : '' }}>Beckhoff</option>
                                        <option value="Bosch Rexroth" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Bosch Rexroth' ? 'selected' : '' }}>Bosch Rexroth</option>
                                        <option value="Delta V" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Delta V' ? 'selected' : '' }}>Delta V</option>
                                        <option value="GE Fanuc" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'GE Fanuc' ? 'selected' : '' }}>GE Fanuc</option>
                                        <option value="Honeywell" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Honeywell' ? 'selected' : '' }}>Honeywell</option>
                                        <option value="Mitsubishi Electric" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Mitsubishi Electric' ? 'selected' : '' }}>Mitsubishi Electric</option>
                                        <option value="Omron" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Omron' ? 'selected' : '' }}>Omron</option>
                                        <option value="Schneider Electric" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Schneider Electric' ? 'selected' : '' }}>Schneider Electric</option>
                                        <option value="Siemens" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Siemens' ? 'selected' : '' }}>Siemens</option>
                                        <option value="Yokogawa" {{ old('autoproduct_brand', $autoproduct->autoproduct_brand) == 'Yokogawa' ? 'selected' : '' }}>Yokogawa</option>
                                </select>
                                @error('autoproduct_brand')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct serial) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('autoproduct_serial') is-invalid @enderror" id="autoproduct_serial" name="autoproduct_serial" type="text" placeholder="" value="{{ old('autoproduct_serial', $autoproduct->autoproduct_serial) }}" autocomplete="off"/>
                                @error('autoproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autoproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_datein') is-invalid @enderror" name="autoproduct_datein" id="autoproduct_datein" type="date" placeholder="" value="{{ old('autoproduct_datein', $autoproduct->autoproduct_datein) }}" autocomplete="off"/>
                                @error('autoproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_transfer">Material Transfer</label>
                                <input class="form-control form-control-solid @error('autoproduct_transfer') is-invalid @enderror" id="autoproduct_transfer" name="autoproduct_transfer" type="text" placeholder="" value="{{ old('autoproduct_transfer', $autoproduct->autoproduct_transfer) }}" autocomplete="off"/>
                                @error('autoproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('autoproduct_reser') is-invalid @enderror" id="autoproduct_reser" name="autoproduct_reser" type="text" placeholder="" value="{{ old('autoproduct_reser', $autoproduct->autoproduct_reser) }}" autocomplete="off"/>
                                @error('autoproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_origin">Ex Station</label>
                                <input class="form-control form-control-solid @error('autoproduct_origin') is-invalid @enderror" id="autoproduct_origin" name="autoproduct_origin" type="text" placeholder="" value="{{ old('autoproduct_origin', $autoproduct->autoproduct_origin) }}" autocomplete="off"/>
                                @error('autoproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('autoproduct_sdvin') is-invalid @enderror" id="autoproduct_sdvin" name="autoproduct_sdvin" type="text" placeholder="" value="{{ old('autoproduct_sdvin', $autoproduct->autoproduct_sdvin) }}" autocomplete="off"/>
                                @error('autoproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('autoproduct_sdvout') is-invalid @enderror" id="autoproduct_sdvout" name="autoproduct_sdvout" type="text" placeholder="" value="{{ old('autoproduct_sdvout', $autoproduct->autoproduct_sdvout) }}" autocomplete="off"/>
                                @error('autoproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('autoproduct_station') is-invalid @enderror" id="autoproduct_station" name="autoproduct_station" type="text" placeholder="" value="{{ old('autoproduct_station', $autoproduct->autoproduct_station) }}" autocomplete="off"/>
                                @error('autoproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('autoproduct_requestor') is-invalid @enderror" id="autoproduct_requestor" name="autoproduct_requestor" type="text" placeholder="" value="{{ old('autoproduct_requestor', $autoproduct->autoproduct_requestor) }}" autocomplete="off"/>
                                @error('autoproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('autoproduct_project') is-invalid @enderror" id="autoproduct_project" name="autoproduct_project" type="text" placeholder="" value="{{ old('autoproduct_project', $autoproduct->autoproduct_project) }}" autocomplete="off"/>
                                @error('autoproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autoproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_dateout') is-invalid @enderror" name="autoproduct_dateout" id="autoproduct_dateout" type="date" value="{{ old('autoproduct_dateout', $autoproduct->autoproduct_dateout) }}" autocomplete="off">
                                @error('autoproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autoproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_dateoffshore') is-invalid @enderror" name="autoproduct_dateoffshore" id="autoproduct_dateoffshore" type="date" value="{{ old('autoproduct_dateoffshore', $autoproduct->autoproduct_dateoffshore) }}" autocomplete="off">
                                @error('autoproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('autoproduct_tfoffshore') is-invalid @enderror" id="autoproduct_tfoffshore" name="autoproduct_tfoffshore" type="text" placeholder="" value="{{ old('autoproduct_tfoffshore', $autoproduct->autoproduct_tfoffshore) }}" autocomplete="off"/>
                                @error('autoproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('autoproduct_curloc') is-invalid @enderror" id="autoproduct_curloc" name="autoproduct_curloc" type="text" placeholder="" value="{{ old('autoproduct_curloc', $autoproduct->autoproduct_curloc) }}" autocomplete="off"/>
                                @error('autoproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockIn) -->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="autoproduct_stockin">Stock In</label>
                                    <input class="form-control form-control-solid @error('autoproduct_stockin') is-invalid @enderror" id="autoproduct_stockin" name="autoproduct_stockin" type="text" placeholder="" value="{{ old('autoproduct_stockin', $autoproduct->autoproduct_stockin) }}" autocomplete="off"/>
                                    @error('autoproduct_stockin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('autoproduct_docin') is-invalid @enderror" type="file"  id="autoproduct_docin" name="autoproduct_docin" accept=".pdf,.doc,.docx">
                                @error('autoproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('autoproduct_stockout') is-invalid @enderror" id="autoproduct_stockout" name="autoproduct_stockout" type="text" placeholder="" value="{{ old('autoproduct_stockout', $autoproduct->autoproduct_stockout) }}" autocomplete="off"/>
                                @error('autoproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('autoproduct_docout') is-invalid @enderror" type="file"  id="autoproduct_docout" name="autoproduct_docout" accept=".pdf,.doc,.docx">
                                @error('autoproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_stockqty">Stock Quality</label>
                                <input class="form-control form-control-solid @error('autoproduct_stockqty') is-invalid @enderror" id="autoproduct_stockqty" name="autoproduct_stockqty" type="text" placeholder="" value="{{ old('autoproduct_stockqty', $autoproduct->autoproduct_stockqty) }}" autocomplete="off"/>
                                @error('autoproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('autoproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('autoproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('autoproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('autoproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('autoproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>
                            </div>
                            <!-- Form Group (type of autoproduct UOM) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_uom">UOM</label>
                                <select class="form-select form-control-solid @error('autoproduct_uom') is-invalid @enderror" id="autoproduct_uom" name="autoproduct_uom">
                                    <option selected="" disabled="">Select a uom:</option>
                                    <option value="" {{ old('autoproduct_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                @error('autoproduct_uom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autoproduct_targetpdn">Target PDN</span></label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_targetpdn') is-invalid @enderror" name="autoproduct_targetpdn" id="autoproduct_targetpdn" type="date" value="{{ old('autoproduct_targetpdn', $autoproduct->autoproduct_targetpdn) }}" autocomplete="off" />
                                @error('autoproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('autoproduct_csrelease') is-invalid @enderror" id="autoproduct_csrelease" name="autoproduct_csrelease" type="text" placeholder="" value="{{ old('autoproduct_csrelease', $autoproduct->autoproduct_csrelease) }}" autocomplete="off"/>
                                @error('autoproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('autoproduct_csnumber') is-invalid @enderror" id="autoproduct_csnumber" name="autoproduct_csnumber" type="text" placeholder="" value="{{ old('autoproduct_csnumber', $autoproduct->autoproduct_csnumber) }}" autocomplete="off"/>
                                @error('autoproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('autoproduct_cenumber') is-invalid @enderror" id="autoproduct_cenumber" name="autoproduct_cenumber" type="text" placeholder="" value="{{ old('autoproduct_cenumber', $autoproduct->autoproduct_cenumber) }}" autocomplete="off"/>
                                @error('autoproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('autoproduct_ronumber') is-invalid @enderror" id="autoproduct_ronumber" name="autoproduct_ronumber" type="text" placeholder="" value="{{ old('autoproduct_ronumber', $autoproduct->autoproduct_ronumber) }}" autocomplete="off"/>
                                @error('autoproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autoproduct_startdate">Start Date</span></label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_startdate') is-invalid @enderror" name="autoproduct_startdate" id="autoproduct_startdate" type="date" value="{{ old('autoproduct_startdate', $autoproduct->autoproduct_startdate) }}">
                                @error('autoproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="autoproduct_enddate">End Date</span></label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_enddate') is-invalid @enderror" name="autoproduct_enddate" id="autoproduct_enddate" type="date" value="{{ old('autoproduct_enddate', $autoproduct->autoproduct_enddate) }}">
                                @error('autoproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('autoproduct_price') is-invalid @enderror" id="autoproduct_price" name="autoproduct_price" type="text" placeholder="" value="{{ old('autoproduct_price', $autoproduct->autoproduct_price) }}" autocomplete="off"/>
                                @error('autoproduct_price')
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
                                    var productPriceInput = document.getElementById('autoproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('autoproduct_price').value;
                                    document.getElementById('autoproduct_price').value = formatRupiah(initialValue);
                                </script>         
                            <!-- Form Group (autoproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('autoproduct_remark') is-invalid @enderror" id="autoproduct_remark" name="autoproduct_remark" type="text" placeholder="" value="{{ old('autoproduct_remark', $autoproduct->autoproduct_remark) }}" autocomplete="off"/>
                                @error('autoproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        </div>
                        
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('autoproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: autoproduct Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
