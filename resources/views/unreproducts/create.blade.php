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
                        Add Unrepairable Asset
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('unreproducts.index') }}">Unrepairable Asset</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('unreproducts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Unrepairable Asset Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset('aassets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('unreproduct_image') is-invalid @enderror" type="file"  id="image" name="unreproduct_image" accept="image/*" onchange="previewImage();">
                        @error('unreproduct_image')
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
                        Unrepairable Asset Details
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (unreproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('unreproduct_assetID') is-invalid @enderror" id="unreproduct_assetID" name="unreproduct_assetID" type="text" placeholder="" value="{{ old('unreproduct_assetID') }}" autocomplete="off"/>
                                @error('unreproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('unreproduct_newassetID') is-invalid @enderror" id="unreproduct_newassetID" name="unreproduct_newassetID" type="text" placeholder="" value="{{ old('unreproduct_newassetID') }}" autocomplete="off"/>
                                @error('unreproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (unreproduct Desc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_desc">Description</label>
                                <input class="form-control form-control-solid @error('unreproduct_desc') is-invalid @enderror" id="unreproduct_desc" name="unreproduct_desc" type="text" placeholder="" value="{{ old('unreproduct_desc') }}" autocomplete="off"/>
                                @error('unreproduct_desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{-- <!-- Form Group (unreproduct serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('unreproduct_serial') is-invalid @enderror" id="unreproduct_serial" name="unreproduct_serial" type="text" placeholder="" value="{{ old('unreproduct_serial') }}" autocomplete="off"/>
                                @error('unreproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (unreproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_transfer">Material Transfer </label>
                                <input class="form-control form-control-solid @error('unreproduct_transfer') is-invalid @enderror" id="unreproduct_transfer" name="unreproduct_transfer" type="text" placeholder="" value="{{ old('unreproduct_transfer') }}" autocomplete="off"/>
                                @error('unreproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('unreproduct_reser') is-invalid @enderror" id="unreproduct_reser" name="unreproduct_reser" type="text" placeholder="" value="{{ old('unreproduct_reser') }}" autocomplete="off"/>
                                @error('unreproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <!-- Form Group (unreproduct origin) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_origin">Ex Station </label>
                                <input class="form-control form-control-solid @error('unreproduct_origin') is-invalid @enderror" id="unreproduct_origin" name="unreproduct_origin" type="text" placeholder="" value="{{ old('unreproduct_origin') }}" autocomplete="off"/>
                                @error('unreproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('unreproduct_sdvin') is-invalid @enderror" id="unreproduct_sdvin" name="unreproduct_sdvin" type="text" placeholder="" value="{{ old('unreproduct_sdvin') }}" autocomplete="off"/>
                                @error('unreproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('unreproduct_sdvout') is-invalid @enderror" id="unreproduct_sdvout" name="unreproduct_sdvout" type="text" placeholder="" value="{{ old('unreproduct_sdvout') }}" autocomplete="off"/>
                                @error('unreproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('unreproduct_station') is-invalid @enderror" id="unreproduct_station" name="unreproduct_station" type="text" placeholder="" value="{{ old('unreproduct_station') }}" autocomplete="off"/>
                                @error('unreproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('unreproduct_requestor') is-invalid @enderror" id="unreproduct_requestor" name="unreproduct_requestor" type="text" placeholder="" value="{{ old('unreproduct_requestor') }}" autocomplete="off"/>
                                @error('unreproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('unreproduct_project') is-invalid @enderror" id="unreproduct_project" name="unreproduct_project" type="text" placeholder="" value="{{ old('unreproduct_project') }}" autocomplete="off"/>
                                @error('unreproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('unreproduct_datein') is-invalid @enderror" name="unreproduct_datein" id="unreproduct_datein" type="date" value="{{ old('unreproduct_datein') }}" autocomplete="off" />
                                @error('unreproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('unreproduct_dateout') is-invalid @enderror" name="unreproduct_dateout" id="unreproduct_dateout" type="date" value="{{ old('unreproduct_dateout') }}" autocomplete="off" />
                                @error('unreproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('unreproduct_dateoffshore') is-invalid @enderror" name="unreproduct_dateoffshore" id="unreproduct_dateoffshore" type="date" value="{{ old('unreproduct_dateoffshore') }}" autocomplete="off"/>
                                @error('unreproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct transfer offshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('unreproduct_tfoffshore') is-invalid @enderror" id="unreproduct_tfoffshore" name="unreproduct_tfoffshore" type="text" placeholder="" value="{{ old('unreproduct_tfoffshore') }}" autocomplete="off"/>
                                @error('unreproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('unreproduct_curloc') is-invalid @enderror" id="unreproduct_curloc" name="unreproduct_curloc" type="text" placeholder="" value="{{ old('unreproduct_curloc') }}" autocomplete="off"/>
                                @error('unreproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('unreproduct_targetpdn') is-invalid @enderror" name="unreproduct_targetpdn" id="unreproduct_targetpdn" type="date" value="{{ old('unreproduct_targetpdn') }}" autocomplete="off"/>
                                @error('unreproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>          
                             <!-- Form Group (type of unreproduct UOM) -->
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="unreproduct_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('unreproduct_uom') is-invalid @enderror" id="unreproduct_uom" name="unreproduct_uom" type="text" placeholder="" value="{{ old('unreproduct_uom') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a UOM:</option>
                                    <option value="" {{ old('unreproduct_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('unreproduct_uom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>              
                            <!-- Form Group (stockIn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_stockin">Stock In</label>
                                <input class="form-control form-control-solid @error('unreproduct_stockin') is-invalid @enderror" id="unreproduct_stockin" name="unreproduct_stockin" type="text" placeholder="" value="{{ old('unreproduct_stockin') }}" autocomplete="off" />
                                @error('unreproduct_stockin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('unreproduct_docin') is-invalid @enderror" type="file"  id="unreproduct_docin" name="unreproduct_docin" accept=".pdf,.doc,.docx">
                                @error('unreproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('unreproduct_stockout') is-invalid @enderror" id="unreproduct_stockout" name="unreproduct_stockout" type="text" placeholder="" value="{{ old('unreproduct_stockout') }}" autocomplete="off" />
                                @error('unreproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC</div>
                                <input class="form-control form-control-solid mb-2 @error('unreproduct_docout') is-invalid @enderror" type="file"  id="unreproduct_docout" name="unreproduct_docout" accept=".pdf,.doc,.docx">
                                @error('unreproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_stockqty">Stock Quality</label>
                                <input class="form-control form-control-solid @error('unreproduct_stockqty') is-invalid @enderror" id="unreproduct_stockqty" name="unreproduct_stockqty" type="text" placeholder="" value="{{ old('unreproduct_stockqty') }}" autocomplete="off" />
                                @error('unreproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('unreproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('unreproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('unreproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('unreproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('unreproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>                                
                            </div>
                            <!-- Form Group (unreproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('unreproduct_csrelease') is-invalid @enderror" id="unreproduct_csrelease" name="unreproduct_csrelease" type="text" placeholder="" value="{{ old('unreproduct_csrelease') }}" autocomplete="off"/>
                                @error('unreproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('unreproduct_csnumber') is-invalid @enderror" id="unreproduct_csnumber" name="unreproduct_csnumber" type="text" placeholder="" value="{{ old('unreproduct_csnumber') }}" autocomplete="off"/>
                                @error('unreproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('unreproduct_cenumber') is-invalid @enderror" id="unreproduct_cenumber" name="unreproduct_cenumber" type="text" placeholder="" value="{{ old('unreproduct_cenumber') }}" autocomplete="off"/>
                                @error('unreproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (unreproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('unreproduct_ronumber') is-invalid @enderror" id="unreproduct_ronumber" name="unreproduct_ronumber" type="text" placeholder="" value="{{ old('unreproduct_ronumber') }}" autocomplete="off"/>
                                @error('unreproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('unreproduct_startdate') is-invalid @enderror" name="unreproduct_startdate" id="unreproduct_startdate" type="date" value="{{ old('unreproduct_startdate') }}" autocomplete="off"/>
                                @error('unreproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('unreproduct_enddate') is-invalid @enderror" name="unreproduct_enddate" id="unreproduct_enddate" type="date" value="{{ old('unreproduct_enddate') }}" autocomplete="off"/>
                                @error('unreproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="unreproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('unreproduct_price') is-invalid @enderror" name="unreproduct_price" id="unreproduct_price" type="text" value="{{ old('unreproduct_price') }}" autocomplete="off"/>
                                @error('unreproduct_price')
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
                                    var productPriceInput = document.getElementById('unreproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('unreproduct_price').value;
                                    document.getElementById('unreproduct_price').value = formatRupiah(initialValue);
                                </script> 
                            </div>    
                            <!-- Form Group (status) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="unreproduct_status" >Status</label>
                                    <select class="form-control form-control-solid @error('unreproduct_status') is-invalid @enderror" id="unreproduct_status" name="unreproduct_status" status="text" placeholder="" value="{{ old('unreproduct_status') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a status:</option>
                                    <option value="" {{ old('unreproduct_status') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Incoming</option>
                                        <option>Outgoing</option>
                                        <option>At Workshop</option>
                                    </select>
                                    @error('unreproduct_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>  
                            <!-- Form Group (unreproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('unreproduct_remark') is-invalid @enderror" id="unreproduct_remark" name="unreproduct_remark" type="text" placeholder="" value="{{ old('unreproduct_remark') }}" autocomplete="off"/>
                                @error('unreproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('unreproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
