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
                        Details Unrepairable Asset
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('unreproducts.index') }}">Unrepairable Asset</a></li>
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
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Unrepairable Asset Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset($unreproduct->unreproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Unrepairable Asset Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Unrepairable Asset code</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_code  }}</div>
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
                        Unrepairable Asset Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (unreproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_assetID">Old ID</label>
                                @if ($unreproduct->unreproduct_assetID)
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (unreproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_newassetID">New ID</label>
                                @if ($unreproduct->unreproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (desc of unreproduct ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_desc">Description</label>
                                @if ($unreproduct->unreproduct_desc)
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_desc  }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (number of unreproduct) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_partnumber">Part Number</label>
                                @if ($unreproduct->unreproduct_partnumber)
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_partnumber  }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            {{-- <!-- Form Group (unreproduct serial number) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (unreproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Material Transfer</label>
                                @if ($unreproduct->unreproduct_transfer)
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_reser">Reservation Number</label>
                                @if ($unreproduct->unreproduct_reser)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_origin">Ex Station</label>
                                @if ($unreproduct->unreproduct_origin)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_sdvin">SDV In</label>
                                @if ($unreproduct->unreproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_sdvout">SDV Out</label>
                                @if ($unreproduct->unreproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_station">Station</label>
                                @if ($unreproduct->unreproduct_station)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_requestor">Requestor</label>
                                @if ($unreproduct->unreproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_project">Project</label>
                                @if ($unreproduct->unreproduct_project)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date In</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_datein }}</div>
                            </div>
                            <!-- Form Group (unreproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_dateout }}</div>
                            </div>
                            <!-- Form Group (unreproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_dateoffshore }}</div>
                            </div>
                            <!-- Form Group (unreproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($unreproduct->unreproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (unreproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_curloc">Current Location</label>
                                @if ($unreproduct->unreproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (targetpdn) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_targetpdn">TARGET PDN</label>
                                @if ($unreproduct->unreproduct_targetpdn)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_targetpdn }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                             </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock In</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Doc In</label>
                                @if($unreproduct->unreproduct_docin)
                                    <a href="{{ asset($unreproduct->unreproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Doc Out</label>
                                @if($unreproduct->unreproduct_docout)
                                    <a href="{{ asset($unreproduct->unreproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (stock qty) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Qty</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->uom->uom  }}</div>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                @if ($unreproduct->unreproduct)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_csrelease">CS Release</label>
                                @if ($unreproduct->unreproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_csnumber">CS Number</label>
                                @if ($unreproduct->unreproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_cenumber">CE Number</label>
                               @if ($unreproduct->unreproduct_cenumber)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_ronumber">RO Number</label>
                                @if ($unreproduct->unreproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_startdate  }}</div>
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_enddate  }}</div>
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_price  }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unreproduct_remark">REMARK</label>
                                @if ($unreproduct->unreproduct_remark)
                                    <div class="form-control form-control-solid">{{ $unreproduct->unreproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('unreproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
