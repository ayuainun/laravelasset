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
                    <li class="breadcrumb-item"><a href="{{ route('insrepairproducts.index') }}">Instrument</a></li>
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
                    <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="{{ route('insrepairproducts.pdf', ['id' => $insrepairproduct->id]) }}" target="_blank">Print PDF</a></button>
                </div> --}}
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Instrument Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset($insrepairproduct->insrepairproduct_image) }}" alt="" id="image-preview" />
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
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_code  }}</div>
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
                            <!-- Form Group (product status) -->
                            <div class="col-md-6"> 
                                <label class="small mb-1" for="insrepairproduct_status">Status</label>
                                @if ($insrepairproduct->insrepairproduct_status)
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_status }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_newassetID">New ID</label>
                                @if ($insrepairproduct->insrepairproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_newassetID">New ID</label>
                                @if ($insrepairproduct->insrepairproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of insrepairproduct type) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_instype">Instrument Type</label>
                                @if ($insrepairproduct->insrepairproduct_instype)
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_instype }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (type of insrepairproduct brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_insbrand">Instrument Brand</label>
                                @if ($insrepairproduct->insrepairproduct_insbrand)
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_insbrand }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            {{-- <!-- Form Group (insrepairproduct serial number) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (insrepairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_transfer">Material Transfer</label>
                                @if ($insrepairproduct->insrepairproduct_transfer)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_reser">Reservation Number</label>
                                @if ($insrepairproduct->insrepairproduct_reser)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_origin">Ex Station</label>
                                @if ($insrepairproduct->insrepairproduct_origin)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_sdvin">SDV In</label>
                                @if ($insrepairproduct->insrepairproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_sdvout">SDV Out</label>
                                @if ($insrepairproduct->insrepairproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_station">Station</label>
                                @if ($insrepairproduct->insrepairproduct_station)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_requestor">Requestor</label>
                                @if ($insrepairproduct->insrepairproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_project">Project</label>
                                @if ($insrepairproduct->insrepairproduct_project)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_datein') is-invalid @enderror"
                                       name="insrepairproduct_datein" id="insrepairproduct_datein" type="date" value="{{ old('insrepairproduct_datein', $insrepairproduct->insrepairproduct_datein) }}">
                                @error('insrepairproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_dateout') is-invalid @enderror"
                                name="insrepairproduct_dateout" id="insrepairproduct_dateout" type="date" value="{{ old('insrepairproduct_dateout', $insrepairproduct->insrepairproduct_dateout) }}">
                                @error('insrepairproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_dateoffshore') is-invalid @enderror"
                                name="insrepairproduct_dateoffshore" id="insrepairproduct_dateoffshore" type="date" value="{{ old('insrepairproduct_dateoffshore', $insrepairproduct->insrepairproduct_dateoffshore) }}">
                                @error('insrepairproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (insrepairproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($insrepairproduct->insrepairproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (insrepairproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_curloc">Current Location</label>
                                @if ($insrepairproduct->insrepairproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (targetpdn) -->
                             <div class="col-md-6">
                                <label class="small mb-1">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_targetpdn') is-invalid @enderror"
                                name="insrepairproduct_targetpdn" id="insrepairproduct_targetpdn" type="date" value="{{ old('insrepairproduct_targetpdn', $insrepairproduct->insrepairproduct_targetpdn) }}">
                                @error('insrepairproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock In</label>
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC IN </label>
                                @if($insrepairproduct->insrepairproduct_docin)
                                    <a href="{{ asset($insrepairproduct->insrepairproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($insrepairproduct->insrepairproduct_docout)
                                    <a href="{{ asset($insrepairproduct->insrepairproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>

                            <!-- Form Group (stock qty) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Qty</label>
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                <div class="form-control form-control-solid">{{ $insrepairproduct->uom->uom  }}</div>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_uom">UOM</label>
                                @if ($insrepairproduct->insrepairproduct_uom)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_csrelease">CS Release</label>
                                @if ($insrepairproduct->insrepairproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_csnumber">CS Number</label>
                                @if ($insrepairproduct->insrepairproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_cenumber">CE Number</label>
                               @if ($insrepairproduct->insrepairproduct_cenumber)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_ronumber">RO Number</label>
                                @if ($insrepairproduct->insrepairproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_startdate') is-invalid @enderror"
                                name="insrepairproduct_startdate" id="insrepairproduct_startdate" type="date" value="{{ old('insrepairproduct_startdate', $insrepairproduct->insrepairproduct_startdate) }}">
                                @error('insrepairproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('insrepairproduct_enddate') is-invalid @enderror"
                                name="insrepairproduct_enddate" id="insrepairproduct_enddate" type="date" value="{{ old('insrepairproduct_enddate', $insrepairproduct->insrepairproduct_enddate) }}">
                                @error('insrepairproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_price  }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="insrepairproduct_remark">REMARK</label>
                                @if ($insrepairproduct->insrepairproduct_remark)
                                    <div class="form-control form-control-solid">{{ $insrepairproduct->insrepairproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('insrepairproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
