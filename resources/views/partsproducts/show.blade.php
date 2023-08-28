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
                        Details Spare Parts
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('partsproducts.index') }}">Spare Parts</a></li>
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
                    <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="{{ route('partsproducts.pdf', ['id' => $partsproduct->id]) }}" target="_blank">Print PDF</a></button>
                </div> --}}
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Spare Parts Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset($partsproduct->partsproduct_image) }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Code -->
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Spare Parts Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Spare Parts code</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_code  }}</div>
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
                        Spare Parts Information
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (product status) -->
                            <div class="col-md-6"> 
                                <label class="small mb-1" for="partsproduct_status">Status</label>
                                @if ($partsproduct->partsproduct_status)
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_status }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_assetID">Old ID</label>
                                @if ($partsproduct->partsproduct_assetID)
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_assetID }}</div>
                            @else
                                <div class="form-control form-control-solid">N/A</div>
                            @endif
                            </div>
                            <!-- Form Group (partsproduct new ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_newassetID">New ID</label>
                                @if ($partsproduct->partsproduct_newassetID)
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_newassetID }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (desc of partsproduct ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_desc">Description</label>
                                @if ($partsproduct->partsproduct_desc)
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_desc  }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (number of partsproduct) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_partnumber">Part Number</label>
                                @if ($partsproduct->partsproduct_partnumber)
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_partnumber  }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            {{-- <!-- Form Group (partsproduct serial number) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Serial Number</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_serial }}</div>
                            </div> --}}
                            <!-- Form Group (partsproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Material Transfer</label>
                                @if ($partsproduct->partsproduct_transfer)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_transfer }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct reser) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_reser">Reservation Number</label>
                                @if ($partsproduct->partsproduct_reser)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_reser }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_origin">Ex Station</label>
                                @if ($partsproduct->partsproduct_origin)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_origin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct SDV IN) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_sdvin">SDV In</label>
                                @if ($partsproduct->partsproduct_sdvin)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_sdvin }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct SDV Out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_sdvout">SDV Out</label>
                                @if ($partsproduct->partsproduct_sdvout)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_sdvout }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_station">Station</label>
                                @if ($partsproduct->partsproduct_station)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_station }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_requestor">Requestor</label>
                                @if ($partsproduct->partsproduct_requestor)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_requestor }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_project">Project</label>
                                @if ($partsproduct->partsproduct_project)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_project }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct datein) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('partproduct_datein') is-invalid @enderror"
                                       name="partproduct_datein" id="partproduct_datein" type="date" value="{{ old('partproduct_datein', $partsproduct->partsproduct_datein) }}">
                                @error('partproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct dateout) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('partproduct_dateout') is-invalid @enderror"
                                name="partproduct_dateout" id="partproduct_dateout" type="date" value="{{ old('partproduct_dateout', $partsproduct->partsproduct_dateout) }}">
                                @error('partproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct dateoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_dateoffshore') is-invalid @enderror"
                                name="partsproduct_dateoffshore" id="partsproduct_dateoffshore" type="date" value="{{ old('partsproduct_dateoffshore', $partsproduct->partsproduct_dateoffshore) }}">
                                @error('partsproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (partsproduct tfoffshore) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_tfoffshore">Material transfer to offshore</label>
                                @if ($partsproduct->partsproduct_tfoffshore)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_tfoffshore }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (partsproduct curloc) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_curloc">Current Location</label>
                                @if ($partsproduct->partsproduct_curloc)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_curloc }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                             <!-- Form Group (targetpdn) -->
                             <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_targetpdn">TARGET PDN</label>
                                @if ($partsproduct->partsproduct_targetpdn)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_targetpdn }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (stock in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock In</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_stockin  }}</div>
                            </div>
                            <!-- Form Group (stock out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Out</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_stockout  }}</div>
                            </div>
                            <!-- Form Group (doc in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC IN </label>
                                @if($partsproduct->partsproduct_docin)
                                    <a href="{{ asset($partsproduct->partsproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (doc out) -->
                            <div class="col-md-6">
                                <label class="small mb-1">DOC OUT </label>
                                @if($partsproduct->partsproduct_docout)
                                    <a href="{{ asset($partsproduct->partsproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                @else
                                    No Document Available
                                @endif
                            </div>
                            <!-- Form Group (stock qty) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Stock Qty</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_stockqty  }}</div>
                            </div>
                            <!-- Form Group (UOM) -->
                            {{-- <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->uom->uom  }}</div>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="small mb-1">UOM</label>
                                @if ($partsproduct->partsproduct_uom)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_uom }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csrelease) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_csrelease">CS Release</label>
                                @if ($partsproduct->partsproduct_csrelease)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_csrelease }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (csnumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_csnumber">CS Number</label>
                                @if ($partsproduct->partsproduct_csnumber)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_csnumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (cenumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_cenumber">CE Number</label>
                               @if ($partsproduct->partsproduct_cenumber)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_cenumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (ronumber) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_ronumber">RO Number</label>
                                @if ($partsproduct->partsproduct_ronumber)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_ronumber }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                            <!-- Form Group (startdate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_startdate') is-invalid @enderror"
                                name="partsproduct_startdate" id="partsproduct_startdate" type="date" value="{{ old('partsproduct_startdate', $partsproduct->partsproduct_startdate) }}">
                                @error('partsproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (enddate) -->
                            <div class="col-md-6">
                                <label class="small mb-1">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('partsproduct_enddate') is-invalid @enderror"
                                name="partsproduct_enddate" id="partsproduct_enddate" type="date" value="{{ old('partsproduct_enddate', $partsproduct->partsproduct_enddate) }}">
                                @error('partsproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="partsproduct_price">Price Repair</label>
                                <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_price  }}</div>
                            </div>
                            <!-- Form Group (remark) -->
                            <div class="col-md-15">
                                <label class="small mb-1" for="partsproduct_remark">REMARK</label>
                                @if ($partsproduct->partsproduct_remark)
                                    <div class="form-control form-control-solid">{{ $partsproduct->partsproduct_remark }}</div>
                                @else
                                    <div class="form-control form-control-solid">N/A</div>
                                @endif
                            </div>
                        </div>
                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('partsproducts.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
