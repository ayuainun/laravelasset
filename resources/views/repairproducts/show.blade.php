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
                    <li class="breadcrumb-item"><a href="{{ route('repairproducts.index') }}">Valve</a></li>
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
                {{-- <div class="col-md-6">
                    <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="{{ route('repairproducts.pdf', ['id' => $repairproduct->id]) }}" target="_blank">Print PDF</a></button>
                </div> --}}
                <!-- repairproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Valve Image</div>
                    <div class="card-body text-center">
                        <!-- repairproduct image -->
                        <img class="img-account-profile mb-2" src="{{ asset($repairproduct->repairproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: repairproduct Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Valve Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of repairproduct code) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Valve code</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_code  }}</div>
                            </div>
                            <!-- Form Group (type of repairproduct unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: repairproduct Code -->

                <!-- BEGIN: repairproduct Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        Valve Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (product status) -->
                            <div class="col-md-6"> 
                                <label class="small mb-1" for="repairproduct_status">Status</label>
                                @if ($repairproduct->repairproduct_status)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_status }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_assetID">Old ID</label>
                                @if ($repairproduct->repairproduct_assetID)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (repairproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_newassetID">New ID</label>
                                @if ($repairproduct->repairproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct Equipment) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_equip">Equipment</label>
                                @if ($repairproduct->repairproduct_equip)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_equip }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (type of repairproduct type) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_unit">Valve Type</label>
                                @if ($repairproduct->repairproduct_unit)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_unit }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct end connection) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_end">End Connection</label>
                                @if ($repairproduct->end)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_end }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (type of repairproduct size) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_size">Valve Size</label>
                                @if ($repairproduct->repairproduct_size)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_size }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct rating) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_rating">Valve Rating</label>
                                @if ($repairproduct->repairproduct_rating)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_rating }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_brand">Valve Brand</label>
                                @if ($repairproduct->repairproduct_brand)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_brand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct valve model) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_valvemodel">Valve Model</label>
                                @if ($repairproduct->repairproduct_valvemodel)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_valvemodel }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (repairproduct serial number) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_serial">Serial Number</label>
                                @if ($repairproduct->repairproduct_serial)
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_serial }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct valve condition) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_condi">Valve Condition</label>
                                @if ($repairproduct->repairproduct_condi)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_condi }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct actbrand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_actbrand">Actuator Brand</label>
                                @if ($repairproduct->repairproduct_actbrand)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_actbrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct actsize) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_actsize">Actuator Size</label>
                                @if ($repairproduct->repairproduct_actsize)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_actsize }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct fail) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_fail">Fail</label>
                                @if ($repairproduct->repairproduct_fail)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_fail }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct actcond) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_actcond">Actuator Condition</label>
                                @if ($repairproduct->repairproduct_actcond)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_actcond }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct posbrand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_posbrand">Positioner Brand</label>
                                @if ($repairproduct->repairproduct_posbrand)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_posbrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct posmodel) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_posmodel">Positioner Model</label>
                                @if ($repairproduct->repairproduct_posmodel)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_posmodel }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct Input Signal) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_inputsignal">Input Signal</label>
                                @if ($repairproduct->repairproduct_inputsignal)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_inputsignal }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct poscond) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_poscond">Positioner Condition</label>
                                @if ($repairproduct->repairproduct_poscond)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_poscond }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of repairproduct Other Accessories) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_other">Other Accessories</label>
                                @if ($repairproduct->repairproduct_other)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_other }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date In</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_datein }}</div>
                            </div>
                            <!-- Form Group (repairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_transfer">Material Transfer</label>
                                @if ($repairproduct->repairproduct_transfer)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_reser">Reservation Number</label>
                                @if ($repairproduct->repairproduct_reser)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_origin">Ex Station</label>
                                @if ($repairproduct->repairproduct_origin)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_sdvin">SDV In</label>
                                @if ($repairproduct->repairproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_sdvout">SDV Out</label>
                                @if ($repairproduct->repairproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_station">Station</label>
                                @if ($repairproduct->repairproduct_station)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_requestor">Requestor</label>
                                @if ($repairproduct->repairproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_project">Project</label>
                                @if ($repairproduct->repairproduct_project)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_dateout }}</div>
                            </div>
                            <!-- Form Group (repairproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_dateoffshore }}</div>
                            </div>
                            <!-- Form Group (repairproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($repairproduct->repairproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (repairproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_curloc">Current Location</label>
                                @if ($repairproduct->repairproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock In</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Doc In</label>
                                @if($repairproduct->repairproduct_docin)
                                    <a href="{{ asset($repairproduct->repairproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Doc Out</label>
                                @if($repairproduct->repairproduct_docout)
                                    <a href="{{ asset($repairproduct->repairproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (stockqty) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Quantity</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_uom">UOM</label>
                                @if ($repairproduct->repairproduct_uom)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (targetpdn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_targetpdn">TARGET PDN</label>
                                @if ($repairproduct->repairproduct_targetpdn)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_targetpdn }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_csrelease">CS Release</label>
                                @if ($repairproduct->repairproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_csnumber">CS Number</label>
                                @if ($repairproduct->repairproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_cenumber">CE Number</label>
                               @if ($repairproduct->repairproduct_cenumber)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_ronumber">RO Number</label>
                                @if ($repairproduct->repairproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_startdate  }}</div>
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_enddate  }}</div>
                            </div>
                            <!-- Form Group (price) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_price  }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                @if ($repairproduct->repairproduct_remark)
                                    <div class="form-control form-control-solid">{{ $repairproduct->repairproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('repairproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: repairproduct Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
