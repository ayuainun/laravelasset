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
                        Instrument Repair List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('insrepairproducts.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('insrepairproducts.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('insrepairproducts.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('insrepairproducts.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Instrument</li>
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
                    <form action="{{ route('insrepairproducts.index') }}" method="GET">
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
                                    <th scope="col">@sortablelink('insrepairproduct_status', 'Status')</th>
                                    {{-- <th scope="col">@sortablelink('insrepairproduct_assetID', 'Old ID')</th> --}}
                                    <th scope="col">@sortablelink('insrepairproduct_newassetID', 'New ID')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_instype', 'Instrument Type')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_insbrand', 'Instrument Brand')</th>
                                    {{-- <th scope="col">@sortablelink('insrepairproduct_serial', 'Serial Number')</th> --}}
                                    {{-- <th scope="col">@sortablelink('insrepairproduct_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_station', 'Station')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_project', 'Project')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_curloc', 'Current Location')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_targetpdn', 'Target PDN')</th> --}}
                                    <th scope="col">@sortablelink('insrepairproduct_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_stockqty', 'Stock Quantity')</th>
                                    {{-- <th scope="col">@sortablelink('insrepairproduct_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_csnumber', 'CS Number')</th> --}}
                                    <th scope="col">@sortablelink('insrepairproduct_cenumber', 'CE Number')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_ronumber', 'RO Number')</th>
                                    {{-- <th scope="col">@sortablelink('insrepairproduct_startdate', 'Start Date')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('insrepairproduct_remark', 'REMARK')</th> --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insrepairproducts as $insrepairproduct)
                                <tr>
                                    <th scope="row">{{ (($insrepairproducts->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $insrepairproduct->insrepairproduct_image ? asset($insrepairproduct->insrepairproduct_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-box
                                          @if($insrepairproduct->insrepairproduct_status == 'Incoming')
                                            bg-success
                                          @elseif($insrepairproduct->insrepairproduct_status == 'Outgoing')
                                            bg-danger
                                          @else
                                            bg-info
                                          @endif">
                                          <span class="status-text
                                            @if($insrepairproduct->insrepairproduct_status == 'Incoming')
                                              text-white
                                            @elseif($insrepairproduct->insrepairproduct_status == 'Outgoing')
                                              text-white
                                            @else($insrepairproduct->insrepairproduct_status == 'Workshop')
                                              text-white
                                            @endif">
                                            @if($insrepairproduct->insrepairproduct_status == 'Incoming')
                                              Incoming
                                            @elseif($insrepairproduct->insrepairproduct_status == 'Outgoing')
                                              Outgoing
                                            @else
                                              Workshop
                                            @endif
                                          </span>
                                        </div>
                                      </td>               
                                    {{-- <td>{{ $insrepairproduct->insrepairproduct_assetID }}</td> --}}
                                    <td>{{ $insrepairproduct->insrepairproduct_newassetID }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_instype }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_insbrand }}</td>
                                    {{-- <td>{{ $insrepairproduct->insrepairproduct_serial }}</td> --}}
                                    {{-- <td>{{ $insrepairproduct->insrepairproduct_transfer }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_reser }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_origin }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_sdvin }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_sdvout }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_station }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_requestor }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_project }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_datein }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_dateout }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_dateoffshore }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_tfoffshore }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_curloc }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_targetpdn }}</td> --}}
                                    <td>{{ $insrepairproduct->insrepairproduct_stockin }}</td>
                                    <td>
                                        @if($insrepairproduct->insrepairproduct_docin)
                                            <a href="{{ asset($insrepairproduct->insrepairproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $insrepairproduct->insrepairproduct_stockout }}</td>
                                    <td>
                                        @if($insrepairproduct->insrepairproduct_docout)
                                            <a href="{{ asset($insrepairproduct->insrepairproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $insrepairproduct->insrepairproduct_stockqty }}</td>
                                    {{-- <td>{{ $insrepairproduct->insrepairproduct_uom }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_csrelease }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_csnumber }}</td> --}}
                                    <td>{{ $insrepairproduct->insrepairproduct_cenumber }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_ronumber }}</td>
                                    {{-- <td>{{ $insrepairproduct->insrepairproduct_startdate }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_enddate }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_price }}</td>
                                    <td>{{ $insrepairproduct->insrepairproduct_remark }}</td> --}}
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('insrepairproducts.show', $insrepairproduct->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('insrepairproducts.edit', $insrepairproduct->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('insrepairproducts.destroy', $insrepairproduct->id) }}" method="POST">
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

                {{ $insrepairproducts->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
