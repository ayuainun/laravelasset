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
                        Add Bulk Material
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bulkproducts.index') }}">Bulk Material</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('bulkproducts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- bulkproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Bulk Material Image</div>
                    <div class="card-body text-center">
                        <!-- bulkproduct image -->
                        <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- bulkproduct image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- bulkproduct image input -->
                        <input class="form-control form-control-solid mb-2 @error('bulkproduct_image') is-invalid @enderror" type="file"  id="image" name="bulkproduct_image" accept="image/*" onchange="previewImage();">
                        @error('bulkproduct_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: bulkproduct Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Valve Details
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (bulkproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('bulkproduct_assetID') is-invalid @enderror" id="bulkproduct_assetID" name="bulkproduct_assetID" type="text" placeholder="" value="{{ old('bulkproduct_assetID') }}" autocomplete="off"/>
                                @error('bulkproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('bulkproduct_newassetID') is-invalid @enderror" id="bulkproduct_newassetID" name="bulkproduct_newassetID" type="text" placeholder="" value="{{ old('bulkproduct_newassetID') }}" autocomplete="off"/>
                                @error('bulkproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of bulkproduct type) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_bulktype">Bulk Material Type<span class="text-danger">*</span></label>
                                <select class="form-control form-control-solid @error('bulkproduct_bulktype') is-invalid @enderror" id="bulkproduct_bulktype" name="bulkproduct_bulktype" type="text" placeholder="" value="{{ old('bulkproduct_bulktype') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a type:</option>
                                    <option value="" {{ old('bulkproduct_bulktype') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Bolt</option>
                                        <option>Connector</option>
                                        <option>Gasket</option>
                                        <option>Nut</option>
                                        <option>Pipe</option>
                                        <option>Tubing</option>
                                    </select>
                                    @error('bulkproduct_bulktype')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{-- <!-- Form Group (bulkproduct serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('bulkproduct_serial') is-invalid @enderror" id="bulkproduct_serial" name="bulkproduct_serial" type="text" placeholder="" value="{{ old('bulkproduct_serial') }}" autocomplete="off"/>
                                @error('bulkproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="bulkproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_datein') is-invalid @enderror" name="bulkproduct_datein" id="bulkproduct_datein" type="date" value="{{ old('bulkproduct_datein') }}" autocomplete="off"/>
                                @error('bulkproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_transfer">Material Transfer</label>
                                <input class="form-control form-control-solid @error('bulkproduct_transfer') is-invalid @enderror" id="bulkproduct_transfer" name="bulkproduct_transfer" type="text" placeholder="" value="{{ old('bulkproduct_transfer') }}" autocomplete="off"/>
                                @error('bulkproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('bulkproduct_reser') is-invalid @enderror" id="bulkproduct_reser" name="bulkproduct_reser" type="text" placeholder="" value="{{ old('bulkproduct_reser') }}" autocomplete="off"/>
                                @error('bulkproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_origin">Ex Station</label>
                                <input class="form-control form-control-solid @error('bulkproduct_origin') is-invalid @enderror" id="bulkproduct_origin" name="bulkproduct_origin" type="text" placeholder="" value="{{ old('bulkproduct_origin') }}" autocomplete="off"/>
                                @error('bulkproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('bulkproduct_sdvin') is-invalid @enderror" id="bulkproduct_sdvin" name="bulkproduct_sdvin" type="text" placeholder="" value="{{ old('bulkproduct_sdvin') }}" autocomplete="off"/>
                                @error('bulkproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('bulkproduct_sdvout') is-invalid @enderror" id="bulkproduct_sdvout" name="bulkproduct_sdvout" type="text" placeholder="" value="{{ old('bulkproduct_sdvout') }}" autocomplete="off"/>
                                @error('bulkproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('bulkproduct_station') is-invalid @enderror" id="bulkproduct_station" name="bulkproduct_station" type="text" placeholder="" value="{{ old('bulkproduct_station') }}" autocomplete="off"/>
                                @error('bulkproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('bulkproduct_requestor') is-invalid @enderror" id="bulkproduct_requestor" name="bulkproduct_requestor" type="text" placeholder="" value="{{ old('bulkproduct_requestor') }}" autocomplete="off"/>
                                @error('bulkproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('bulkproduct_project') is-invalid @enderror" id="bulkproduct_project" name="bulkproduct_project" type="text" placeholder="" value="{{ old('bulkproduct_project') }}" autocomplete="off"/>
                                @error('bulkproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="bulkproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_dateout') is-invalid @enderror" name="bulkproduct_dateout" id="bulkproduct_dateout" type="date" value="{{ old('bulkproduct_dateout') }}" autocomplete="off"/>
                                @error('bulkproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="bulkproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_dateoffshore') is-invalid @enderror" name="bulkproduct_dateoffshore" id="bulkproduct_dateoffshore" type="date" value="{{ old('bulkproduct_dateoffshore') }}" autocomplete="off"/>
                                @error('bulkproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct transfer offshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('bulkproduct_tfoffshore') is-invalid @enderror" id="bulkproduct_tfoffshore" name="bulkproduct_tfoffshore" type="text" placeholder="" value="{{ old('bulkproduct_tfoffshore') }}" autocomplete="off"/>
                                @error('bulkproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('bulkproduct_curloc') is-invalid @enderror" id="bulkproduct_curloc" name="bulkproduct_curloc" type="text" placeholder="" value="{{ old('bulkproduct_curloc') }}" autocomplete="off"/>
                                @error('bulkproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockIn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_stockin">Stock In<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('bulkproduct_stockin') is-invalid @enderror" id="bulkproduct_stockin" name="bulkproduct_stockin" type="text" placeholder="" value="{{ old('bulkproduct_stockin') }}" autocomplete="off" />
                                @error('bulkproduct_stockin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('bulkproduct_docin') is-invalid @enderror" type="file"  id="bulkproduct_docin" name="bulkproduct_docin" accept=".pdf,.doc,.docx">
                                @error('bulkproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('bulkproduct_stockout') is-invalid @enderror" id="bulkproduct_stockout" name="bulkproduct_stockout" type="text" placeholder="" value="{{ old('bulkproduct_stockout') }}" autocomplete="off" />
                                @error('bulkproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('bulkproduct_docout') is-invalid @enderror" type="file"  id="bulkproduct_docout" name="bulkproduct_docout" accept=".pdf,.doc,.docx">
                                @error('bulkproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_stockqty">Stock Quality<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('bulkproduct_stockqty') is-invalid @enderror" id="bulkproduct_stockqty" name="bulkproduct_stockqty" type="text" placeholder="" value="{{ old('bulkproduct_stockqty') }}" autocomplete="off" />
                                @error('bulkproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('bulkproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('bulkproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('bulkproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('bulkproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('bulkproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>                                
                            </div>
                            <!-- Form Group (type of bulkproduct UOM) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('bulkproduct_uom') is-invalid @enderror" id="bulkproduct_uom" name="bulkproduct_uom" type="text" placeholder="" value="{{ old('bulkproduct_uom') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a UOM:</option>
                                    <option value="" {{ old('bulkproduct_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('bulkproduct_uom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="bulkproduct_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_targetpdn') is-invalid @enderror" name="bulkproduct_targetpdn" id="bulkproduct_targetpdn" type="date" value="{{ old('bulkproduct_targetpdn') }}" autocomplete="off"/>
                                @error('bulkproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('bulkproduct_csrelease') is-invalid @enderror" id="bulkproduct_csrelease" name="bulkproduct_csrelease" type="text" placeholder="" value="{{ old('bulkproduct_csrelease') }}" autocomplete="off"/>
                                @error('bulkproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('bulkproduct_csnumber') is-invalid @enderror" id="bulkproduct_csnumber" name="bulkproduct_csnumber" type="text" placeholder="" value="{{ old('bulkproduct_csnumber') }}" autocomplete="off"/>
                                @error('bulkproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('bulkproduct_cenumber') is-invalid @enderror" id="bulkproduct_cenumber" name="bulkproduct_cenumber" type="text" placeholder="" value="{{ old('bulkproduct_cenumber') }}" autocomplete="off"/>
                                @error('bulkproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('bulkproduct_ronumber') is-invalid @enderror" id="bulkproduct_ronumber" name="bulkproduct_ronumber" type="text" placeholder="" value="{{ old('bulkproduct_ronumber') }}" autocomplete="off"/>
                                @error('bulkproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="bulkproduct_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_startdate') is-invalid @enderror" name="bulkproduct_startdate" id="bulkproduct_startdate" type="date" value="{{ old('bulkproduct_startdate') }}" autocomplete="off"/>
                                @error('bulkproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="bulkproduct_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_enddate') is-invalid @enderror" name="bulkproduct_enddate" id="bulkproduct_enddate" type="date" value="{{ old('bulkproduct_enddate') }}" autocomplete="off"/>
                                @error('bulkproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('bulkproduct_price') is-invalid @enderror" id="bulkproduct_price" name="bulkproduct_price" type="text" placeholder="" value="{{ old('bulkproduct_price') }}" autocomplete="off"/>
                                @error('bulkproduct_price')
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
                                    var productPriceInput = document.getElementById('bulkproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('bulkproduct_price').value;
                                    document.getElementById('product_price').value = formatRupiah(initialValue);
                                </script>      
                            </div>
                            <!-- Form Group (bulkproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('bulkproduct_remark') is-invalid @enderror" id="bulkproduct_remark" name="bulkproduct_remark" type="text" placeholder="" value="{{ old('bulkproduct_remark') }}" autocomplete="off"/>
                                @error('bulkproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('bulkproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: bulkproduct Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
