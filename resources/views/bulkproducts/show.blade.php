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
                        Details Bulk Material
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bulkproducts.index') }}">Bulk Material</a></li>
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
                <!-- bulkproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Bulk Material Image</div>
                    <div class="card-body text-center">
                        <!-- bulkproduct image -->
                        <img class="img-account-profile mb-2" src="{{ asset($bulkproduct->bulkproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: bulkproduct Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Bulk Material Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of bulkproduct code) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Bulk Material code</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_code  }}</div>
                            </div>
                            <!-- Form Group (type of bulkproduct unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: bulkproduct Code -->

                <!-- BEGIN: bulkproduct Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        bulkmation Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (bulkproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_assetID">Old ID</label>
                                @if ($bulkproduct->bulkproduct_assetID)
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (bulkproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_newassetID">New ID</label>
                                @if ($bulkproduct->bulkproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of bulkproduct type) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_bulktype">Bulk Material Type</label>
                                @if ($bulkproduct->bulkproduct_bulktype)
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_bulktype }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             {{-- <!-- Form Group (bulkproduct serial number) -->
                             <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (bulkproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_datein') is-invalid @enderror"
                                       name="bulkproduct_datein" id="bulkproduct_datein" type="date" value="{{ old('bulkproduct_datein', $bulkproduct->bulkproduct_datein) }}">
                                @error('bulkproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_transfer">Material Transfer</label>
                                @if ($bulkproduct->bulkproduct_transfer)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_reser">Reservation Number</label>
                                @if ($bulkproduct->bulkproduct_reser)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_origin">Ex Station</label>
                                @if ($bulkproduct->bulkproduct_origin)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_sdvin">SDV In</label>
                                @if ($bulkproduct->bulkproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_sdvout">SDV Out</label>
                                @if ($bulkproduct->bulkproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_station">Station</label>
                                @if ($bulkproduct->bulkproduct_station)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_requestor">Requestor</label>
                                @if ($bulkproduct->bulkproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_project">Project</label>
                                @if ($bulkproduct->bulkproduct_project)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_dateout') is-invalid @enderror"
                                name="bulkproduct_dateout" id="bulkproduct_dateout" type="date" value="{{ old('bulkproduct_dateout', $bulkproduct->bulkproduct_dateout) }}">
                                @error('bulkproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_dateoffshore') is-invalid @enderror"
                                name="bulkproduct_dateoffshore" id="bulkproduct_dateoffshore" type="date" value="{{ old('bulkproduct_dateoffshore', $bulkproduct->bulkproduct_dateoffshore) }}">
                                @error('bulkproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (bulkproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($bulkproduct->bulkproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (bulkproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_curloc">Current Location</label>
                                @if ($bulkproduct->bulkproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_stockin">Stock In</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_stockout">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC IN </label>
                                @if($bulkproduct->bulkproduct_docin)
                                    <a href="{{ asset($bulkproduct->bulkproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($bulkproduct->bulkproduct_docout)
                                    <a href="{{ asset($bulkproduct->bulkproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (stockqty) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_stockqty">Stock Quantity</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->uom->uom  }}</div>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_uom">UOM</label>
                                @if ($bulkproduct->bulkproduct_uom)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (targetpdn) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_targetpdn') is-invalid @enderror"
                                name="bulkproduct_targetpdn" id="bulkproduct_targetpdn" type="date" value="{{ old('bulkproduct_targetpdn', $bulkproduct->bulkproduct_targetpdn) }}">
                                @error('bulkproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_csrelease">CS Release</label>
                                @if ($bulkproduct->bulkproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_csnumber">CS Number</label>
                                @if ($bulkproduct->bulkproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_cenumber">CE Number</label>
                               @if ($bulkproduct->bulkproduct_cenumber)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="bulkproduct_ronumber">RO Number</label>
                                @if ($bulkproduct->bulkproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_startdate') is-invalid @enderror"
                                name="bulkproduct_startdate" id="bulkproduct_startdate" type="date" value="{{ old('bulkproduct_startdate', $bulkproduct->bulkproduct_startdate) }}">
                                @error('bulkproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('bulkproduct_enddate') is-invalid @enderror"
                                           name="bulkproduct_enddate" id="bulkproduct_enddate" type="date" value="{{ old('bulkproduct_enddate', $bulkproduct->bulkproduct_enddate) }}">
                                    @error('bulkproduct_enddate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <!-- Form Group (price) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_price  }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <label class="small mb-1" for="bulkproduct_remark">REMARK</label>
                                @if ($bulkproduct->bulkproduct_remark)
                                    <div class="form-control form-control-solid">{{ $bulkproduct->bulkproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                    </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('bulkproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: bulkproduct Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
