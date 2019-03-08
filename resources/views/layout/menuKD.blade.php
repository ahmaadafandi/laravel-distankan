<ul class="list-unstyled components">
    <li class = "{{ set_active('KD.realisasiProyek') }}">
        <a href="{{ route('KD.realisasiProyek') }}">
            <i class="fa fa-th-list"></i>
            Laporan Realisasi Proyek
        </a>
    </li>
    <li class = "{{ set_active('KD.proyek') }}">
        <a href="{{ route('KD.proyek') }}">
            <i class="fa fa-th-list"></i>
            Proyek
        </a>
    </li>
    <li class = "{{ set_active('KD.persetujuanProyek') }}">
        <a href="{{ route('KD.persetujuanProyek') }}">
            <i class="fa fa-th-list"></i>
            Persetujuan Proyek
        </a>
    </li>
    <li class = "{{ set_active('KD.daftarPegawai') }}">
        <a href="{{ route('KD.daftarPegawai') }}">
            <i class="fa fa-th-list"></i>
            Daftar Pegawai
        </a>
    </li>
    <li class = "{{ set_active('KD.daftarUser') }}">
        <a href="{{ route('KD.daftarUser') }}">
            <i class="fa fa-th-list"></i>
            Daftar User
        </a>
    </li>
    <li class = "{{ set_active(['KD.laporan', 'KD.laporanPilihan']) }}">
        <a href="{{ route('KD.laporan') }}">
            <i class="fa fa-th-list"></i>
            Laporan
        </a>
    </li>
    <li class = "{{ set_active('KD.logAktivitas') }}">
        <a href="{{ route('KD.logAktivitas') }}">
            <i class="fa fa-th-list"></i>
            Log Aktivitas
        </a>
    </li>
</ul>