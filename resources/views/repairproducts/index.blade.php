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
                        Valve Repair List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('repairproducts.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import</a>
                    <a href="{{ route('repairproducts.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export</a>
                    <a href="{{ route('repairproducts.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('repairproducts.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
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
                    <form action="{{ route('repairproducts.index') }}" method="GET">
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
                                    <th scope="col">@sortablelink('repairproduct_status', 'Status')</th>
                                    {{-- <th scope="col">@sortablelink('repairproduct_assetID', 'Old ID')</th> --}}
                                    <th scope="col">@sortablelink('repairproduct_newassetID', 'Asset ID')</th>
                                    {{-- <th scope="col">@sortablelink('repairproduct_equip', 'Equipment')</th> --}}
                                    <th scope="col">@sortablelink('repairproduct_unit', 'Valve Type')</th>
                                    <th scope="col">@sortablelink('repairproduct_end', 'End Connection')</th>
                                    <th scope="col">@sortablelink('repairproduct_size', 'Valve Size (Inch)')</th>
                                    <th scope="col">@sortablelink('repairproduct_rating', 'Valve Rating')</th>
                                    <th scope="col">@sortablelink('repairproduct_brand', 'Valve Brand')</th>
                                    <th scope="col">@sortablelink('repairproduct_valvemodel', 'Valve Model')</th>
                                    {{-- <th scope="col">@sortablelink('repairproduct_serial', 'Serial Number')</th>
                                    <th scope="col">@sortablelink('repairproduct_condi', 'Valve Condition')</th>
                                    <th scope="col">@sortablelink('repairproduct_actbrand', 'Actuator Brand')</th>
                                    <th scope="col">@sortablelink('repairproduct_acttype', 'Actuator Type')</th>
                                    <th scope="col">@sortablelink('repairproduct_actsize', 'Actuator Size')</th>
                                    <th scope="col">@sortablelink('repairproduct_fail', 'Fail Position')</th>
                                    <th scope="col">@sortablelink('repairproduct_actcond', 'Actuator Condition')</th>
                                    <th scope="col">@sortablelink('repairproduct_posbrand', 'Positioner Brand')</th>
                                    <th scope="col">@sortablelink('repairproduct_posmodel', 'Positioner Model')</th>
                                    <th scope="col">@sortablelink('repairproduct_inputsignal', 'Input Signal')</th>
                                    <th scope="col">@sortablelink('repairproduct_poscond', 'Positioner Condition')</th>
                                    <th scope="col">@sortablelink('repairproduct_other', 'Other Accessories')</th>
                                    <th scope="col">@sortablelink('repairproduct_datein', 'Date In')</th>
                                    <th scope="col">@sortablelink('repairproduct_transfer', 'Material Transfer')</th>
                                    <th scope="col">@sortablelink('repairproduct_reser', 'Reservation Number')</th>
                                    <th scope="col">@sortablelink('repairproduct_origin', 'Ex Station')</th>
                                    <th scope="col">@sortablelink('repairproduct_sdvin', 'SDV In')</th>
                                    <th scope="col">@sortablelink('repairproduct_sdvout', 'SDV Out')</th>
                                    <th scope="col">@sortablelink('repairproduct_station', 'Station')</th>
                                    <th scope="col">@sortablelink('repairproduct_requestor', 'Requestor')</th>
                                    <th scope="col">@sortablelink('repairproduct_project', 'Project')</th>
                                    <th scope="col">@sortablelink('repairproduct_dateout', 'Date Out')</th>
                                    <th scope="col">@sortablelink('repairproduct_dateoffshore', 'Date to offshore')</th>
                                    <th scope="col">@sortablelink('repairproduct_tfoffshore', 'Material transfer to offshore')</th>
                                    <th scope="col">@sortablelink('repairproduct_curloc', 'Current Location')</th> --}}
                                    <th scope="col">@sortablelink('repairproduct_stockin', 'Stock In')</th>
                                    <th scope="col">@sortablelink('repairproduct_docin', 'Dok Stock In')</th>
                                    <th scope="col">@sortablelink('repairproduct_stockout', 'Stock Out')</th>
                                    <th scope="col">@sortablelink('repairproduct_docout', 'Dok Stock Out')</th>
                                    <th scope="col">@sortablelink('repairproduct_stockqty', 'Stock Quantity')</th>
                                    {{-- <th scope="col">@sortablelink('repairproduct_uom', 'UOM')</th>
                                    <th scope="col">@sortablelink('repairproduct_targetpdn', 'TARGET PDN')</th>
                                    <th scope="col">@sortablelink('repairproduct_csrelease', 'CS Release')</th>
                                    <th scope="col">@sortablelink('repairproduct_csnumber', 'CS Number')</th>
                                    <th scope="col">@sortablelink('repairproduct_cenumber', 'CE Number')</th> --}}
                                    <th scope="col">@sortablelink('repairproduct_ronumber', 'RO Number')</th>
                                    <th scope="col">@sortablelink('repairproduct_startdate', 'Start Date')</th>
                                    {{-- <th scope="col">@sortablelink('repairproduct_enddate', 'End Date')</th>
                                    <th scope="col">@sortablelink('repairproduct_price', 'Price Repair')</th>
                                    <th scope="col">@sortablelink('repairproduct_remark', 'REMARK')</th> --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($repairproducts as $repairproduct)
                                <tr>
                                    <th scope="row">{{ (($repairproducts->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid" src="{{ $repairproduct->repairproduct_image ? asset($repairproduct->repairproduct_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-box
                                          @if($repairproduct->repairproduct_status == 'Incoming')
                                            bg-success
                                          @elseif($repairproduct->repairproduct_status == 'Outgoing')
                                            bg-danger
                                          @else
                                            bg-info
                                          @endif">
                                          <span class="status-text
                                            @if($repairproduct->repairproduct_status == 'Incoming')
                                              text-white
                                            @elseif($repairproduct->repairproduct_status == 'Outgoing')
                                              text-white
                                            @else($repairproduct->repairproduct_status == 'Workshop')
                                              text-white
                                            @endif">
                                            @if($repairproduct->repairproduct_status == 'Incoming')
                                              Incoming
                                            @elseif($repairproduct->repairproduct_status == 'Outgoing')
                                              Outgoing
                                            @else
                                              Workshop
                                            @endif
                                          </span>
                                        </div>
                                      </td>                        
                                    {{-- <td>{{ $repairproduct->repairproduct_assetID }}</td> --}}
                                    <td>{{ $repairproduct->repairproduct_newassetID }}</td>
                                    {{-- <td>{{ $repairproduct->repairproduct_equip }}</td> --}}
                                    <td>{{ $repairproduct->repairproduct_unit }}</td>
                                    <td>{{ $repairproduct->repairproduct_end }}</td>
                                    <td>{{ $repairproduct->repairproduct_size }}</td>
                                    <td>{{ $repairproduct->repairproduct_rating }}</td>
                                    <td>{{ $repairproduct->repairproduct_brand }}</td>
                                    <td>{{ $repairproduct->repairproduct_valvemodel }}</td>
                                    {{-- <td>{{ $repairproduct->repairproduct_serial }}</td>
                                    <td>{{ $repairproduct->repairproduct_condi }}</td>
                                    <td>{{ $repairproduct->repairproduct_actbrand }}</td>
                                    <td>{{ $repairproduct->repairproduct_acttype }}</td>
                                    <td>{{ $repairproduct->repairproduct_actsize }}</td>
                                    <td>{{ $repairproduct->repairproduct_fail }}</td>
                                    <td>{{ $repairproduct->repairproduct_actcond }}</td>
                                    <td>{{ $repairproduct->repairproduct_posbrand }}</td>
                                    <td>{{ $repairproduct->repairproduct_posmodel }}</td>
                                    <td>{{ $repairproduct->repairproduct_inputsignal }}</td>
                                    <td>{{ $repairproduct->repairproduct_poscond }}</td>
                                    <td>{{ $repairproduct->repairproduct_other }}</td>
                                    <td>{{ $repairproduct->repairproduct_datein }}</td>
                                    <td>{{ $repairproduct->repairproduct_transfer }}</td>
                                    <td>{{ $repairproduct->repairproduct_reser }}</td>
                                    <td>{{ $repairproduct->repairproduct_origin }}</td>
                                    <td>{{ $repairproduct->repairproduct_sdvin }}</td>
                                    <td>{{ $repairproduct->repairproduct_sdvout }}</td>
                                    <td>{{ $repairproduct->repairproduct_station }}</td>
                                    <td>{{ $repairproduct->repairproduct_requestor }}</td>
                                    <td>{{ $repairproduct->repairproduct_project }}</td>
                                    <td>{{ $repairproduct->repairproduct_dateout }}</td>
                                    <td>{{ $repairproduct->repairproduct_dateoffshore }}</td>
                                    <td>{{ $repairproduct->repairproduct_tfoffshore }}</td>
                                    <td>{{ $repairproduct->repairproduct_curloc }}</td> --}}
                                    <td>{{ $repairproduct->repairproduct_stockin }}</td>
                                    <td>
                                        @if($repairproduct->repairproduct_docin)
                                            <a href="{{ asset($repairproduct->repairproduct_docin) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $repairproduct->repairproduct_stockout }}</td>
                                    <td>
                                        @if($repairproduct->repairproduct_docout)
                                            <a href="{{ asset($repairproduct->repairproduct_docout) }}" target="_blank"><button class="btn btn-success">Download</button></a>
                                        @else
                                            No Document Available
                                        @endif
                                    </td>
                                    <td>{{ $repairproduct->repairproduct_stockqty }}</td>
                                    {{-- <td>{{ $repairproduct->repairproduct_uom }}</td>
                                    <td>{{ $repairproduct->repairproduct_targetpdn }}</td>
                                    <td>{{ $repairproduct->repairproduct_csrelease }}</td>
                                    <td>{{ $repairproduct->repairproduct_csnumber }}</td> --}}
                                    <td>{{ $repairproduct->repairproduct_cenumber }}</td>
                                    <td>{{ $repairproduct->repairproduct_ronumber }}</td>
                                    {{-- <td>{{ $repairproduct->repairproduct_startdate }}</td>
                                    <td>{{ $repairproduct->repairproduct_enddate }}</td>
                                    <td>{{ $repairproduct->repairproduct_price }}</td>
                                    <td>{{ $repairproduct->repairproduct_remark }}</td> --}}
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('repairproducts.show', $repairproduct->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('repairproducts.edit', $repairproduct->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('repairproducts.destroy', $repairproduct->id) }}" method="POST">
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

                {{ $repairproducts->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
