@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Details Valve
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Valve</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
        <div class="row">
            <div class="col-xl-4">
                <!-- Add a "Download PDF" button -->
                    {{-- <a class="btn btn-success" href="{{ route('download-pdf') }}">Download PDF</a> --}}
                    {{-- <a href="{{ url('download-show-pdf') }}" target="_blank">
                        <button class="btn btn-success">Download PDF</button>
                    </a> --}}
                    <a class="btn btn-success" href="{{ route('download-pdf', ['id' => $product->id]) }}">Download PDF</a>
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Valve Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset($product->product_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>
                
            <div class="col-xl-8">
                <!-- BEGIN: Product Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Valve Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product code) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Valve code</label>
                                <div class="form-control form-control-solid">{{ $product->product_code  }}</div>
                            </div>
                            <!-- Form Group (type of product unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: Product Code -->

                <!-- BEGIN: Product Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        Valve Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (product status) -->
                            <div class="col-md-6"> 
                                <label class="small mb-1" for="product_status">Status</label>
                                @if ($product->product_status)
                                <div class="form-control form-control-solid">{{ $product->product_status }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_assetID">Old ID</label>
                                @if ($product->product_assetID)
                                <div class="form-control form-control-solid">{{ $product->product_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>                            
                            <!-- Form Group (product new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_newassetID">New ID</label>
                                @if ($product->product_newassetID)
                                <div class="form-control form-control-solid">{{ $product->product_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>          
                            <!-- Form Group (product Equipment) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_equip">Equipment</label>
                                @if ($product->product_equip)
                                <div class="form-control form-control-solid">{{ $product->product_equip }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (type of product type) -->
                             <div class="col-md-6"> 
                                <label class="small mb-1" for="product_type">Valve Type</label>
                                @if ($product->product_type)
                                <div class="form-control form-control-solid">{{ $product->product_type }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product end connection) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_end">End Connection</label>
                                @if ($product->end)
                                <div class="form-control form-control-solid">{{ $product->product_end }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (type of product size) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_size">Valve Size</label>
                                @if ($product->product_size)
                                <div class="form-control form-control-solid">{{ $product->product_size }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product rating) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_rating">Valve Rating</label>
                                @if ($product->product_rating)
                                <div class="form-control form-control-solid">{{ $product->product_rating }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_brand">Valve Brand</label>
                                @if ($product->product_brand)
                                <div class="form-control form-control-solid">{{ $product->product_brand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product valve model) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_valvemodel">Valve Model</label>
                                @if ($product->product_valvemodel)
                                <div class="form-control form-control-solid">{{ $product->product_valvemodel }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (product serial number) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="product_serial">Serial Number</label>
                                @if ($product->product_serial)
                                <div class="form-control form-control-solid">{{ $product->product_serial }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product valve condition) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_condi">Valve Condition</label>
                                @if ($product->product_condi)
                                    <div class="form-control form-control-solid">{{ $product->product_condi }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_actbrand">Actuator Brand</label>
                                @if ($product->product_actbrand)
                                    <div class="form-control form-control-solid">{{ $product->product_actbrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_actsize">Actuator Size</label>
                                @if ($product->product_actsize)
                                    <div class="form-control form-control-solid">{{ $product->product_actsize }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_fail">Fail</label>
                                @if ($product->product_fail)
                                    <div class="form-control form-control-solid">{{ $product->product_fail }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_actcond">Actuator Condition</label>
                                @if ($product->product_actcond)
                                    <div class="form-control form-control-solid">{{ $product->product_actcond }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_posbrand">Positioner Brand</label>
                                @if ($product->product_posbrand)
                                    <div class="form-control form-control-solid">{{ $product->product_posbrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_posmodel">Positioner Model</label>
                                @if ($product->product_posmodel)
                                    <div class="form-control form-control-solid">{{ $product->product_posmodel }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product Input Signal) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_inputsignal">Input Signal</label>
                                @if ($product->product_inputsignal)
                                    <div class="form-control form-control-solid">{{ $product->product_inputsignal }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_poscond">Positioner Condition</label>
                                @if ($product->product_poscond)
                                    <div class="form-control form-control-solid">{{ $product->product_poscond }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of product Other Accessories) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_other">Other Accessories</label>
                                @if ($product->product_other)
                                    <div class="form-control form-control-solid">{{ $product->product_other }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('product_datein') is-invalid @enderror"
                                       name="product_datein" id="product_datein" type="date" value="{{ old('product_datein', $product->product_datein) }}">
                                @error('product_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_transfer">Material Transfer</label>
                                @if ($product->product_transfer)
                                    <div class="form-control form-control-solid">{{ $product->product_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_reser">Reservation Number</label>
                                @if ($product->product_reser)
                                    <div class="form-control form-control-solid">{{ $product->product_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_origin">Ex Station</label>
                                @if ($product->product_origin)
                                    <div class="form-control form-control-solid">{{ $product->product_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_sdvin">SDV In</label>
                                @if ($product->product_sdvin)
                                    <div class="form-control form-control-solid">{{ $product->product_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_sdvout">SDV Out</label>
                                @if ($product->product_sdvout)
                                    <div class="form-control form-control-solid">{{ $product->product_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_station">Station</label>
                                @if ($product->product_station)
                                    <div class="form-control form-control-solid">{{ $product->product_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_requestor">Requestor</label>
                                @if ($product->product_requestor)
                                    <div class="form-control form-control-solid">{{ $product->product_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_project">Project</label>
                                @if ($product->product_project)
                                    <div class="form-control form-control-solid">{{ $product->product_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product dateout) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('product_dateout') is-invalid @enderror"
                                       name="product_dateout" id="product_dateout" type="date" value="{{ old('product_dateout', $product->product_dateout) }}">
                                @error('product_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('product_dateoffshore') is-invalid @enderror"
                                name="product_dateoffshore" id="product_dateoffshore" type="date" value="{{ old('product_dateoffshore', $product->product_dateoffshore) }}">
                                @error('product_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_tfoffshore">Material transfer to offshore</label>
                                @if ($product->product_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $product->product_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (product curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_curloc">Current Location</label>
                                @if ($product->product_curloc)
                                    <div class="form-control form-control-solid">{{ $product->product_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_stockin">Stock In</label>
                                <div class="form-control form-control-solid">{{ $product->product_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_stockout">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $product->product_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1" >DOC IN </label>
                                @if($product->product_docin)
                                    <a href="{{ asset($product->product_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($product->product_docout)
                                    <a href="{{ asset($product->product_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (stockqty) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_stockqty">Stock Quantity</label>
                                <div class="form-control form-control-solid">{{ $product->product_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_uom">UOM</label>
                                @if ($product->product_uom)
                                    <div class="form-control form-control-solid">{{ $product->product_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (targetpdn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_targetpdn">TARGET PDN</label>
                                @if ($product->product_targetpdn)
                                    <div class="form-control form-control-solid">{{ $product->product_targetpdn }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_csrelease">CS Release</label>
                                @if ($product->product_csrelease)
                                    <div class="form-control form-control-solid">{{ $product->product_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_csnumber">CS Number</label>
                                @if ($product->product_csnumber)
                                    <div class="form-control form-control-solid">{{ $product->product_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_cenumber">CE Number</label>
                               @if ($product->product_cenumber)
                                    <div class="form-control form-control-solid">{{ $product->product_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_ronumber">RO Number</label>
                                @if ($product->product_ronumber)
                                    <div class="form-control form-control-solid">{{ $product->product_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('product_startdate') is-invalid @enderror"
                                           name="product_startdate" id="product_startdate" type="date" value="{{ old('product_startdate', $product->product_startdate) }}">
                                    @error('product_startdate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('product_enddate') is-invalid @enderror"
                                           name="product_enddate" id="product_enddate" type="date" value="{{ old('product_enddate', $product->product_enddate) }}">
                                    @error('product_enddate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <!-- Form Group (price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_price">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $product->product_price }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_remark">REMARK</label>
                                @if ($product->product_remark)
                                    <div class="form-control form-control-solid">{{ $product->product_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
