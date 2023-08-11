
<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            
            <!-- Sidenav Heading (DATA INPUT)-->
            {{-- <div class="sidenav-menu-heading">ASSET DATA INPUT</div>            --}}
            {{-- SUBMENU LEVEL 1 --}}
            {{-- <div class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenuLevel1" aria-expanded="false" aria-controls="submenuLevel1">
                    <div class="nav-link-icon"><i data-feather="chevrons-right"></i></div>
                    <b>Asset Spare Unit</b>
                </a>
                    <div id="submenuLevel1" class="collapse">
                        <ul class="nav">
                            <li class="nav-item">
                                <!-- Submenu Level 2 -->
                                <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                    <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                    Asset Type - Valve
                                </a>
                                <a class="nav-link {{ Request::is('insproducts*') ? 'active' : '' }}" href="{{ route('insproducts.index') }}">
                                    <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                    Asset Type - Instrument
                                </a>
                                <a class="nav-link {{ Request::is('autoproducts*') ? 'active' : '' }}" href="{{ route('autoproducts.index') }}">
                                    <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                    Asset Type - Automation
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <div class="sidenav-menu-heading">ASSET SPARE UNIT</div>     
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <div class="nav-link-icon"><i data-feather="fa-solid fa-boxes-stacked"></i></div>
                        Asset Type - Valve
                    </a>
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('insproducts*') ? 'active' : '' }}" href="{{ route('insproducts.index') }}">
                        <div class="nav-link-icon"><i data-feather="fa-solid fa-boxes-stacked"></i></div>
                        Asset Type - Instrument
                    </a>
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('autoproducts*') ? 'active' : '' }}" href="{{ route('autoproducts.index') }}">
                        <div class="nav-link-icon"><i data-feather="fa-solid fa-boxes-stacked"></i></div>
                        Asset Type - Automation
                    </a>

                <div class="sidenav-menu-heading">ASSET BULK MATERIAL</div>                 
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('bulkproducts*') ? 'active' : '' }}" href="{{ route('bulkproducts.index') }}">
                        <div class="nav-link-icon"><i class="fa-solid fa-solid fa-boxes-stacked"></i></div>
                    Asset Bulk Material
                    </a>

                <div class="sidenav-menu-heading">ASSET SPARE PARTS</div> 
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('partsproducts*') ? 'active' : '' }}" href="{{ route('partsproducts.index') }}">
                        <div class="nav-link-icon"><i class="fa-solid fa-solid fa-boxes-stacked"></i></div>
                    Asset Spare Part
                    </a>

                <div class="sidenav-menu-heading">ASSET REPAIR</div> 
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('repairproducts*') ? 'active' : '' }}" href="{{ route('repairproducts.index') }}">
                        <div class="nav-link-icon"><i data-feather="fa-solid fa-boxes-stacked"></i></div>
                        Repair - Valve
                    </a>
                
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('insrepairproducts*') ? 'active' : '' }}" href="{{ route('insrepairproducts.index') }}">
                        <div class="nav-link-icon"><i data-feather="fa-solid fa-boxes-stacked"></i></div>
                        Repair - Instrument
                    </a>
                
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('autorepairproducts*') ? 'active' : '' }}" href="{{ route('autorepairproducts.index') }}">
                        <div class="nav-link-icon"><i data-feather="fa-solid fa-boxes-stacked"></i></div>
                        Repair - Automation
                    </a>

                    {{-- <div class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenuLevel1" aria-expanded="false" aria-controls="submenuLevel1">
                        <div class="nav-link-icon"><i data-feather="chevrons-right"></i></div>
                        <b>Asset Repair</b>
                    </a>
                        <div id="submenuLevel1" class="collapse">
                            <ul class="nav">
                                <li class="nav-item">
                                    <!-- Submenu Level 2 -->
                                    <a class="nav-link {{ Request::is('repairproducts*') ? 'active' : '' }}" href="{{ route('repairproducts.index') }}">
                                        <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                        Asset Type - Valve
                                    </a>
                                    <a class="nav-link {{ Request::is('insrepairproducts*') ? 'active' : '' }}" href="{{ route('insrepairproducts.index') }}">
                                        <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                        Asset Type - Instrument
                                    </a>
                                    <a class="nav-link {{ Request::is('autorepairproducts*') ? 'active' : '' }}" href="{{ route('autorepairproducts.index') }}">
                                        <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                        Asset Type - Automation
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}

                <div class="sidenav-menu-heading">ASSET PARTS FROM AN UNREPAIRABLE ASSET</div> 
                <div class="nav-item">
                    <a class="nav-link {{ Request::is('unreproducts*') ? 'active' : '' }}" href="{{ route('unreproducts.index') }}">
                        <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Asset Parts from an unrepairable asset
                    </a>
                {{-- <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenuLevel1" aria-expanded="false" aria-controls="submenuLevel1">
                    <div class="nav-link-icon"><i data-feather="more-vertical"></i></div>
                    <b>Asset Bulk Material</b>
                </a>
                    <div id="submenuLevel1" class="collapse">
                        <ul class="nav">
                            <li class="nav-item">
                                <!-- Submenu Level 2 -->
                                <a class="nav-link {{ Request::is('bulkproducts*') ? 'active' : '' }}" href="{{ route('bulkproducts.index') }}">
                                    <div class="nav-link-icon"><i data-feather="chevron-right"></i></div>
                                    Asset Type - Bulk Material
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            {{-- <div class="nav-item">
                <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Asset - Bulk Material
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Asset - Spare Parts
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Asset - Repair 
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Asset - Parts From An Unrepairable Asset 
                </a>
            </div> --}}

            <!-- Sidenav Heading (DATA MASTER)-->
            {{-- <div class="sidenav-menu-heading">Asset Data Master</div>
            <a class="nav-link {{ Request::is('ends*') ? 'active' : '' }}" href="{{ route('ends.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                End Connection
            </a>
            <a class="nav-link {{ Request::is('units*') ? 'active' : '' }}" href="{{ route('units.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Valve Type
            </a>
            <a class="nav-link {{ Request::is('sizes*') ? 'active' : '' }}" href="{{ route('sizes.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Valve Size
            </a>
            <a class="nav-link {{ Request::is('ratings*') ? 'active' : '' }}" href="{{ route('ratings.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Valve Rating
            </a>
            <a class="nav-link {{ Request::is('valvebrands*') ? 'active' : '' }}" href="{{ route('valvebrands.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Valve Brand
            </a>
            <a class="nav-link {{ Request::is('condis*') ? 'active' : '' }}" href="{{ route('condis.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Valve Condition
            </a>
            <a class="nav-link {{ Request::is('actbrands*') ? 'active' : '' }}" href="{{ route('actbrands.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Actuator Brand
            </a>
            <a class="nav-link {{ Request::is('acttypes*') ? 'active' : '' }}" href="{{ route('acttypes.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Actuator Type
            </a>
            <a class="nav-link {{ Request::is('actsizes*') ? 'active' : '' }}" href="{{ route('actsizes.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Actuator Size
            </a>
            <a class="nav-link {{ Request::is('actconds*') ? 'active' : '' }}" href="{{ route('actconds.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Actuator Condition
            </a>
            <a class="nav-link {{ Request::is('fails*') ? 'active' : '' }}" href="{{ route('fails.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Fail
            </a>
            <a class="nav-link {{ Request::is('posbrands*') ? 'active' : '' }}" href="{{ route('posbrands.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Positioner Brand
            </a>
            <a class="nav-link {{ Request::is('posmodels*') ? 'active' : '' }}" href="{{ route('posmodels.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Positioner Model
            </a>
            <a class="nav-link {{ Request::is('posconds*') ? 'active' : '' }}" href="{{ route('posconds.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Positioner Condition
            </a>
            <a class="nav-link {{ Request::is('uoms*') ? 'active' : '' }}" href="{{ route('uoms.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                UOM
            </a>
            <a class="nav-link {{ Request::is('instypes*') ? 'active' : '' }}" href="{{ route('instypes.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Instrument Type
            </a>
            <a class="nav-link {{ Request::is('insbrands*') ? 'active' : '' }}" href="{{ route('insbrands.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Instrument Brand
            </a>
            <a class="nav-link {{ Request::is('autobrands*') ? 'active' : '' }}" href="{{ route('autobrands.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Automation Brand
            </a>
            <a class="nav-link {{ Request::is('bulktypes*') ? 'active' : '' }}" href="{{ route('bulktypes.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Type Bulk Material
            </a> --}}

            <!-- Sidenav Heading (Settings)-->
            <div class="sidenav-menu-heading">Settings</div>
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Users
            </a>
            </div>
        </div>

    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
        </div>
    </div>
</nav>
