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
                        Add Spare Parts
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('partsproducts.index') }}">Spare Parts</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('partsproducts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Spare Parts Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset('aassets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('partsproduct_image') is-invalid @enderror" type="file"  id="image" name="partsproduct_image" accept="image/*" onchange="previewImage();">
                        @error('partsproduct_image')
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
                        Spare Parts Details
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (partsproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('partsproduct_assetID') is-invalid @enderror" id="partsproduct_assetID" name="partsproduct_assetID" type="text" placeholder="" value="{{ old('partsproduct_assetID') }}" autocomplete="off"/>
                                @error('partsproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('partsproduct_newassetID') is-invalid @enderror" id="partsproduct_newassetID" name="partsproduct_newassetID" type="text" placeholder="" value="{{ old('partsproduct_newassetID') }}" autocomplete="off"/>
                                @error('partsproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (partsproduct Desc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_desc">Description <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('partsproduct_desc') is-invalid @enderror" id="partsproduct_desc" name="partsproduct_desc" type="text" placeholder="" value="{{ old('partsproduct_desc') }}" autocomplete="off"/>
                                @error('partsproduct_desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct partnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_partnumber">Part Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('partsproduct_partnumber') is-invalid @enderror" id="partsproduct_partnumber" name="partsproduct_partnumber" type="text" placeholder="" value="{{ old('partsproduct_partnumber') }}" autocomplete="off"/>
                                @error('partsproduct_partnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{-- <!-- Form Group (partsproduct serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_serial">Serial Number <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('partsproduct_serial') is-invalid @enderror" id="partsproduct_serial" name="partsproduct_serial" type="text" placeholder="" value="{{ old('partsproduct_serial') }}" autocomplete="off"/>
                                @error('partsproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <!-- Form Group (partsproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_transfer">Material Transfer </label>
                                <input class="form-control form-control-solid @error('partsproduct_transfer') is-invalid @enderror" id="partsproduct_transfer" name="partsproduct_transfer" type="text" placeholder="" value="{{ old('partsproduct_transfer') }}" autocomplete="off"/>
                                @error('partsproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('partsproduct_reser') is-invalid @enderror" id="partsproduct_reser" name="partsproduct_reser" type="text" placeholder="" value="{{ old('partsproduct_reser') }}" autocomplete="off"/>
                                @error('partsproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <!-- Form Group (partsproduct origin) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_origin">Ex Station </label>
                                <input class="form-control form-control-solid @error('partsproduct_origin') is-invalid @enderror" id="partsproduct_origin" name="partsproduct_origin" type="text" placeholder="" value="{{ old('partsproduct_origin') }}" autocomplete="off"/>
                                @error('partsproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('partsproduct_sdvin') is-invalid @enderror" id="partsproduct_sdvin" name="partsproduct_sdvin" type="text" placeholder="" value="{{ old('partsproduct_sdvin') }}" autocomplete="off"/>
                                @error('partsproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('partsproduct_sdvout') is-invalid @enderror" id="partsproduct_sdvout" name="partsproduct_sdvout" type="text" placeholder="" value="{{ old('partsproduct_sdvout') }}" autocomplete="off"/>
                                @error('partsproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('partsproduct_station') is-invalid @enderror" id="partsproduct_station" name="partsproduct_station" type="text" placeholder="" value="{{ old('partsproduct_station') }}" autocomplete="off"/>
                                @error('partsproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('partsproduct_requestor') is-invalid @enderror" id="partsproduct_requestor" name="partsproduct_requestor" type="text" placeholder="" value="{{ old('partsproduct_requestor') }}" autocomplete="off"/>
                                @error('partsproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('partsproduct_project') is-invalid @enderror" id="partsproduct_project" name="partsproduct_project" type="text" placeholder="" value="{{ old('partsproduct_project') }}" autocomplete="off"/>
                                @error('partsproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_datein') is-invalid @enderror" name="partsproduct_datein" id="partsproduct_datein" type="date" value="{{ old('partsproduct_datein') }}" autocomplete="off" />
                                @error('partsproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_dateout') is-invalid @enderror" name="partsproduct_dateout" id="partsproduct_dateout" type="date" value="{{ old('partsproduct_dateout') }}" autocomplete="off" />
                                @error('partsproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_dateoffshore') is-invalid @enderror" name="partsproduct_dateoffshore" id="partsproduct_dateoffshore" type="date" value="{{ old('partsproduct_dateoffshore') }}" autocomplete="off" />
                                @error('partsproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct transfer offshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('partsproduct_tfoffshore') is-invalid @enderror" id="partsproduct_tfoffshore" name="partsproduct_tfoffshore" type="text" placeholder="" value="{{ old('partsproduct_tfoffshore') }}" autocomplete="off"/>
                                @error('partsproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('partsproduct_curloc') is-invalid @enderror" id="partsproduct_curloc" name="partsproduct_curloc" type="text" placeholder="" value="{{ old('partsproduct_curloc') }}" autocomplete="off"/>
                                @error('partsproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_targetpdn') is-invalid @enderror" name="partsproduct_targetpdn" id="partsproduct_targetpdn" type="date" value="{{ old('partsproduct_targetpdn') }}" autocomplete="off" />
                                @error('partsproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>                        
                            <!-- Form Group (stockIn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_stockin">Stock In<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('partsproduct_stockin') is-invalid @enderror" id="partsproduct_stockin" name="partsproduct_stockin" type="text" placeholder="" value="{{ old('partsproduct_stockin') }}" autocomplete="off" />
                                @error('partsproduct_stockin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('partsproduct_docin') is-invalid @enderror" type="file"  id="partsproduct_docin" name="partsproduct_docin" accept=".pdf,.doc,.docx">
                                @error('partsproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('partsproduct_stockout') is-invalid @enderror" id="partsproduct_stockout" name="partsproduct_stockout" type="text" placeholder="" value="{{ old('partsproduct_stockout') }}" autocomplete="off"/>
                                @error('partsproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('partsproduct_docout') is-invalid @enderror" type="file"  id="partsproduct_docout" name="partsproduct_docout" accept=".pdf,.doc,.docx">
                                @error('partsproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_stockqty">Stock Quality<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('partsproduct_stockqty') is-invalid @enderror" id="partsproduct_stockqty" name="partsproduct_stockqty" type="text" placeholder="" value="{{ old('partsproduct_stockqty') }}" autocomplete="off"/>
                                @error('partsproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('partsproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('partsproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('partsproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('partsproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('partsproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>                                
                            </div>
                            <!-- Form Group (type of partsproduct UOM) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="partsproduct_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('partsproduct_uom') is-invalid @enderror" id="partsproduct_uom" name="partsproduct_uom" type="text" placeholder="" value="{{ old('partsproduct_uom') }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a UOM:</option>
                                    <option value="" {{ old('partsproduct_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('partsproduct_uom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (partsproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('partsproduct_csrelease') is-invalid @enderror" id="partsproduct_csrelease" name="partsproduct_csrelease" type="text" placeholder="" value="{{ old('partsproduct_csrelease') }}" autocomplete="off"/>
                                @error('partsproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('partsproduct_csnumber') is-invalid @enderror" id="partsproduct_csnumber" name="partsproduct_csnumber" type="text" placeholder="" value="{{ old('partsproduct_csnumber') }}" autocomplete="off"/>
                                @error('partsproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('partsproduct_cenumber') is-invalid @enderror" id="partsproduct_cenumber" name="partsproduct_cenumber" type="text" placeholder="" value="{{ old('partsproduct_cenumber') }}" autocomplete="off"/>
                                @error('partsproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('partsproduct_ronumber') is-invalid @enderror" id="partsproduct_ronumber" name="partsproduct_ronumber" type="text" placeholder="" value="{{ old('partsproduct_ronumber') }}" autocomplete="off"/>
                                @error('partsproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_startdate') is-invalid @enderror" name="partsproduct_startdate" id="partsproduct_startdate" type="date" value="{{ old('partsproduct_startdate') }}" autocomplete="off" />
                                @error('partsproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_enddate') is-invalid @enderror" name="partsproduct_enddate" id="partsproduct_enddate" type="date" value="{{ old('partsproduct_enddate') }}" autocomplete="off" />
                                @error('partsproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="partsproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('partsproduct_price') is-invalid @enderror" name="partsproduct_price" id="partsproduct_price" type="text" value="{{ old('partsproduct_price') }}" autocomplete="off"/>
                                @error('partsproduct_price')
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
                                    var productPriceInput = document.getElementById('partsproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('partsproduct_price').value;
                                    document.getElementById('product_price').value = formatRupiah(initialValue);
                                </script> 
                            </div>    
                            <!-- Form Group (partsproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('partsproduct_remark') is-invalid @enderror" id="partsproduct_remark" name="partsproduct_remark" type="text" placeholder="" value="{{ old('partsproduct_remark') }}" autocomplete="off"/>
                                @error('partsproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('partsproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
