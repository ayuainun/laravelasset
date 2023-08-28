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
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product Valve</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Valve Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ $product->product_image ? asset($product->product_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('product_image') is-invalid @enderror" type="file"  id="image" name="product_image" accept="image/*" onchange="previewImage();">
                        @error('product_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Detail Valve
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (status) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_status" >Status</label>
                                    <select class="form-control form-control-solid @error('product_status') is-invalid @enderror" id="product_status" name="product_status" status="text" placeholder="" value="{{ old('product_status', $product->product_status) }}" autocomplete="off"/>
                                    <option selected="" disabled="">Select a status:</option>
                                    <option value="" {{ old('product_status') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Incoming</option>
                                        <option>Outgoing</option>
                                        <option>At Workshop</option>
                                    </select>
                                    @error('product_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>  
                            <!-- Form Group (product ID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_assetID">Old ID</label>
                                <input class="form-control form-control-solid @error('product_assetID') is-invalid @enderror" id="product_assetID" name="product_assetID" type="text" placeholder="" value="{{ old('product_assetID', $product->product_assetID) }}" autocomplete="off"/>
                                @error('product_assetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product New AssetID) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_newassetID">New ID</label>
                                <input class="form-control form-control-solid @error('product_newassetID') is-invalid @enderror" id="product_newassetID" name="product_newassetID" type="text" placeholder="" value="{{ old('product_newassetID', $product->product_newassetID) }}" autocomplete="off"/>
                                @error('product_newassetID')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (equipment) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_equip">Equipment</label>
                                <input class="form-control form-control-solid @error('product_equip') is-invalid @enderror" id="product_equip" name="product_equip" type="text" placeholder="" value="{{ old('product_equip', $product->product_equip) }}" autocomplete="off"/>
                                @error('product_equip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product type) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="product_type">Valve Type</label>
                                        <select class="form-control form-control-solid @error('product_type') is-invalid @enderror" id="product_type" name="product_type" autocomplete="off">
                                            <option selected="" disabled="">Select a type:</option>
                                            <option value="" {{ old('product_type') === null ? 'selected' : '' }}>N/A</option>
                                            <option value="3 way Valve" {{ old('product_type', $product->product_type) == '3 way Valve' ? 'selected' : '' }}>3 way Valve</option>
                                            <option value="4 way Valve" {{ old('product_type', $product->product_type) == '4 way Valve' ? 'selected' : '' }}>4 way Valve</option>
                                            <option value="Actuator" {{ old('product_type', $product->product_type) == 'Actuator' ? 'selected' : '' }}>Actuator</option>
                                            <option value="Ball Valve" {{ old('product_type', $product->product_type) == 'Ball Valve' ? 'selected' : '' }}>Ball Valve</option>
                                            <option value="Breather Valve" {{ old('product_type', $product->product_type) == 'Breather Valve' ? 'selected' : '' }}>Breather Valve</option>
                                            <option value="Butterfly Valve" {{ old('product_type', $product->product_type) == 'Butterfly Valve' ? 'selected' : '' }}>Butterfly Valve</option>
                                            <option value="Check Valve" {{ old('product_type', $product->product_type) == 'Check Valve' ? 'selected' : '' }}>Check Valve</option>
                                            <option value="Choke Valve" {{ old('product_type', $product->product_type) == 'Choke Valve' ? 'selected' : '' }}>Choke Valve</option>
                                            <option value="Control Valve" {{ old('product_type', $product->product_type) == 'Control Valve' ? 'selected' : '' }}>Control Valve</option>
                                            <option value="Emergency Vent" {{ old('product_type', $product->product_type) == 'Emergency Vent' ? 'selected' : '' }}>Emergency Vent</option>
                                            <option value="Gate Valve" {{ old('product_type', $product->product_type) == 'Gate Valve' ? 'selected' : '' }}>Gate Valve</option>
                                            <option value="Globe Valve" {{ old('product_type', $product->product_type) == 'Globe Valve' ? 'selected' : '' }}>Globe Valve</option>
                                            <option value="Plug Valve" {{ old('product_type', $product->product_type) == 'Plug Valve' ? 'selected' : '' }}>Plug Valve</option>
                                            <option value="PSV" {{ old('product_type', $product->product_type) == 'PSV' ? 'selected' : '' }}>PSV</option>
                                            <option value="Regulator" {{ old('product_type', $product->product_type) == 'Regulator' ? 'selected' : '' }}>Regulator</option>
                                            <option value="Rising Stem Ball Valves" {{ old('product_type', $product->product_type) == 'Rising Stem Ball Valves' ? 'selected' : '' }}>Rising Stem Ball Valves</option>
                                            <option value="Twin Seal" {{ old('product_type', $product->product_type) == 'Twin Seal' ? 'selected' : '' }}>Twin Seal</option>
                                        </select>
                                        @error('product_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>                                
                            {{-- </div> --}}
                            <!-- Form Group (type of product end connection) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_end" >End Connection</label>
                                    <select class="form-control form-control-solid @error('product_end') is-invalid @enderror" id="product_end" name="product_end" type="text" placeholder="" value="{{ old('product_end', $product->product_end) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a End Connection:</option>
                                        <option value="" {{ old('product_end') === null ? 'selected' : '' }}>N/A</option>
                                        <option value="FF" {{ old('product_type', $product->product_type) == 'FF' ? 'selected' : '' }}>FF</option>
                                        <option value="RF" {{ old('product_type', $product->product_type) == 'RF' ? 'selected' : '' }}>RF</option>
                                        <option value="RTJ" {{ old('product_type', $product->product_type) == 'RTJ' ? 'selected' : '' }}>RTJ</option>
                                        <option value="NPT" {{ old('product_type', $product->product_type) == 'NPT' ? 'selected' : '' }}>NPT</option>
                                        <option value="BSPT" {{ old('product_type', $product->product_type) == 'BSPT' ? 'selected' : '' }}>BSPT</option>
                                        <option value="Buttweld" {{ old('product_type', $product->product_type) == 'Buttweld' ? 'selected' : '' }}>Buttweld</option>
                                        <option value="Socket Weld" {{ old('product_type', $product->product_type) == 'Socket Weld' ? 'selected' : '' }}>Socket Weld</option>
                                    </select>
                                    @error('product_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of product size) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_size" >Valve Size (Inch)</label>
                                    <select class="form-control form-control-solid @error('product_size') is-invalid @enderror" id="product_size" name="product_size" type="text" placeholder="" value="{{ old('product_size', $product->product_size) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a size:</option>
                                        <option value="" {{ old('product_size') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('product_size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of product rating) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_rating" >Valve Rating</label>
                                    <select class="form-control form-control-solid @error('product_rating') is-invalid @enderror" id="product_rating" name="product_rating" type="text" placeholder="" value="{{ old('product_rating', $product->product_rating) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a rating:</option>
                                        <option value="" {{ old('product_rating') === null ? 'selected' : '' }}>N/A</option>
                                        <option>150</option>
                                        <option>300</option>
                                        <option>600</option>
                                        <option>900</option>
                                        <option>1500</option>
                                        <option>2500</option>
                                    </select>
                                    @error('product_rating')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of product brand) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_brand" >Valve Brand</label>
                                    <select class="form-control form-control-solid @error('product_brand') is-invalid @enderror" id="product_brand" name="product_brand" type="text" placeholder="" value="{{ old('product_brand', $product->product_brand) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a brand:</option>
                                        <option value="" {{ old('product_brand') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('product_brand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (product valve model) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_valvemodel">Valve Model</label>
                                <input class="form-control form-control-solid @error('product_valvemodel') is-invalid @enderror" id="product_valvemodel" name="product_valvemodel" type="text" placeholder="" value="{{ old('product_valvemodel', $product->product_valvemodel) }}" autocomplete="off"/>
                                @error('product_valvemodel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product serial) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_serial">Serial Number</label>
                                <input class="form-control form-control-solid @error('product_serial') is-invalid @enderror" id="product_serial" name="product_serial" type="text" placeholder="" value="{{ old('product_serial', $product->product_serial) }}" autocomplete="off"/>
                                @error('product_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product valve condition) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_condi" >Valve Condition</label>
                                    <select class="form-control form-control-solid @error('product_condi') is-invalid @enderror" id="product_condi" name="product_condi" type="text" placeholder="" value="{{ old('product_condi', $product->product_condi) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a valve condition:</option>
                                        <option value="" {{ old('product_brand') === null ? 'selected' : '' }}>N/A</option>
                                        <option>Retest</option>
                                        <option>Repair</option>
                                    </select>
                                    @error('product_condi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (type of product Actuator Brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_actbrand">Actuator Brand</label>
                                <input class="form-control form-control-solid @error('product_actbrand') is-invalid @enderror" id="product_actbrand" name="product_actbrand" type="text" placeholder="" value="{{ old('product_actbrand', $product->product_actbrand) }}" autocomplete="off"/>
                                @error('product_actbrand')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Actuator type) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_acttype">Actuator Type</label>
                                <input class="form-control form-control-solid @error('product_acttype') is-invalid @enderror" id="product_acttype" name="product_acttype" type="text" placeholder="" value="{{ old('product_acttype', $product->product_acttype) }}" autocomplete="off"/>
                                @error('product_acttype')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Actuator size) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_actsize">Actuator Size</label>
                                <input class="form-control form-control-solid @error('product_actsize') is-invalid @enderror" id="product_actsize" name="product_actsize" type="text" placeholder="" value="{{ old('product_actsize', $product->product_actsize) }}" autocomplete="off"/>
                                @error('product_actsize')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Fail Position) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_fail">Fail Position</label>
                                <input class="form-control form-control-solid @error('product_fail') is-invalid @enderror" id="product_fail" name="product_fail" type="text" placeholder="" value="{{ old('product_fail', $product->product_fail) }}" autocomplete="off"/>
                                @error('product_fail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Actuator Condition) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_actcond">Actuator Condition</label>
                                <input class="form-control form-control-solid @error('product_actcond') is-invalid @enderror" id="product_actcond" name="product_actcond" type="text" placeholder="" value="{{ old('product_actcond', $product->product_actcond) }}" autocomplete="off"/>
                                @error('product_actcond')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Positioner Brand) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_posbrand">Positioner Brand</label>
                                <input class="form-control form-control-solid @error('product_posbrand') is-invalid @enderror" id="product_posbrand" name="product_posbrand" type="text" placeholder="" value="{{ old('product_posbrand', $product->product_posbrand) }}" autocomplete="off"/>
                                @error('product_posbrand')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Positioner model) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_posmodel">Positioner Model</label>
                                <input class="form-control form-control-solid @error('product_posmodel') is-invalid @enderror" id="product_posmodel" name="product_posmodel" type="text" placeholder="" value="{{ old('product_posmodel', $product->product_posmodel) }}" autocomplete="off"/>
                                @error('product_posmodel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product inputsignal) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_inputsignal">Input Signal </label>
                                <input class="form-control form-control-solid @error('product_inputsignal') is-invalid @enderror" id="product_inputsignal" name="product_inputsignal" type="text" placeholder="" value="{{ old('product_inputsignal', $product->product_inputsignal) }}" autocomplete="off"/>
                                @error('product_inputsignal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product Positioner condition) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_poscond">Positioner Condition</label>
                                <input class="form-control form-control-solid @error('product_poscond') is-invalid @enderror" id="product_poscond" name="product_poscond" type="text" placeholder="" value="{{ old('product_poscond', $product->product_poscond) }}" autocomplete="off"/>
                                @error('product_poscond')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product other) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_other">Other Accessories</label>
                                <input class="form-control form-control-solid @error('product_other') is-invalid @enderror" id="product_other" name="product_other" type="text" placeholder="" value="{{ old('product_other', $product->product_other) }}" autocomplete="off"/>
                                @error('product_other')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date In) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_datein">Date In</label>
                                <input class="form-control form-control-solid example-date-input @error('product_datein') is-invalid @enderror" name="product_datein" id="product_datein" type="date" placeholder="" value="{{ old('product_datein', $product->product_datein) }}" autocomplete="off"/>
                                @error('product_datein')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_transfer">Material Transfer</label>
                                <input class="form-control form-control-solid @error('product_transfer') is-invalid @enderror" id="product_transfer" name="product_transfer" type="text" placeholder="" value="{{ old('product_transfer', $product->product_transfer) }}" autocomplete="off"/>
                                @error('product_transfer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product Reservation Number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_reser">Reservation Number</label>
                                <input class="form-control form-control-solid @error('product_reser') is-invalid @enderror" id="product_reser" name="product_reser" type="text" placeholder="" value="{{ old('product_reser', $product->product_reser) }}" autocomplete="off"/>
                                @error('product_reser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product origin) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_origin">Ex Station</label>
                                <input class="form-control form-control-solid @error('product_origin') is-invalid @enderror" id="product_origin" name="product_origin" type="text" placeholder="" value="{{ old('product_origin', $product->product_origin) }}" autocomplete="off"/>
                                @error('product_origin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product SDV In) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_sdvin">SDV In</label>
                                <input class="form-control form-control-solid @error('product_sdvin') is-invalid @enderror" id="product_sdvin" name="product_sdvin" type="text" placeholder="" value="{{ old('product_sdvin', $product->product_sdvin) }}" autocomplete="off"/>
                                @error('product_sdvin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product SDV out) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_sdvout">SDV Out</label>
                                <input class="form-control form-control-solid @error('product_sdvout') is-invalid @enderror" id="product_sdvout" name="product_sdvout" type="text" placeholder="" value="{{ old('product_sdvout', $product->product_sdvout) }}" autocomplete="off"/>
                                @error('product_sdvout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product Station) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_station">Station</label>
                                <input class="form-control form-control-solid @error('product_station') is-invalid @enderror" id="product_station" name="product_station" type="text" placeholder="" value="{{ old('product_station', $product->product_station) }}" autocomplete="off"/>
                                @error('product_station')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product Requestor) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_requestor">Requestor</label>
                                <input class="form-control form-control-solid @error('product_requestor') is-invalid @enderror" id="product_requestor" name="product_requestor" type="text" placeholder="" value="{{ old('product_requestor', $product->product_requestor) }}" autocomplete="off"/>
                                @error('product_requestor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product project) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_project">Project</label>
                                <input class="form-control form-control-solid @error('product_project') is-invalid @enderror" id="product_project" name="product_project" type="text" placeholder="" value="{{ old('product_project', $product->product_project) }}" autocomplete="off"/>
                                @error('product_project')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date Out) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_dateout">Date Out</label>
                                <input class="form-control form-control-solid example-date-input @error('product_dateout') is-invalid @enderror" name="product_dateout" id="product_dateout" type="date" value="{{ old('product_dateout', $product->product_dateout) }}" autocomplete="off">
                                @error('product_dateout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (date offshore) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_dateoffshore">Date to offshore</label>
                                <input class="form-control form-control-solid example-date-input @error('product_dateoffshore') is-invalid @enderror" name="product_dateoffshore" id="product_dateoffshore" type="date" value="{{ old('product_dateoffshore', $product->product_dateoffshore) }}" autocomplete="off">
                                @error('product_dateoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product transfer) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_tfoffshore">Material transfer to offshore</label>
                                <input class="form-control form-control-solid @error('product_tfoffshore') is-invalid @enderror" id="product_tfoffshore" name="product_tfoffshore" type="text" placeholder="" value="{{ old('product_tfoffshore', $product->product_tfoffshore) }}" autocomplete="off"/>
                                @error('product_tfoffshore')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockIn) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_stockin">Stock In</label>
                                <input class="form-control form-control-solid @error('product_stockin') is-invalid @enderror" id="product_stockin" name="product_stockin" type="text" placeholder="" value="{{ old('product_stockin', $product->product_stockin) }}" autocomplete="off"/>
                                @error('product_stockin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                 <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('product_docin') is-invalid @enderror" type="file"  id="product_docin" name="product_docin" accept=".pdf,.doc,.docx">
                                @error('product_docin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stockOut) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_stockout">Stock Out</label>
                                <input class="form-control form-control-solid @error('product_stockout') is-invalid @enderror" id="product_stockout" name="product_stockout" type="text" placeholder="" value="{{ old('product_stockout', $product->product_stockout) }}" autocomplete="off"/>
                                @error('product_stockout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="small font-italic text-muted mb-2">PDF or DOC </div>
                                <input class="form-control form-control-solid mb-2 @error('product_docout') is-invalid @enderror" type="file"  id="product_docout" name="product_docout" accept=".pdf,.doc,.docx">
                                @error('product_docout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (stock Quality (in-out) ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_stockqty">Stock Quality</label>
                                <input class="form-control form-control-solid @error('product_stockqty') is-invalid @enderror" id="product_stockqty" name="product_stockqty" type="text" placeholder="" value="{{ old('product_stockqty', $product->product_stockqty) }}" autocomplete="off"/>
                                @error('product_stockqty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script>
                                    // Fungsi untuk menghitung nilai stockqty berdasarkan stockin dan stockout
                                    function calculateStockQty() {
                                        var stockIn = parseInt(document.getElementById('product_stockin').value) || 0;
                                        var stockOut = parseInt(document.getElementById('product_stockout').value) || 0;
                                        var stockQty = stockIn - stockOut;
                                        document.getElementById('product_stockqty').value = stockQty;
                                    }
                                
                                    // Panggil fungsi calculateStockQty saat input stockin atau stockout berubah
                                    document.getElementById('product_stockin').addEventListener('change', calculateStockQty);
                                    document.getElementById('product_stockout').addEventListener('change', calculateStockQty);
                                </script>
                            </div>
                            <!-- Form Group (product Current Location) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_curloc">Current Location</label>
                                <input class="form-control form-control-solid @error('product_curloc') is-invalid @enderror" id="product_curloc" name="product_curloc" type="text" placeholder="" value="{{ old('product_curloc', $product->product_curloc) }}" autocomplete="off"/>
                                @error('product_curloc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product UOM) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="product_uom" >UOM</label>
                                    <select class="form-control form-control-solid @error('product_uom') is-invalid @enderror" id="product_uom" name="product_uom" type="text" placeholder="" value="{{ old('product_uom', $product->product_uom) }}" autocomplete="off"/>
                                        <option selected="" disabled="">Select a UOM:</option>
                                        <option value="" {{ old('product_uom') === null ? 'selected' : '' }}>N/A</option>
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
                                    @error('product_uom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (Target PDN) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_targetpdn">Target PDN</label>
                                <input class="form-control form-control-solid example-date-input @error('product_targetpdn') is-invalid @enderror" name="product_targetpdn" id="product_targetpdn" type="date" value="{{ old('product_targetpdn', $product->product_targetpdn) }}" autocomplete="off"/>
                                @error('product_targetpdn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product CS Release) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_csrelease">CS Release</label>
                                <input class="form-control form-control-solid @error('product_csrelease') is-invalid @enderror" id="product_csrelease" name="product_csrelease" type="text" placeholder="" value="{{ old('product_csrelease', $product->product_csrelease) }}" autocomplete="off"/>
                                @error('product_csrelease')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product CS number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_csnumber">CS Number</label>
                                <input class="form-control form-control-solid @error('product_csnumber') is-invalid @enderror" id="product_csnumber" name="product_csnumber" type="text" placeholder="" value="{{ old('product_csnumber', $product->product_csnumber) }}" autocomplete="off"/>
                                @error('product_csnumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product ce number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_cenumber">CE Number</label>
                                <input class="form-control form-control-solid @error('product_cenumber') is-invalid @enderror" id="product_cenumber" name="product_cenumber" type="text" placeholder="" value="{{ old('product_cenumber', $product->product_cenumber) }}" autocomplete="off"/>
                                @error('product_cenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product ro number) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_ronumber">RO Number</label>
                                <input class="form-control form-control-solid @error('product_ronumber') is-invalid @enderror" id="product_ronumber" name="product_ronumber" type="text" placeholder="" value="{{ old('product_ronumber', $product->product_ronumber) }}" autocomplete="off"/>
                                @error('product_ronumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (Start Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_startdate">Start Date</label>
                                <input class="form-control form-control-solid example-date-input @error('product_startdate') is-invalid @enderror" name="product_startdate" id="product_startdate" type="date" value="{{ old('product_startdate', $product->product_startdate) }}" autocomplete="off"/>
                                @error('product_startdate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (end Date) -->
                            <div class="col-md-6">
                                <label class="small my-1" for="product_enddate">End Date</label>
                                <input class="form-control form-control-solid example-date-input @error('product_enddate') is-invalid @enderror" name="product_enddate" id="product_enddate" type="date" value="{{ old('product_enddate', $product->product_enddate) }}" autocomplete="off"/>
                                @error('product_enddate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (product price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_price">Price Repair</label>
                                <input class="form-control form-control-solid @error('product_price') is-invalid @enderror" id="product_price" name="product_price" type="text" placeholder="" value="RP. {{ old('product_price', $product->product_price) }}" autocomplete="off"/>
                                @error('product_price')
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
                                    var productPriceInput = document.getElementById('product_price');
                                    productPriceInput.addEventListener('input', function (e) {
                                        var value = e.target.value;
                                        e.target.value = formatRupiah(value);
                                    });
                                
                                    // Panggil formatRupiah untuk mengubah format awal (jika ada)
                                    var initialValue = document.getElementById('product_price').value;
                                    document.getElementById('product_price').value = formatRupiah(initialValue);
                                </script>                            
                            </div>
                            <!-- Form Group (product Remark) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="product_remark">Remark</label>
                                <input class="form-control form-control-solid @error('product_remark') is-invalid @enderror" id="product_remark" name="product_remark" type="text" placeholder="" value="{{ old('product_remark', $product->product_remark) }}" autocomplete="off"/>
                                @error('product_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
