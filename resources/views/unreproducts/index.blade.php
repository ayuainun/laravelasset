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
                        Unrepairable Asset List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('unreproducts.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('unreproducts.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('unreproducts.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('unreproducts.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Unrepairable Asset</li>
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
                    <form action="{{ route('unreproducts.index') }}" method="GET">
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
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search Unrepairable Asset" value="{{ request('search') }}">
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
                                    <th scope="col">@sortablelink('unreproduct_assetID', 'Old ID')</th>
                                    <th scope="col">@sortablelink('unreproduct_newassetID', 'New ID')</th>
                                    <th scope="col">@sortablelink('unreproduct_desc', 'Description')</th>
                                    {{-- <th scope="col">@sortablelink('unreproduct_serial', 'Serial Number')</th> --}}
                                    <th scope="col">@sortablelink('unreproduct_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('unreproduct_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('unreproduct_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('unreproduct_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('unreproduct_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('unreproduct_station', 'Station')</th>
                                    <th scope="col">@sortablelink('unreproduct_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('unreproduct_project', 'Project')</th>
                                    <th scope="col">@sortablelink('unreproduct_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('unreproduct_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('unreproduct_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('unreproduct_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('unreproduct_curloc', 'Current Location')</th>
                                    <th scope="col">@sortablelink('unreproduct_targetpdn', 'Target PDN')</th>
                                    <th scope="col">@sortablelink('unreproduct_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('unreproduct_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('unreproduct_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('unreproduct_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('unreproduct_stockqty', 'Stock Quantity')</th>
                                    <th scope="col">@sortablelink('unreproduct_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('unreproduct_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('unreproduct_csnumber', 'CS Number')</th>
                                    <th scope="col">@sortablelink('unreproduct_cenumber', 'CE Number')</th>
                                    <th scope="col">@sortablelink('unreproduct_ronumber', 'RO Number')</th>
                                    <th scope="col">@sortablelink('unreproduct_startdate', 'Start Date')</th>
                                    <th scope="col">@sortablelink('unreproduct_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('unreproduct_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('unreproduct_remark', 'REMARK')</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unreproducts as $unreproduct)
                                <tr>
                                    <th scope="row">{{ (($unreproducts->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $unreproduct->unreproduct_image ? asset($unreproduct->unreproduct_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>{{ $unreproduct->unreproduct_assetID }}</td>
                                    <td>{{ $unreproduct->unreproduct_newassetID }}</td>
                                    <td>{{ $unreproduct->unreproduct_desc }}</td>
                                    {{-- <td>{{ $unreproduct->unreproduct_serial }}</td> --}}
                                    <td>{{ $unreproduct->unreproduct_transfer }}</td>
                                    <td>{{ $unreproduct->unreproduct_reser }}</td>
                                    <td>{{ $unreproduct->unreproduct_origin }}</td>
                                    <td>{{ $unreproduct->unreproduct_sdvin }}</td>
                                    <td>{{ $unreproduct->unreproduct_sdvout }}</td>
                                    <td>{{ $unreproduct->unreproduct_station }}</td>
                                    <td>{{ $unreproduct->unreproduct_requestor }}</td>
                                    <td>{{ $unreproduct->unreproduct_project }}</td>
                                    <td>{{ $unreproduct->unreproduct_datein }}</td>
                                    <td>{{ $unreproduct->unreproduct_dateout }}</td>
                                    <td>{{ $unreproduct->unreproduct_dateoffshore }}</td>
                                    <td>{{ $unreproduct->unreproduct_tfoffshore }}</td>
                                    <td>{{ $unreproduct->unreproduct_curloc }}</td>
                                    <td>{{ $unreproduct->unreproduct_targetpdn }}</td>
                                    <td>{{ $unreproduct->unreproduct_stockin }}</td>
                                    <td>
                                        @if($unreproduct->unreproduct_docin)
                                            <a href="{{ asset($unreproduct->unreproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $unreproduct->unreproduct_stockout }}</td>
                                    <td>
                                        @if($unreproduct->unreproduct_docout)
                                            <a href="{{ asset($unreproduct->unreproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $unreproduct->unreproduct_stockqty }}</td>
                                    <td>{{ $unreproduct->unreproduct_uom }}</td>
                                    <td>{{ $unreproduct->unreproduct_csrelease }}</td>
                                    <td>{{ $unreproduct->unreproduct_csnumber }}</td>
                                    <td>{{ $unreproduct->unreproduct_cenumber }}</td>
                                    <td>{{ $unreproduct->unreproduct_ronumber }}</td>
                                    <td>{{ $unreproduct->unreproduct_startdate }}</td>
                                    <td>{{ $unreproduct->unreproduct_enddate }}</td>
                                    <td>{{ $unreproduct->unreproduct_price }}</td>
                                    <td>{{ $unreproduct->unreproduct_remark }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('unreproducts.show', $unreproduct->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('unreproducts.edit', $unreproduct->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('unreproducts.destroy', $unreproduct->id) }}" method="POST">
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

                {{ $unreproducts->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
