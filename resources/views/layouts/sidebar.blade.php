<ul class="sidebar-menu">
    <li class="menu-header">Menu</li>
    <li class="nav-item dropdown">
        {{-- <a href="#" class="nav-link has-dropdown"><i class="fas fa-cubes"></i><span>Main Menu</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('customer') }}">Data Customer</a></li>       
            <li><a class="nav-link" href="{{ route('produk') }}">Plroduk</a></li>  
            <li><a class="nav-link" href="{{ route('penjualan') }}">Penjualan</a></li>  
        </ul> --}}
        @if (session('username') == 'admin' || session('username') == 'swifect')
    <li><a class="nav-link" href="{{ route('packlist') }}"><i class="fas fa-cubes"></i> <span>Packing List</span></a></li>
    @if (session('username') == 'swifect')
        <li><a class="nav-link" href="{{ route('packlistv2') }}"><i class="fas fa-cubes"></i> <span>Packing List
                    V2</span></a>
    @endif
    </li>
    <li><a class="nav-link" href="{{ route('rdailypaymentrcv') }}"><i class="fas fa-cubes"></i> <span>Daily Payment
                Received</span></a></li>
    <li><a class="nav-link" href="{{ route('rpaymentrcvgroup') }}"><i class="fas fa-cubes"></i> <span>Payment Received
                By
                Group</span></a></li>
    <li><a class="nav-link" href="{{ route('rsalessummary') }}"><i class="fas fa-cubes"></i> <span>Sales
                Summary</span></a></li>
    <li><a class="nav-link" href="{{ route('salestrans') }}"><i class="fas fa-cubes"></i> <span>Sales
                Transaction</span></a></li>
    <li><a class="nav-link" href="{{ route('inventcategory') }}"><i class="fas fa-cubes"></i> <span>Inventory by
                Category</span></a></li>
    <li><a class="nav-link" href="{{ route('productbyoutlet') }}"><i class="fas fa-cubes"></i> <span>Product by
                Outlet</span></a></li>
    <li><a class="nav-link" href="{{ route('salescompare') }}"><i class="fas fa-cubes"></i> <span>Sales Compare by
                Outlet</span></a></li>
    <li><a class="nav-link" href="{{ route('outletperformance') }}"><i class="fas fa-cubes"></i> <span>Outlet
                Performance Detail</span></a></li>
@else
    <li><a class="nav-link" href="{{ route('packlist') }}"><i class="fas fa-cubes"></i> <span>Packing List</span></a>
    </li>
    @endif
    {{-- <li><a class="nav-link" href="{{ route('pembelian') }}"><i class="fas fa-cubes"></i> <span>Pembelian</span></a></li>
        <li><a class="nav-link" href="{{ route('sjretur') }}"><i class="fas fa-cubes"></i> <span>Surat Jalan Retur</span></a></li>
        <li><a class="nav-link" href="{{ route('returpembelian') }}"><i class="fas fa-cubes"></i> <span>Retur Pembelian</span></a></li> --}}
    {{-- <li><a class="nav-link" href="{{ route('produk') }}"><i class="fas fa-cubes"></i> <span>Produk</span></a></li>
        <li><a class="nav-link" href="{{ route('stock') }}"><i class="fas fa-cubes"></i> <span>Tambah Stock</span></a></li>
        <li><a class="nav-link" href="{{ route('penjualan') }}"><i class="fas fa-cubes"></i> <span>Penjualan</span></a></li>
        <li><a class="nav-link" href="{{ route('lapstock') }}"><i class="fas fa-cubes"></i> <span>Laporan Stock</span></a></li>
        <li><a class="nav-link" href="{{ route('laporanpenjualan') }}"><i class="fas fa-cubes"></i> <span>Laporan Penjualan</span></a></li> --}}
    </li>
</ul>
