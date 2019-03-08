<ul class="list-unstyled">
    <li class = "{{ set_active('pegawai.tambahProyek') }}">
        <a href="{{ route('pegawai.tambahProyek') }}">
            <i class="fa fa-th-list"></i>
            Tambah Proyek
        </a>
    </li>
    <li class = "{{ set_active(['pegawai.proyekBerjalan', 'pegawai.detail_proyek_berjalan']) }}">
        <a href="{{ route('pegawai.proyekBerjalan', Auth::user()->id) }}">
            <i class="fa fa-th-list"></i>
            Proyek
        </a>
    </li>
    <!-- <li>
        <a href="history_proyek_selesai.php">
            <i class="fa fa-user-circle"></i>
            Proyek Selesai
        </a>
    </li> -->
</ul>