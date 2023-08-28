@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto my-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Spare Parts List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('partsproducts.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('partsproducts.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('partsproducts.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('partsproducts.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Spare Parts</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- BEGIN: Alert -->
    <div class="container-xl px-4 mt-n4">
        @if (session()->has('success'))
        <div class="alert alert-success alert-icon" role="alert">
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-icon-aside">
                <i class="far fa-flag"></i>
            </div>
            <div class="alert-icon-content">
                {{ session('success') }}
            </div>
        </div>
        @endif
    </div>
    <!-- END: Alert -->
</header>
<!-- END: Header -->


<!-- BEGIN: Main Page Content -->
<div class="container px-2 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('partsproducts.index') }}" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
                                <label for="row" class="col-auto">Row:</label>
                                <div class="col-auto">
                                    <select class="form-control" name="row">
                                        <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                        <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                        <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                        <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-between">
                                <label class="control-label col-sm-3" for="search">Search:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search Product" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">@sortablelink('partsproduct_status', 'Status')</th>
                                    {{-- <th scope="col">@sortablelink('partsproduct_assetID', 'Old ID')</th> --}}
                                    <th scope="col">@sortablelink('partsproduct_newassetID', 'New ID')</th>
                                    <th scope="col">@sortablelink('partsproduct_desc', 'Description')</th>
                                    <th scope="col">@sortablelink('partsproduct_partnumber', 'Part Number')</th>
                                    {{-- <th scope="col">@sortablelink('partsproduct_serial', 'Serial Number')</th> --}}
                                    {{-- <th scope="col">@sortablelink('partsproduct_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('partsproduct_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('partsproduct_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('partsproduct_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('partsproduct_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('partsproduct_station', 'Station')</th>
                                    <th scope="col">@sortablelink('partsproduct_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('partsproduct_project', 'Project')</th>
                                    <th scope="col">@sortablelink('partsproduct_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('partsproduct_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('partsproduct_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('partsproduct_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('partsproduct_curloc', 'Current Location')</th>
                                    <th scope="col">@sortablelink('partsproduct_targetpdn', 'Target PDN')</th> --}}
                                    <th scope="col">@sortablelink('partsproduct_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('partsproduct_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('partsproduct_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('partsproduct_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('partsproduct_stockqty', 'Stock Quantity')</th>
                                    {{-- <th scope="col">@sortablelink('partsproduct_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('partsproduct_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('partsproduct_csnumber', 'CS Number')</th> --}}
                                    <th scope="col">@sortablelink('partsproduct_cenumber', 'CE Number')</th>
                                    <th scope="col">@sortablelink('partsproduct_ronumber', 'RO Number')</th>
                                    {{-- <th scope="col">@sortablelink('partsproduct_startdate', 'Start Date')</th>
                                    <th scope="col">@sortablelink('partsproduct_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('partsproduct_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('partsproduct_remark', 'REMARK')</th> --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partsproducts as $partsproduct)
                                <tr>
                                    <th scope="row">{{ (($partsproducts->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $partsproduct->partsproduct_image ? asset($partsproduct->partsproduct_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-box
                                          @if($partsproduct->partsproduct_status == 'Incoming')
                                            bg-success
                                          @elseif($partsproduct->partsproduct_status == 'Outgoing')
                                            bg-danger
                                          @else
                                            bg-info
                                          @endif">
                                          <span class="status-text
                                            @if($partsproduct->partsproduct_status == 'Incoming')
                                              text-white
                                            @elseif($partsproduct->partsproduct_status == 'Outgoing')
                                              text-white
                                            @else($partsproduct->partsproduct_status == 'Workshop')
                                              text-white
                                            @endif">
                                            @if($partsproduct->partsproduct_status == 'Incoming')
                                              Incoming
                                            @elseif($partsproduct->partsproduct_status == 'Outgoing')
                                              Outgoing
                                            @else
                                              Workshop
                                            @endif
                                          </span>
                                        </div>
                                      </td>              
                                    {{-- <td>{{ $partsproduct->partsproduct_assetID }}</td> --}}
                                    <td>{{ $partsproduct->partsproduct_newassetID }}</td>
                                    <td>{{ $partsproduct->partsproduct_desc }}</td>
                                    <td>{{ $partsproduct->partsproduct_partnumber }}</td>
                                    {{-- <td>{{ $partsproduct->partsproduct_serial }}</td> --}}
                                    {{-- <td>{{ $partsproduct->partsproduct_transfer }}</td>
                                    <td>{{ $partsproduct->partsproduct_reser }}</td>
                                    <td>{{ $partsproduct->partsproduct_origin }}</td>
                                    <td>{{ $partsproduct->partsproduct_sdvin }}</td>
                                    <td>{{ $partsproduct->partsproduct_sdvout }}</td>
                                    <td>{{ $partsproduct->partsproduct_station }}</td>
                                    <td>{{ $partsproduct->partsproduct_requestor }}</td>
                                    <td>{{ $partsproduct->partsproduct_project }}</td>
                                    <td>{{ $partsproduct->partsproduct_datein }}</td>
                                    <td>{{ $partsproduct->partsproduct_dateout }}</td>
                                    <td>{{ $partsproduct->partsproduct_dateoffshore }}</td>
                                    <td>{{ $partsproduct->partsproduct_tfoffshore }}</td>
                                    <td>{{ $partsproduct->partsproduct_curloc }}</td>
                                    <td>{{ $partsproduct->partsproduct_targetpdn }}</td> --}}
                                    <td>{{ $partsproduct->partsproduct_stockin }}</td>
                                    <td>
                                        @if($partsproduct->partsproduct_docin)
                                            <a href="{{ asset($partsproduct->partsproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $partsproduct->partsproduct_stockout }}</td>
                                    <td>
                                        @if($partsproduct->partsproduct_docout)
                                            <a href="{{ asset($partsproduct->partsproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>

                                    <td>{{ $partsproduct->partsproduct_stockqty }}</td>
                                    {{-- <td>{{ $partsproduct->partsproduct_uom }}</td>
                                    <td>{{ $partsproduct->partsproduct_csrelease }}</td>
                                    <td>{{ $partsproduct->partsproduct_csnumber }}</td> --}}
                                    <td>{{ $partsproduct->partsproduct_cenumber }}</td>
                                    <td>{{ $partsproduct->partsproduct_ronumber }}</td>
                                    {{-- <td>{{ $partsproduct->partsproduct_startdate }}</td>
                                    <td>{{ $partsproduct->partsproduct_enddate }}</td>
                                    <td>{{ $partsproduct->partsproduct_price }}</td>
                                    <td>{{ $partsproduct->partsproduct_remark }}</td> --}}
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('partsproducts.show', $partsproduct->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('partsproducts.edit', $partsproduct->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('partsproducts.destroy', $partsproduct->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $partsproducts->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
