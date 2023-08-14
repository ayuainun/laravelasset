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
                        Instrument List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('insproducts.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('insproducts.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('insproducts.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('insproducts.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
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
                    <form action="{{ route('insproducts.index') }}" method="GET">
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
                                    <th scope="col">@sortablelink('insproduct_assetID', 'Old ID')</th>
                                    <th scope="col">@sortablelink('insproduct_newassetID', 'New ID')</th>
                                    <th scope="col">@sortablelink('insproduct_instype', 'Instrument Type')</th>
                                    <th scope="col">@sortablelink('insproduct_insbrand', 'Instrument Brand')</th>
                                    {{-- <th scope="col">@sortablelink('insproduct_serial', 'Serial Number')</th> --}}
                                    <th scope="col">@sortablelink('insproduct_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('insproduct_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('insproduct_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('insproduct_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('insproduct_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('insproduct_station', 'Station')</th>
                                    <th scope="col">@sortablelink('insproduct_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('insproduct_project', 'Project')</th>
                                    <th scope="col">@sortablelink('insproduct_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('insproduct_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('insproduct_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('insproduct_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('insproduct_curloc', 'Current Location')</th>
                                    <th scope="col">@sortablelink('insproduct_targetpdn', 'Target PDN')</th>
                                    <th scope="col">@sortablelink('insproduct_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('insproduct_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('insproduct_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('insproduct_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('insproduct_stockqty', 'Stock Quantity')</th>
                                    <th scope="col">@sortablelink('insproduct_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('insproduct_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('insproduct_csnumber', 'CS Number')</th>
                                    <th scope="col">@sortablelink('insproduct_cenumber', 'CE Number')</th>
                                    <th scope="col">@sortablelink('insproduct_ronumber', 'RO Number')</th>
                                    <th scope="col">@sortablelink('insproduct_startdate', 'Start Date')</th>
                                    <th scope="col">@sortablelink('insproduct_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('insproduct_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('insproduct_remark', 'REMARK')</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insproducts as $insproduct)
                                <tr>
                                    <th scope="row">{{ (($insproducts->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $insproduct->insproduct_image ? asset($insproduct->insproduct_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>{{ $insproduct->insproduct_assetID }}</td>
                                    <td>{{ $insproduct->insproduct_newassetID }}</td>
                                    <td>{{ $insproduct->insproduct_instype }}</td>
                                    <td>{{ $insproduct->insproduct_insbrand }}</td>
                                    {{-- <td>{{ $insproduct->insproduct_serial }}</td> --}}
                                    <td>{{ $insproduct->insproduct_transfer }}</td>
                                    <td>{{ $insproduct->insproduct_reser }}</td>
                                    <td>{{ $insproduct->insproduct_origin }}</td>
                                    <td>{{ $insproduct->insproduct_sdvin }}</td>
                                    <td>{{ $insproduct->insproduct_sdvout }}</td>
                                    <td>{{ $insproduct->insproduct_station }}</td>
                                    <td>{{ $insproduct->insproduct_requestor }}</td>
                                    <td>{{ $insproduct->insproduct_project }}</td>
                                    <td>{{ $insproduct->insproduct_datein }}</td>
                                    <td>{{ $insproduct->insproduct_dateout }}</td>
                                    <td>{{ $insproduct->insproduct_dateoffshore }}</td>
                                    <td>{{ $insproduct->insproduct_tfoffshore }}</td>
                                    <td>{{ $insproduct->insproduct_curloc }}</td>
                                    <td>{{ $insproduct->insproduct_targetpdn }}</td>
                                    <td>{{ $insproduct->insproduct_stockin }}</td>
                                    <td>
                                        @if($insproduct->insproduct_docin)
                                            <a href="{{ asset($insproduct->insproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $insproduct->insproduct_stockout }}</td>
                                    <td>
                                        @if($insproduct->insproduct_docout)
                                            <a href="{{ asset($insproduct->insproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>

                                    <td>{{ $insproduct->insproduct_stockqty }}</td>
                                    <td>{{ $insproduct->insproduct_uom }}</td>
                                    <td>{{ $insproduct->insproduct_csrelease }}</td>
                                    <td>{{ $insproduct->insproduct_csnumber }}</td>
                                    <td>{{ $insproduct->insproduct_cenumber }}</td>
                                    <td>{{ $insproduct->insproduct_ronumber }}</td>
                                    <td>{{ $insproduct->insproduct_startdate }}</td>
                                    <td>{{ $insproduct->insproduct_enddate }}</td>
                                    <td>{{ $insproduct->insproduct_price }}</td>
                                    <td>{{ $insproduct->insproduct_remark }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('insproducts.show', $insproduct->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('insproducts.edit', $insproduct->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('insproducts.destroy', $insproduct->id) }}" method="POST">
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

                {{ $insproducts->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
