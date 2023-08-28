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
                        Details Instrument
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('insproducts.index') }}">Instrument</a></li>
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
                    <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="{{ route('insproducts.pdf', ['id' => $insproduct->id]) }}" target="_blank">Print PDF</a></button>
                </div> --}}
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Instrument Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset($insproduct->insproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Instrument Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Instrument code</label>
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_code  }}</div>
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
                        Instrument Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (insproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_assetID">Old ID</label>
                                @if ($insproduct->insproduct_assetID)
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (insproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_newassetID">New ID</label>
                                @if ($insproduct->insproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of insproduct type) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_instype">Instrument Type</label>
                                @if ($insproduct->insproduct_instype)
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_instype }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of insproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_insbrand">Instrument Brand</label>
                                @if ($insproduct->insproduct_insbrand)
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_insbrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            {{-- <!-- Form Group (insproduct serial number) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (insproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_transfer">Material Transfer</label>
                                @if ($insproduct->insproduct_transfer)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_reser">Reservation Number</label>
                                @if ($insproduct->insproduct_reser)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_origin">Ex Station</label>
                                @if ($insproduct->insproduct_origin)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_sdvin">SDV In</label>
                                @if ($insproduct->insproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_sdvout">SDV Out</label>
                                @if ($insproduct->insproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_station">Station</label>
                                @if ($insproduct->insproduct_station)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_requestor">Requestor</label>
                                @if ($insproduct->insproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_project">Project</label>
                                @if ($insproduct->insproduct_project)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_datein') is-invalid @enderror"
                                       name="insproduct_datein" id="insproduct_datein" type="date" value="{{ old('insproduct_datein', $insproduct->insproduct_datein) }}">
                                @error('insproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_dateout') is-invalid @enderror"
                                name="insproduct_dateout" id="insproduct_dateout" type="date" value="{{ old('insproduct_dateout', $insproduct->insproduct_dateout) }}">
                                @error('insproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_dateoffshore') is-invalid @enderror"
                                name="insproduct_dateoffshore" id="insproduct_dateoffshore" type="date" value="{{ old('insproduct_dateoffshore', $insproduct->insproduct_dateoffshore) }}">
                                @error('insproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($insproduct->insproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_curloc">Current Location</label>
                                @if ($insproduct->insproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (targetpdn) -->
                             <div class="col-md-6">
                                <label class="small mb-1">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_targetpdn') is-invalid @enderror"
                                name="insproduct_targetpdn" id="insproduct_targetpdn" type="date" value="{{ old('insproduct_targetpdn', $insproduct->insproduct_targetpdn) }}">
                                @error('insproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_stockin">Stock In</label>
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_stockout">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC IN </label>
                                @if($insproduct->insproduct_docin)
                                    <a href="{{ asset($insproduct->insproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($insproduct->insproduct_docout)
                                    <a href="{{ asset($insproduct->insproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>

                            <!-- Form Group (stock qty) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_stockqty">Stock Qty</label>
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_uom">UOM</label>
                                @if ($insproduct->insproduct_uom)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_csrelease">CS Release</label>
                                @if ($insproduct->insproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_csnumber">CS Number</label>
                                @if ($insproduct->insproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_cenumber">CE Number</label>
                               @if ($insproduct->insproduct_cenumber)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_ronumber">RO Number</label>
                                @if ($insproduct->insproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_startdate') is-invalid @enderror"
                                name="insproduct_startdate" id="insproduct_startdate" type="date" value="{{ old('insproduct_startdate', $insproduct->insproduct_startdate) }}">
                                @error('insproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insproduct_enddate') is-invalid @enderror"
                                           name="insproduct_enddate" id="insproduct_enddate" type="date" value="{{ old('insproduct_enddate', $insproduct->insproduct_enddate) }}">
                                    @error('insproduct_enddate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_price  }}</div>
                            </div>
                            <!-- Form Group (product status) -->
                            <div class="col-md-6"> 
                                <label class="small mb-1" for="insproduct_status">Status</label>
                                @if ($insproduct->insproduct_status)
                                <div class="form-control form-control-solid">{{ $insproduct->insproduct_status }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insproduct_remark">REMARK</label>
                                @if ($insproduct->insproduct_remark)
                                    <div class="form-control form-control-solid">{{ $insproduct->insproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('insproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
