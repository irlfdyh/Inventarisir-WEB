<?php
    echo form_open('ruang/addExecute');
    echo '
            <div class="form-group">
                <label>Kode Ruangan</label>
                ' . form_input('kode_ruang', '', 'class="form-control" placeholder="..." required') . '
            </div>
        ';
    echo '
            <div class="form-group">
                <label>Nama Ruangan</label>
                ' . form_input('nama_ruang', '', 'class="form-control" placeholder="..." required') . '
            </div>
        ';
    echo '
            <div class="form-group">
                <label>Keterangan</label>
                ' . form_textarea('keterangan', '', 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo form_submit('submit_ruang', 'Simpan', 'class="btn btn-primary"');
    echo anchor('ruang', 'Kembali', 'class="btn btn-danger float-right"');
    echo form_close();