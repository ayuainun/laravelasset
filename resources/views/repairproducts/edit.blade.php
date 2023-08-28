@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Edit Item
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('repairproducts.index') }}">Repair Product Valve</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('repairproducts.update', $repairproduct->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- repairproduct image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Valve Image</div>
                    <div class="card-body text-center">
                        <!-- repairproduct image -->
                        <img class="img-account-profile mb-2" src="{{ $repairproduct->repairproduct_image ? asset($repairproduct->repairproduct_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- repairproduct image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- repairproduct image input -->
                        <input class="form-control form-control-solid mb-2 @error('repairproduct_image') is-invalid @enderror" type="file"  id="image" name="repairproduct_image" accept="image/*" onchange="previewImage();">
                        @error('repairproduct_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: repairproduct Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Detail Valve Repair 
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (repairproduct ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('repairproduct_assetID') is-invalid @enderror" id="repairproduct_assetID" name="repairproduct_assetID" type="text" placeholder="" value="{{ old('repairproduct_assetID', $repairproduct->repairproduct_assetID) }}" autocomplete="off"/>
                                @error('repairproduct_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('repairproduct_newassetID') is-invalid @enderror" id="repairproduct_newassetID" name="repairproduct_newassetID" type="text" placeholder="" value="{{ old('repairproduct_newassetID', $repairproduct->repairproduct_newassetID) }}" autocomplete="off"/>
                                @error('repairproduct_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (equipment) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_equip">Equipment</label>
                                <input class="form-control form-control-solid @error('repairproduct_equip') is-invalid @enderror" id="repairproduct_equip" name="repairproduct_equip" type="text" placeholder="" value="{{ old('repairproduct_equip', $repairproduct->repairproduct_equip) }}" autocomplete="off"/>
                                @error('repairproduct_equip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct type) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_unit">Valve Type</label>
                                    <select class="form-control form-control-solid @error('repairproduct_unit') is-invalid @enderror" id="repairproduct_unit" name="repairproduct_unit" autocomplete="off">
                                        <option selected="" disabled="">Select a type:</option>
                                        <option value="" {{ old('repairproduct_unit') === null ? 'selected' : '' }}>N/A</option>
                                        <option value="3 way Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == '3 way Valve' ? 'selected' : '' }}>3 way Valve</option>
                                        <option value="4 way Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == '4 way Valve' ? 'selected' : '' }}>4 way Valve</option>
                                        <option value="Actuator" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Actuator' ? 'selected' : '' }}>Actuator</option>
                                        <option value="Ball Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Ball Valve' ? 'selected' : '' }}>Ball Valve</option>
                                        <option value="Breather Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Breather Valve' ? 'selected' : '' }}>Breather Valve</option>
                                        <option value="Butterfly Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Butterfly Valve' ? 'selected' : '' }}>Butterfly Valve</option>
                                        <option value="Check Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Check Valve' ? 'selected' : '' }}>Check Valve</option>
                                        <option value="Choke Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Choke Valve' ? 'selected' : '' }}>Choke Valve</option>
                                        <option value="Control Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Control Valve' ? 'selected' : '' }}>Control Valve</option>
                                        <option value="Emergency Vent" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Emergency Vent' ? 'selected' : '' }}>Emergency Vent</option>
                                        <option value="Gate Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Gate Valve' ? 'selected' : '' }}>Gate Valve</option>
                                        <option value="Globe Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Globe Valve' ? 'selected' : '' }}>Globe Valve</option>
                                        <option value="Plug Valve" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Plug Valve' ? 'selected' : '' }}>Plug Valve</option>
                                        <option value="PSV" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'PSV' ? 'selected' : '' }}>PSV</option>
                                        <option value="Regulator" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Regulator' ? 'selected' : '' }}>Regulator</option>
                                        <option value="Rising Stem Ball Valves" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Rising Stem Ball Valves' ? 'selected' : '' }}>Rising Stem Ball Valves</option>
                                        <option value="Twin Seal" {{ old('repairproduct_unit', $repairproduct->repairproduct_unit) == 'Twin Seal' ? 'selected' : '' }}>Twin Seal</option>
                                    </select>
                                    @error('repairproduct_unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of repairproduct end connection) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_end" >End Connection</label>
                                    <select class="form-control form-control-solid @error('repairproduct_end') is-invalid @enderror" id="repairproduct_end" name="repairproduct_end" type="text" placeholder="" value="{{ old('repairproduct_end', $repairproduct->repairproduct_end) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a End Connection:</option>
                                        <option value="" {{ old('repairproduct_end') === null ? 'selected' : '' }}>N/A</option>
                                        <option value="FF" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'FF' ? 'selected' : '' }}>FF</option>
                                        <option value="RF" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'RF' ? 'selected' : '' }}>RF</option>
                                        <option value="RTJ" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'RTJ' ? 'selected' : '' }}>RTJ</option>
                                        <option value="NPT" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'NPT' ? 'selected' : '' }}>NPT</option>
                                        <option value="BSPT" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'BSPT' ? 'selected' : '' }}>BSPT</option>
                                        <option value="Buttweld" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'Buttweld' ? 'selected' : '' }}>Buttweld</option>
                                        <option value="Socket Weld" {{ old('repairproduct_type', $repairproduct->repairproduct_type) == 'Socket Weld' ? 'selected' : '' }}>Socket Weld</option>
                                    </select>
                                    @error('repairproduct_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of repairproduct size) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_size" >Valve Size (Inch)</label>
                                    <select class="form-control form-control-solid @error('repairproduct_size') is-invalid @enderror" id="repairproduct_size" name="repairproduct_size" type="text" placeholder="" value="{{ old('repairproduct_size', $repairproduct->repairproduct_size) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a size:</option>
                                        <option value="" {{ old('repairproduct_size') === null ? 'selected' : '' }}>N/A</option>
                                        <option>1/2</option>
                                        <option>3/4</option>
                                        <option>1</option>
                                        <option>1-1/4</option>
                                        <option>1-1/2</option>
                                        <option>2</option>
                                        <option>2-1/2</option>
                                        <option>3</option>
                                        <option>3-1/2</option>
                                        <option>4</option>
                                        <option>6</option>
                                        <option>8</option>
                                        <option>10</option>
                                        <option>12</option>
                                        <option>16</option>
                                        <option>24</option>
                                    </select>
                                    @error('repairproduct_size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of repairproduct rating) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_rating" >Valve Rating</label>
                                    <select class="form-control form-control-solid @error('repairproduct_rating') is-invalid @enderror" id="repairproduct_rating" name="repairproduct_rating" type="text" placeholder="" value="{{ old('repairproduct_rating', $repairproduct->repairproduct_rating) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a rating:</option>
                                        <option value="" {{ old('repairproduct_rating') === null ? 'selected' : '' }}>N/A</option>
                                        <option>150</option>
                                        <option>300</option>
                                        <option>600</option>
                                        <option>900</option>
                                        <option>1500</option>
                                        <option>2500</option>
                                    </select>
                                    @error('repairproduct_rating')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of repairproduct brand) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_brand" >Valve Brand</label>
                                    <select class="form-control form-control-solid @error('repairproduct_brand') is-invalid @enderror" id="repairproduct_brand" name="repairproduct_brand" type="text" placeholder="" value="{{ old('repairproduct_brand', $repairproduct->repairproduct_brand) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a brand:</option>
                                        <option value="" {{ old('repairproduct_brand') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Ace</option>
                                        <option>Adam's</option>
                                        <option>Anderson Greenwood</option>
                                        <option>Argus</option>
                                        <option>Bailey</option>
                                        <option>Bauman</option>
                                        <option>Bestobell</option>
                                        <option>Bettis</option>
                                        <option>Bopp & Reuther Messtechnik Gmbh</option>
                                        <option>Broady Flow Control Ltd.</option>
                                        <option>Cashco</option>
                                        <option>CCI</option>
                                        <option>Cla-Val Europe Sarl</option>
                                        <option>Contek</option>
                                        <option>Copes Vulcan</option>
                                        <option>Crosby</option>
                                        <option>Darling Muesco India</option>
                                        <option>Dezurik</option>
                                        <option>Dresser</option>
                                        <option>Edwards</option>
                                        <option>Farris</option>
                                        <option>Field Q</option>
                                        <option>Fisher</option>
                                        <option>Fukui</option>
                                        <option>Groth</option>
                                        <option>Gulde</option>
                                        <option>Hammel-Dahl</option>
                                        <option>Hills McCanna</option>
                                        <option>Honeywell</option>
                                        <option>Hopkinson</option>
                                        <option>J.B Rombach</option>
                                        <option>Jamesbury</option>
                                        <option>Keystone</option>
                                        <option>Kiely Mueller</option>
                                        <option>Leser</option>
                                        <option>Level Pot</option>
                                        <option>Magnatrol</option>
                                        <option>Masoneilan</option>
                                        <option>Mobrey</option>
                                        <option>Motoyama Eng.Works,Ltd.</option>
                                        <option>Neles</option>
                                        <option>Netherlocks Safety Systems Bv</option>
                                        <option>Nuovo Pignone, Spa</option>
                                        <option>Orbit</option>
                                        <option>Parcol, Spa</option>
                                        <option>Parker</option>
                                        <option>Peir Sampler</option>
                                        <option>Posi-Seal</option>
                                        <option>Research</option>
                                        <option>Rexroth</option>
                                        <option>Rockwell</option>
                                        <option>Rsbd(Weir Valves & Controls)</option>
                                        <option>Samson</option>
                                        <option>Sapac</option>
                                        <option>Sarasin</option>
                                        <option>Saunders</option>
                                        <option>Sempell</option>
                                        <option>Tai Milano S.P.A</option>
                                        <option>TBV</option>
                                        <option>Technical S.R.L</option>
                                        <option>Trueline Kace</option>
                                        <option>Tufline</option>
                                        <option>Valtek</option>
                                        <option>Valve Concepts</option>
                                        <option>Vanessa</option>
                                        <option>Velan</option>
                                        <option>WKM</option>
                                        <option>Xomox</option>
                                        <option>Yarway</option>
                                    </select>
                                    @error('repairproduct_brand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (repairproduct valve model) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_valvemodel">Valve Model</label>
                                <input class="form-control form-control-solid @error('repairproduct_valvemodel') is-invalid @enderror" id="repairproduct_valvemodel" name="repairproduct_valvemodel" type="text" placeholder="" value="{{ old('repairproduct_valvemodel', $repairproduct->repairproduct_valvemodel) }}" autocomplete="off"/>
                                @error('repairproduct_valvemodel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_serial">Serial Number </label>
                                <input class="form-control form-control-solid @error('repairproduct_serial') is-invalid @enderror" id="repairproduct_serial" name="repairproduct_serial" type="text" placeholder="" value="{{ old('repairproduct_serial', $repairproduct->repairproduct_serial) }}" autocomplete="off"/>
                                @error('repairproduct_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct valve condition) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_condi" >Valve Condition</label>
                                    <select class="form-control form-control-solid @error('repairproduct_condi') is-invalid @enderror" id="repairproduct_condi" name="repairproduct_condi" type="text" placeholder="" value="{{ old('repairproduct_condi', $repairproduct->repairproduct_condi) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a valve condition:</option>
                                        <option value="" {{ old('repairproduct_brand') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Retest</option>
                                        <option>Repair</option>
                                    </select>
                                    @error('repairproduct_condi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of repairproduct Actuator Brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_actbrand">Actuator Brand</label>
                                <input class="form-control form-control-solid @error('repairproduct_actbrand') is-invalid @enderror" id="repairproduct_actbrand" name="repairproduct_actbrand" type="text" placeholder="" value="{{ old('repairproduct_actbrand', $repairproduct->repairproduct_actbrand) }}" autocomplete="off"/>
                                @error('repairproduct_actbrand')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Actuator type) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_acttype">Actuator Type</label>
                                <input class="form-control form-control-solid @error('repairproduct_acttype') is-invalid @enderror" id="repairproduct_acttype" name="repairproduct_acttype" type="text" placeholder="" value="{{ old('repairproduct_acttype', $repairproduct->repairproduct_acttype) }}" autocomplete="off"/>
                                @error('repairproduct_acttype')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Actuator size) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_actsize">Actuator Size</label>
                                <input class="form-control form-control-solid @error('repairproduct_actsize') is-invalid @enderror" id="repairproduct_actsize" name="repairproduct_actsize" type="text" placeholder="" value="{{ old('repairproduct_actsize', $repairproduct->repairproduct_actsize) }}" autocomplete="off"/>
                                @error('repairproduct_actsize')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Fail Position) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_fail">Fail Position</label>
                                <input class="form-control form-control-solid @error('repairproduct_fail') is-invalid @enderror" id="repairproduct_fail" name="repairproduct_fail" type="text" placeholder="" value="{{ old('repairproduct_fail', $repairproduct->repairproduct_fail) }}" autocomplete="off"/>
                                @error('repairproduct_fail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Actuator Condition) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_actcond">Actuator Condition</label>
                                <input class="form-control form-control-solid @error('repairproduct_actcond') is-invalid @enderror" id="repairproduct_actcond" name="repairproduct_actcond" type="text" placeholder="" value="{{ old('repairproduct_actcond', $repairproduct->repairproduct_actcond) }}" autocomplete="off"/>
                                @error('repairproduct_actcond')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Positioner Brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_posbrand">Positioner Brand</label>
                                <input class="form-control form-control-solid @error('repairproduct_posbrand') is-invalid @enderror" id="repairproduct_posbrand" name="repairproduct_posbrand" type="text" placeholder="" value="{{ old('repairproduct_posbrand', $repairproduct->repairproduct_posbrand) }}" autocomplete="off"/>
                                @error('repairproduct_posbrand')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Positioner model) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_posmodel">Positioner Model</label>
                                <input class="form-control form-control-solid @error('repairproduct_posmodel') is-invalid @enderror" id="repairproduct_posmodel" name="repairproduct_posmodel" type="text" placeholder="" value="{{ old('repairproduct_posmodel', $repairproduct->repairproduct_posmodel) }}" autocomplete="off"/>
                                @error('repairproduct_posmodel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct inputsignal) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_inputsignal">Input Signal </label>
                                <input class="form-control form-control-solid @error('repairproduct_inputsignal') is-invalid @enderror" id="repairproduct_inputsignal" name="repairproduct_inputsignal" type="text" placeholder="" value="{{ old('repairproduct_inputsignal', $repairproduct->repairproduct_inputsignal) }}" autocomplete="off"/>
                                @error('repairproduct_inputsignal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of repairproduct Positioner condition) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_poscond">Positioner Condition</label>
                                <input class="form-control form-control-solid @error('repairproduct_poscond') is-invalid @enderror" id="repairproduct_poscond" name="repairproduct_poscond" type="text" placeholder="" value="{{ old('repairproduct_poscond', $repairproduct->repairproduct_poscond) }}" autocomplete="off"/>
                                @error('repairproduct_poscond')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct other) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_other">Other Accessories </label>
                                <input class="form-control form-control-solid @error('repairproduct_other') is-invalid @enderror" id="repairproduct_other" name="repairproduct_other" type="text" placeholder="" value="{{ old('repairproduct_other', $repairproduct->repairproduct_other) }}" autocomplete="off"/>
                                @error('repairproduct_other')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="repairproduct_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('repairproduct_datein') is-invalid @enderror" name="repairproduct_datein" id="repairproduct_datein" type="date" placeholder="" value="{{ old('repairproduct_datein', $repairproduct->repairproduct_datein) }}" autocomplete="off"/>
                                @error('repairproduct_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_transfer">Material Transfer</label>
                                <input class="form-control form-control-solid @error('repairproduct_transfer') is-invalid @enderror" id="repairproduct_transfer" name="repairproduct_transfer" type="text" placeholder="" value="{{ old('repairproduct_transfer', $repairproduct->repairproduct_transfer) }}" autocomplete="off"/>
                                @error('repairproduct_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('repairproduct_reser') is-invalid @enderror" id="repairproduct_reser" name="repairproduct_reser" type="text" placeholder="" value="{{ old('repairproduct_reser', $repairproduct->repairproduct_reser) }}" autocomplete="off"/>
                                @error('repairproduct_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_origin">Ex Station</label>
                                <input class="form-control form-control-solid @error('repairproduct_origin') is-invalid @enderror" id="repairproduct_origin" name="repairproduct_origin" type="text" placeholder="" value="{{ old('repairproduct_origin', $repairproduct->repairproduct_origin) }}" autocomplete="off"/>
                                @error('repairproduct_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('repairproduct_sdvin') is-invalid @enderror" id="repairproduct_sdvin" name="repairproduct_sdvin" type="text" placeholder="" value="{{ old('repairproduct_sdvin', $repairproduct->repairproduct_sdvin) }}" autocomplete="off"/>
                                @error('repairproduct_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('repairproduct_sdvout') is-invalid @enderror" id="repairproduct_sdvout" name="repairproduct_sdvout" type="text" placeholder="" value="{{ old('repairproduct_sdvout', $repairproduct->repairproduct_sdvout) }}" autocomplete="off"/>
                                @error('repairproduct_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_station">Station</label>
                                <input class="form-control form-control-solid @error('repairproduct_station') is-invalid @enderror" id="repairproduct_station" name="repairproduct_station" type="text" placeholder="" value="{{ old('repairproduct_station', $repairproduct->repairproduct_station) }}" autocomplete="off"/>
                                @error('repairproduct_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('repairproduct_requestor') is-invalid @enderror" id="repairproduct_requestor" name="repairproduct_requestor" type="text" placeholder="" value="{{ old('repairproduct_requestor', $repairproduct->repairproduct_requestor) }}" autocomplete="off"/>
                                @error('repairproduct_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_project">Project</label>
                                <input class="form-control form-control-solid @error('repairproduct_project') is-invalid @enderror" id="repairproduct_project" name="repairproduct_project" type="text" placeholder="" value="{{ old('repairproduct_project', $repairproduct->repairproduct_project) }}" autocomplete="off"/>
                                @error('repairproduct_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="repairproduct_dateout">Date Out</span></label>
                                <input class="form-control form-control-solid example-date-input @error('repairproduct_dateout') is-invalid @enderror" name="repairproduct_dateout" id="repairproduct_dateout" type="date" value="{{ old('repairproduct_dateout', $repairproduct->repairproduct_dateout) }}" autocomplete="off">
                                @error('repairproduct_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="repairproduct_dateoffshore">Date to offshore</span></label>
                                <input class="form-control form-control-solid example-date-input @error('repairproduct_dateoffshore') is-invalid @enderror" name="repairproduct_dateoffshore" id="repairproduct_dateoffshore" type="date" value="{{ old('repairproduct_dateoffshore', $repairproduct->repairproduct_dateoffshore) }}" autocomplete="off">
                                @error('repairproduct_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('repairproduct_tfoffshore') is-invalid @enderror" id="repairproduct_tfoffshore" name="repairproduct_tfoffshore" type="text" placeholder="" value="{{ old('repairproduct_tfoffshore', $repairproduct->repairproduct_tfoffshore) }}" autocomplete="off"/>
                                @error('repairproduct_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('repairproduct_curloc') is-invalid @enderror" id="repairproduct_curloc" name="repairproduct_curloc" type="text" placeholder="" value="{{ old('repairproduct_curloc', $repairproduct->repairproduct_curloc) }}" autocomplete="off"/>
                                @error('repairproduct_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockIn) -->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="repairproduct_stockin">Stock In</label>
                                    <input class="form-control form-control-solid @error('repairproduct_stockin') is-invalid @enderror" id="repairproduct_stockin" name="repairproduct_stockin" type="text" placeholder="" value="{{ old('repairproduct_stockin', $repairproduct->repairproduct_stockin) }}" autocomplete="off"/>
                                    @error('repairproduct_stockin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('repairproduct_docin') is-invalid @enderror" type="file"  id="repairproduct_docin" name="repairproduct_docin" accept=".pdf,.doc,.docx">
                                @error('repairproduct_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('repairproduct_stockout') is-invalid @enderror" id="repairproduct_stockout" name="repairproduct_stockout" type="text" placeholder="" value="{{ old('repairproduct_stockout', $repairproduct->repairproduct_stockout) }}" autocomplete="off"/>
                                @error('repairproduct_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('repairproduct_docout') is-invalid @enderror" type="file"  id="repairproduct_docout" name="repairproduct_docout" accept=".pdf,.doc,.docx">
                                @error('repairproduct_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_stockqty">Stock Quality</label>
                                <input class="form-control form-control-solid @error('repairproduct_stockqty') is-invalid @enderror" id="repairproduct_stockqty" name="repairproduct_stockqty" type="text" placeholder="" value="{{ old('repairproduct_stockqty', $repairproduct->repairproduct_stockqty) }}" autocomplete="off"/>
                                @error('repairproduct_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('repairproduct_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('repairproduct_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('repairproduct_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('repairproduct_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('repairproduct_stockout').addEventListener('change', calculateStockQty);
                                </script>
                            </div>
                            <!-- Form Group (type of repairproduct UOM) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('repairproduct_uom') is-invalid @enderror" id="repairproduct_uom" name="repairproduct_uom" type="text" placeholder="" value="{{ old('repairproduct_uom', $repairproduct->repairproduct_uom) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a UOM:</option>
                                        <option value="" {{ old('repairproduct_uom') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Box</option>
                                        <option>Bundle</option>
                                        <option>Carton</option>
                                        <option>Case</option>
                                        <option>Dozen</option>
                                        <option>Each</option>
                                        <option>Gallon</option>
                                        <option>Joint (3 meter)</option>
                                        <option>Joint (6 meter)</option>
                                        <option>Kilogram</option>
                                        <option>Liter</option>
                                        <option>Meter</option>
                                        <option>Ounce</option>
                                        <option>Pair</option>
                                        <option>Pallet</option>
                                        <option>Pc</option>
                                        <option>Pound</option>
                                        <option>Roll</option>
                                        <option>Set</option>
                                        <option>Ton</option>
                                    </select>
                                    @error('repairproduct_uom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="repairproduct_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('repairproduct_targetpdn') is-invalid @enderror" name="repairproduct_targetpdn" id="repairproduct_targetpdn" type="date" value="{{ old('repairproduct_targetpdn', $repairproduct->repairproduct_targetpdn) }}">
                                @error('repairproduct_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('repairproduct_csrelease') is-invalid @enderror" id="repairproduct_csrelease" name="repairproduct_csrelease" type="text" placeholder="" value="{{ old('repairproduct_csrelease', $repairproduct->repairproduct_csrelease) }}" autocomplete="off"/>
                                @error('repairproduct_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('repairproduct_csnumber') is-invalid @enderror" id="repairproduct_csnumber" name="repairproduct_csnumber" type="text" placeholder="" value="{{ old('repairproduct_csnumber', $repairproduct->repairproduct_csnumber) }}" autocomplete="off"/>
                                @error('repairproduct_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('repairproduct_cenumber') is-invalid @enderror" id="repairproduct_cenumber" name="repairproduct_cenumber" type="text" placeholder="" value="{{ old('repairproduct_cenumber', $repairproduct->repairproduct_cenumber) }}" autocomplete="off"/>
                                @error('repairproduct_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('repairproduct_ronumber') is-invalid @enderror" id="repairproduct_ronumber" name="repairproduct_ronumber" type="text" placeholder="" value="{{ old('repairproduct_ronumber', $repairproduct->repairproduct_ronumber) }}" autocomplete="off"/>
                                @error('repairproduct_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="repairproduct_startdate">Start Date</span></label>
                                <input class="form-control form-control-solid example-date-input @error('repairproduct_startdate') is-invalid @enderror" name="repairproduct_startdate" id="repairproduct_startdate" type="date" value="{{ old('repairproduct_startdate', $repairproduct->repairproduct_startdate) }}">
                                @error('repairproduct_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="repairproduct_enddate">End Date</span></label>
                                <input class="form-control form-control-solid example-date-input @error('repairproduct_enddate') is-invalid @enderror" name="repairproduct_enddate" id="repairproduct_enddate" type="date" value="{{ old('repairproduct_enddate', $repairproduct->repairproduct_enddate) }}">
                                @error('repairproduct_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (repairproduct price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('repairproduct_price') is-invalid @enderror" id="repairproduct_price" name="repairproduct_price" type="text" placeholder="" value="{{ old('repairproduct_price') }}" autocomplete="off"/>
                                @error('repairproduct_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk mengubah format input menjadi rupiah
                                    function formatRupiah(angka) {
                                        var number_string = angka.toString().replace(/[^,\d]/g, ''),
                                            split = number_string.split(','),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                
                                        if (ribuan) {
                                            separator = sisa ? '.' : '';
                                            rupiah += separator + ribuan.join('.');
                                        }
                                
                                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                        return rupiah;
                                    }
                                
                                    // Event listener untuk mengubah format rupiah saat input berubah
                                    var productPriceInput = document.getElementById('repairproduct_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('repairproduct_price').value;
                                    document.getElementById('repairproduct_price').value = formatRupiah(initialValue);
                                </script> 
                            </div>
                            <!-- Form Group (status) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="repairproduct_status" >Status</label>
                                    <select class="form-control form-control-solid @error('repairproduct_status') is-invalid @enderror" id="repairproduct_status" name="repairproduct_status" status="text" placeholder="" value="{{ old('repairproduct_status', $repairproduct->repairproduct) }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a status:</option>
                                    <option value="" {{ old('repairproduct_status') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Incoming</option>
                                        <option>Outgoing</option>
                                        <option>At Workshop</option>
                                    </select>
                                    @error('repairproduct_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>  
                            <!-- Form Group (repairproduct Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="repairproduct_remark">Remark</label>
                                <input class="form-control form-control-solid @error('repairproduct_remark') is-invalid @enderror" id="repairproduct_remark" name="repairproduct_remark" type="text" placeholder="" value="{{ old('repairproduct_remark', $repairproduct->repairproduct_remark) }}" autocomplete="off"/>
                                @error('repairproduct_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('repairproducts.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: repairproduct Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
