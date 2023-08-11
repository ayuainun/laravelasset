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
                        Valve List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('products.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('products.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('products.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Valve</li>
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
                    <form action="{{ route('products.index') }}" method="GET">
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
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search product" value="{{ request('search') }}">
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
                                    <th scope="col">@sortablelink('product_assetID', 'Old ID')</th>
                                    <th scope="col">@sortablelink('product_newassetID', 'New ID')</th>
                                    <th scope="col">@sortablelink('product_equip', 'Equipment')</th>
                                    <th scope="col">@sortablelink('product_type', 'Valve Type')</th>
                                    <th scope="col">@sortablelink('product_end', 'End Connection')</th>
                                    <th scope="col">@sortablelink('product_size', 'Valve Size (Inch)')</th>
                                    <th scope="col">@sortablelink('product_rating', 'Valve Rating')</th>
                                    <th scope="col">@sortablelink('product_brand', 'Valve Brand')</th>
                                    <th scope="col">@sortablelink('product_valvemodel', 'Valve Model')</th>
                                    <th scope="col">@sortablelink('product_serial', 'Serial Number')</th>
                                    <th scope="col">@sortablelink('product_condi', 'Valve Condition')</th>
                                    <th scope="col">@sortablelink('product_actbrand', 'Actuator Brand')</th>
                                    <th scope="col">@sortablelink('product_acttype', 'Actuator Type')</th>
                                    <th scope="col">@sortablelink('product_actsize', 'Actuator Size')</th>
                                    <th scope="col">@sortablelink('product_fail', 'Fail Position')</th>
                                    <th scope="col">@sortablelink('product_actcond', 'Actuator Condition')</th>
                                    <th scope="col">@sortablelink('product_posbrand', 'Positioner Brand')</th>
                                    <th scope="col">@sortablelink('product_posmodel', 'Positioner Model')</th>
                                    <th scope="col">@sortablelink('product_inputsignal', 'Input Signal')</th>
                                    <th scope="col">@sortablelink('product_poscond', 'Positioner Condition')</th>
                                    <th scope="col">@sortablelink('product_other', 'Other Accessories')</th>
                                    <th scope="col">@sortablelink('product_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('product_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('product_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('product_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('product_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('product_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('product_station', 'Station')</th>
                                    <th scope="col">@sortablelink('product_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('product_project', 'Project')</th>
                                    <th scope="col">@sortablelink('product_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('product_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('product_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('product_curloc', 'Current Location')</th>
                                    <th scope="col">@sortablelink('product_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('product_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('product_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('product_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('product_stockqty', 'Stock Quantity')</th>
                                    <th scope="col">@sortablelink('product_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('product_targetpdn', 'TARGET PDN')</th>
                                    <th scope="col">@sortablelink('product_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('product_csnumber', 'CS Number')</th>
                                    <th scope="col">@sortablelink('product_cenumber', 'CE Number')</th>
                                    <th scope="col">@sortablelink('product_ronumber', 'RO Number')</th>
                                    <th scope="col">@sortablelink('product_startdate', 'Start Date')</th>
                                    <th scope="col">@sortablelink('product_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('product_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('product_remark', 'REMARK')</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ (($products->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $product->product_image ? asset($product->product_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>{{ $product->product_assetID }}</td>
                                    <td>{{ $product->product_newassetID }}</td>
                                    <td>{{ $product->product_equip }}</td>
                                    <td>{{ $product->product_type }}</td>
                                    <td>{{ $product->product_end }}</td>
                                    <td>{{ $product->product_size }}</td>
                                    <td>{{ $product->product_rating }}</td>
                                    <td>{{ $product->product_brand }}</td>
                                    <td>{{ $product->product_valvemodel }}</td>
                                    <td>{{ $product->product_serial }}</td>
                                    <td>{{ $product->product_condi }}</td>
                                    <td>{{ $product->product_actbrand }}</td>
                                    <td>{{ $product->product_acttype }}</td>
                                    <td>{{ $product->product_actsize }}</td>
                                    <td>{{ $product->product_fail }}</td>
                                    <td>{{ $product->product_actcond }}</td>
                                    <td>{{ $product->product_posbrand }}</td>
                                    <td>{{ $product->product_posmodel }}</td>
                                    <td>{{ $product->product_inputsignal }}</td>
                                    <td>{{ $product->product_poscond }}</td>
                                    <td>{{ $product->product_other }}</td>
                                    <td>{{ $product->product_datein }}</td>
                                    <td>{{ $product->product_transfer }}</td>
                                    <td>{{ $product->product_reser }}</td>
                                    <td>{{ $product->product_origin }}</td>
                                    <td>{{ $product->product_sdvin }}</td>
                                    <td>{{ $product->product_sdvout }}</td>
                                    <td>{{ $product->product_station }}</td>
                                    <td>{{ $product->product_requestor }}</td>
                                    <td>{{ $product->product_project }}</td>
                                    <td>{{ $product->product_dateout }}</td>
                                    <td>{{ $product->product_dateoffshore }}</td>
                                    <td>{{ $product->product_tfoffshore }}</td>
                                    <td>{{ $product->product_curloc }}</td>
                                    <td>{{ $product->product_stockin }}</td>
                                    {{-- <td>{{ $product->product_docin }}</td> --}}
                                    <td>
                                        @if($product->product_docin)
                                            <a href="{{ asset($product->product_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $product->product_stockout }}</td>
                                    <td>
                                        @if($product->product_docout)
                                            <a href="{{ asset($product->product_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>      
                                    <td>{{ $product->product_stockqty }}</td>
                                    <td>{{$product->product_uom }}</td>
                                    <td>{{ $product->product_targetpdn }}</td>
                                    <td>{{ $product->product_csrelease }}</td>
                                    <td>{{ $product->product_csnumber }}</td>
                                    <td>{{ $product->product_cenumber }}</td>
                                    <td>{{ $product->product_ronumber }}</td>
                                    <td>{{ $product->product_startdate }}</td>
                                    <td>{{ $product->product_enddate }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->product_remark }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
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

                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
