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
                    <li class="breadcrumb-item"><a href="{{ route('autorepairproducts.index') }}">Automation</a></li>
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
                    <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="{{ route('autorepairproducts.pdf', ['id' => $autorepairproduct->id]) }}" target="_blank">Print PDF</a></button>
                </div> --}}
                <!-- autorepairproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Automation Image</div>
                    <div class="card-body text-center">
                        <!-- autorepairproduct image -->
                        <img class="img-account-profile mb-2" src="{{ asset($autorepairproduct->autorepairproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: autorepairproduct Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Automation Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of autorepairproduct code) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Automation code</label>
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_code  }}</div>
                            </div>
                            <!-- Form Group (type of autorepairproduct unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: autorepairproduct Code -->

                <!-- BEGIN: autorepairproduct Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        Automation Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                             <!-- Form Group (product status) -->
                             <div class="col-md-6"> 
                                <label class="small mb-1" for="autorepairproduct_status">Status</label>
                                @if ($autorepairproduct->autorepairproduct_status)
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_status }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_assetID">Old ID</label>
                                @if ($autorepairproduct->autorepairproduct_assetID)
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (autorepairproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_newassetID">New ID</label>
                                @if ($autorepairproduct->autorepairproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of autorepairproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_autobrand">Automation Brand</label>
                                @if ($autorepairproduct->autorepairproduct_autobrand)
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_autobrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             {{-- <!-- Form Group (autorepairproduct serial number) -->
                             <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (autorepairproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_datein') is-invalid @enderror"
                                       name="autorepairproduct_datein" id="autorepairproduct_datein" type="date" value="{{ old('autorepairproduct_datein', $autorepairproduct->autorepairproduct_datein) }}">
                                @error('autorepairproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_tfoffshore">Material Transfer</label>
                                @if ($autorepairproduct->autorepairproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_reser">Reservation Number</label>
                                @if ($autorepairproduct->autorepairproduct_reser)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_origin">Ex Station</label>
                                @if ($autorepairproduct->autorepairproduct_origin)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_sdvin">SDV In</label>
                                @if ($autorepairproduct->autorepairproduct_sdvin)
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_sdvin }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (autorepairproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_sdvout">SDV Out</label>
                                @if ($autorepairproduct->autorepairproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_station">Station</label>
                                @if ($autorepairproduct->autorepairproduct_station)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_requestor">Requestor</label>
                                @if ($autorepairproduct->autorepairproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_project">Project</label>
                                @if ($autorepairproduct->autorepairproduct_project)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_dateout') is-invalid @enderror"
                                name="autorepairproduct_dateout" id="autorepairproduct_dateout" type="date" value="{{ old('autorepairproduct_dateout', $autorepairproduct->autorepairproduct_dateout) }}">
                                @error('autorepairproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_dateoffshore') is-invalid @enderror"
                                name="autorepairproduct_dateoffshore" id="autorepairproduct_dateoffshore" type="date" value="{{ old('autorepairproduct_dateoffshore', $autorepairproduct->autorepairproduct_dateoffshore) }}">
                                @error('autorepairproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (autorepairproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($autorepairproduct->autorepairproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (autorepairproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_curloc">Current Location</label>
                                @if ($autorepairproduct->autorepairproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_stockin">Stock In</label>
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_stockout">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC IN </label>
                                @if($autorepairproduct->autorepairproduct_docin)
                                    <a href="{{ asset($autorepairproduct->autorepairproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($autorepairproduct->autorepairproduct_docout)
                                    <a href="{{ asset($autorepairproduct->autorepairproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>

                            <!-- Form Group (stockqty) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_stockqty">Stock Quantity</label>
                                <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                <div class="form-control form-control-solid">{{ $autorepairproduct->uom->uom  }}</div>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_uom">UOM</label>
                                @if ($autorepairproduct->autorepairproduct_uom)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (targetpdn) -->
                            <div class="col-md-6">
                                <<label class="small mb-1" for="autorepairproduct_targetpdn">Target PDN</label>
                                @if ($autorepairproduct->autorepairproduct_targetpdn)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_targetpdn }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_csrelease">CS Release</label>
                                @if ($autorepairproduct->autorepairproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_csnumber">CS Number</label>
                                @if ($autorepairproduct->autorepairproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_cenumber">CE Number</label>
                                @if ($autorepairproduct->autorepairproduct_cenumber)
                                        <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_cenumber }}</div>
                                    @else
                                        <div class="form-control form-control-solid">N/A</div>
                                    @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_ronumber">RO Number</label>
                                @if ($autorepairproduct->autorepairproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('autorepairproduct_startdate') is-invalid @enderror"
                                name="autorepairproduct_startdate" id="autorepairproduct_startdate" type="date" value="{{ old('autorepairproduct_startdate', $autorepairproduct->autorepairproduct_startdate) }}">
                                @error('autorepairproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                 <input class="form-control form-control-solid example-date-input @error('autorepairproduct_enddate') is-invalid @enderror"
                                           name="autorepairproduct_enddate" id="autorepairproduct_enddate" type="date" value="{{ old('autorepairproduct_enddate', $autorepairproduct->autorepairproduct_enddate) }}">
                                    @error('autorepairproduct_enddate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <!-- Form Group (price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_price">Price Repair</label>
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_price }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="autorepairproduct_remark">REMARK</label>
                                @if ($autorepairproduct->autorepairproduct_remark)
                                    <div class="form-control form-control-solid">{{ $autorepairproduct->autorepairproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('autorepairproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: autorepairproduct Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
