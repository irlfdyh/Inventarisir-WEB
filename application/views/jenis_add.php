<?php
echo form_open('jenis/add_execute');
echo '
        <div class="form-group">
            <label>Kode Jenis</label>
            ' . form_input('kode_jenis', '', 'class="form-control" placeholder="..." required') . '
        </div>
    ';
echo '
        <div class="form-group">
            <label>Nama Jenis</label>
            ' . form_input('nama_jenis', '', 'class="form-control" placeholder="..." required') . '
        </div>
    ';
echo '
        <div class="form-group">
            <label>Keterangan</label>
            ' . form_textarea('keterangan', '', 'class="form-control" placeholder="..." required') . '
        </div>
    ';

echo form_submit('submit_jenis', 'Simpan', 'class="btn btn-primary"');
echo anchor('jenis', 'Kembali', 'class="btn btn-danger float-right"');
echo form_close();
