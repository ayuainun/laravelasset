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
                        Automation List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('autorepairproducts.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('autorepairproducts.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('autorepairproducts.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('autorepairproducts.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Automation</li>
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
                    <form action="{{ route('autorepairproducts.index') }}" method="GET">
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
                                    <th scope="col">@sortablelink('autorepairproduct_assetID', 'Old ID')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_newassetID', 'Asset ID')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_autobrand', 'Automation Brand')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_station', 'Station')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_project', 'Project')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_curloc', 'Current Location')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_stockqty', 'Stock Quantity')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_targetpdn', 'Target PDN')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_csnumber', 'CS Number')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_cenumber', 'CE Number')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_ronumber', 'RO Number')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_startdate', 'Start Date')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('autorepairproduct_remark', 'REMARK')</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($autorepairproducts as $autorepairproduct)
                                <tr>
                                    <th scope="row">{{ (($autorepairproducts->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $autorepairproduct->autorepairproduct_image ? asset($autorepairproduct->autorepairproduct_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>{{ $autorepairproduct->autorepairproduct_assetID }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_newassetID }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_autobrand }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_datein }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_transfer }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_reser }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_origin }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_sdvin }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_sdvout }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_station }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_requestor }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_project }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_dateout }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_dateoffshore }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_tfoffshore }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_curloc }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_stockin }}</td>
                                    <td>
                                        @if($autorepairproduct->autorepairproduct_docin)
                                            <a href="{{ asset($autorepairproduct->autorepairproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $autorepairproduct->autorepairproduct_stockout }}</td>
                                    <td>
                                        @if($autorepairproduct->autorepairproduct_docout)
                                            <a href="{{ asset($autorepairproduct->autorepairproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>

                                    <td>{{ $autorepairproduct->autorepairproduct_stockqty }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_uom }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_targetpdn }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_csrelease }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_csnumber }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_cenumber }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_ronumber }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_startdate }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_enddate }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_price }}</td>
                                    <td>{{ $autorepairproduct->autorepairproduct_remark }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('autorepairproducts.show', $autorepairproduct->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('autorepairproducts.edit', $autorepairproduct->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('autorepairproducts.destroy', $autorepairproduct->id) }}" method="POST">
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

                {{ $autorepairproducts->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
