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
                        Details Automation
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('autoproducts.index') }}">Automation</a></li>
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
                <!-- autoproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Automation Image</div>
                    <div class="card-body text-center">
                        <!-- autoproduct image -->
                        <img class="img-account-profile mb-2" src="{{ asset($autoproduct->autoproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: autoproduct Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Automation Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of autoproduct code) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Automation code</label>
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_code  }}</div>
                            </div>
                            <!-- Form Group (type of autoproduct unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: autoproduct Code -->

                <!-- BEGIN: autoproduct Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        Automation Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (autoproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_assetID">Old ID</label>
                                @if ($autoproduct->autoproduct_assetID)
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>    
                            <!-- Form Group (autoproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_newassetID">New ID</label>
                                @if ($autoproduct->autoproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>     
                            <!-- Form Group (type of autoproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_brand">Automation Brand</label>
                                @if ($autoproduct->autoproduct_brand)
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_brand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             {{-- <!-- Form Group (autoproduct serial number) -->
                             <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (autoproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_datein') is-invalid @enderror"
                                       name="autoproduct_datein" id="autoproduct_datein" type="date" value="{{ old('autoproduct_datein', $autoproduct->autoproduct_datein) }}">
                                @error('autoproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_tfoffshore">Material Transfer</label>
                                @if ($autoproduct->autoproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_reser">Reservation Number</label>
                                @if ($autoproduct->autoproduct_reser)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_origin">Ex Station</label>
                                @if ($autoproduct->autoproduct_origin)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_sdvin">SDV In</label>
                                @if ($autoproduct->autoproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_sdvout">SDV Out</label>
                                @if ($autoproduct->autoproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_station">Station</label>
                                @if ($autoproduct->autoproduct_station)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_requestor">Requestor</label>
                                @if ($autoproduct->autoproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_project">Project</label>
                                @if ($autoproduct->autoproduct_project)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_dateout') is-invalid @enderror"
                                       name="autoproduct_dateout" id="autoproduct_dateout" type="date" value="{{ old('autoproduct_dateout', $autoproduct->autoproduct_dateout) }}">
                                @error('autoproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_dateoffshore') is-invalid @enderror"
                                name="autoproduct_dateoffshore" id="autoproduct_dateoffshore" type="date" value="{{ old('autoproduct_dateoffshore', $autoproduct->autoproduct_dateoffshore) }}">
                                @error('autoproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autoproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($autoproduct->autoproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autoproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_curloc">Current Location</label>
                                @if ($autoproduct->autoproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_stockin">Stock In</label>
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_stockout">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_stockout  }}</div>
                            </div>
                           <!-- Form Group (doc in) -->
                           <div class="col-md-6">
                                <label class="small mb-1">DOC IN </label>
                                @if($autoproduct->autoproduct_docin)
                                    <a href="{{ asset($autoproduct->autoproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($autoproduct->autoproduct_docout)
                                    <a href="{{ asset($autoproduct->autoproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (stockqty) -->
                            <div class="col-md-6" >
                                <label class="small mb-1" for="autoproduct_stockqty">Stock Quantity</label>
                                <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                <div class="form-control form-control-solid">{{ $autoproduct->uom->uom  }}</div>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_uom">UOM</label>
                                @if ($autoproduct->autoproduct_uom)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (targetpdn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_targetpdn">Target PDN</label>
                                @if ($autoproduct->autoproduct_targetpdn)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_targetpdn }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                                </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_csrelease">CS Release</label>
                                @if ($autoproduct->autoproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_csnumber">CS Number</label>
                                @if ($autoproduct->autoproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_cenumber">CE Number</label>
                                @if ($autoproduct->autoproduct_cenumber)
                                        <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_cenumber }}</div>
                                    @else
                                        <div class="form-control form-control-solid">N/A</div>
                                    @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_ronumber">RO Number</label>
                                @if ($autoproduct->autoproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_startdate') is-invalid @enderror"
                                name="autoproduct_startdate" id="autoproduct_startdate" type="date" value="{{ old('autoproduct_startdate',$autoproduct->autoproduct_startdate) }}">
                                @error('autoproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('autoproduct_enddate') is-invalid @enderror"
                                           name="autoproduct_enddate" id="autoproduct_enddate" type="date" value="{{ old('autoproduct_enddate', $autoproduct->autoproduct_enddate) }}">
                                    @error('autoproduct_enddate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <!-- Form Group (price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_price">Price Repair</label>
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_price }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autoproduct_remark">REMARK</label>
                                @if ($autoproduct->autoproduct_remark)
                                    <div class="form-control form-control-solid">{{ $autoproduct->autoproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('autoproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: autoproduct Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
