<!-- /.modal-ubah foto profil --> 
<div class="modal fade" id="modalfoto" tabindex="-1" role="dialog" aria-labelledby="modalfoto" aria-hidden="true">
    <div class="modal-dialog modal-foto" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalfoto">Ubah Foto</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createDetail" action="{{ route('ubahGambar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group col-12">
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth::user()->id }}"/>
                        <label for="tanggal" class="form-control-label">Gambar:</label>
                        <div class="input-group col-12">
                            <span class="input-group-btn" >
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp3" name="foto_profil">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="input-group col-4 mt-4">
                            <img id='img-upload3' class="img-upload img-circle"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-midnight">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>