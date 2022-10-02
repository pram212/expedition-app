<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link text-center">
        <img src="{{ asset('img/logo.png') }}" width="100%" class="m-1"  alt="Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{url('home')}}" class="nav-link @if(request()->is('home')) active @endif" >
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/crm/order')}}" class="nav-link  
                        @if( request()->routeIs('crm.order.*') ) active @endif"
                    >
                        <i class="nav-icon fas fa-users"></i>
                        <p>Konsumen</p>
                    </a>
                </li>
                <li class="nav-item @if(request()->routeIs('crm.operation.*')) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->routeIs('crm.operation.*')) active @endif ">
                        <i class="nav-icon fa fa-check-square" aria-hidden="true"></i>
                        <p>
                            Operasional
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/crm/operation/payment')}}" class="nav-link @if(request()->routeIs('crm.operation.payment*')) active @endif">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/crm/operation/shipment')}}" class="nav-link  @if(request()->routeIs('crm.operation.shipment*')) active @endif">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Pengiriman</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if( request()->routeIs('reporting.*') || request()->routeIs('invoice.*') ) menu-open @endif">
                    <a href="#" class="nav-link @if(request()->routeIs('reporting.*')|| request()->routeIs('invoice.*')) active @endif">
                        <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                        <p>
                            Pelaporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/reporting') }}" class="nav-link @if( request()->routeIs('reporting.*') ) active @endif">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Buat Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/invoice') }}" class="nav-link @if(request()->routeIs('invoice.*')) active @endif">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Cetak Struk</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('/crm/trash')}}" class="nav-link  @if(request()->is('crm/trash')) active @endif">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>Sampah</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-database" aria-hidden="true"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Jenis Dokumen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Jenis Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Jenis Pengiriman</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog" aria-hidden="true"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Formulir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-share" aria-hidden="true"></i>
                                <p>Hak Akses</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>