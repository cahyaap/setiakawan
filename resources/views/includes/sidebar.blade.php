<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">Menu</span>
            </h3>
        </div>
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="waves-effect">
                    <i class="mdi mdi-home fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="mdi mdi-cart-outline fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Transaksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('retur.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="fa fa-refresh fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Retur</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="fa fa-book fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Rekap</span>
                </a>
            </li>
            <li>
                <a href="{{ route('hutang-piutang.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="fa fa-credit-card fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Hutang Piutang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('seller.index') }}" class="waves-effect">
                    <i class="fa fa-user fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Seller Buyer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('stok-opname.index') }}" class="waves-effect">
                    <i class="fa fa-database fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Stok Opname</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-cube fa-fw" data-icon="v"></i> 
                    <span class="hide-menu"> 
                        Data Barang <span class="fa arrow"></span> 
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('barang.index') }}" class="waves-effect">
                            <i class="fa fa-cubes fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> Daftar Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('harga.index') }}" class="waves-effect">
                            <i class="fa fa-money fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> Daftar Harga</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.index') }}" class="waves-effect">
                            <i class="fa fa-tags fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> Kategori</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="devider"></li>
            <li>
                <a href="{{ route('karyawan.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="fa fa-users fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Karyawan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('absensi.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="fa fa-calendar fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Absensi</span>
                </a>
            </li>
            <li class="devider"></li>
            <li>
                <a href="{{ route('profil.index') }}" class="waves-effect">
                    <i style="font-size: 16px;" class="fa fa-gear fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Profil</span>
                </a>
            </li>
            <li class="devider"></li>
            <li>
                <a href="javascript:void(0)" data-toggle="modal" data-target=".logoutModal" class="waves-effect">
                    <i class="mdi mdi-logout fa-fw"></i>
                    <span class="hide-menu"> Logout</span>
                </a>
            </li>
            <li class="devider"></li>
        </ul>
    </div>
</div>
