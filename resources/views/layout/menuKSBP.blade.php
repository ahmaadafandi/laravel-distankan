<ul class="list-unstyled components">
    <li class = "{{ set_active(['KSBP.proyek', 'KSBP.detailProyek']) }}">
        <a href="{{ route('KSBP.proyek') }}">
            <i class="fa fa-th-list"></i>
            Proyek
        </a>
    </li>
    <li class = "{{ set_active('KSBP.laporan') }}">
        <a href="{{ route('KSBP.laporan') }}">
            <i class="fa fa-th-list"></i>
            Laporan
        </a>
    </li>
</ul>