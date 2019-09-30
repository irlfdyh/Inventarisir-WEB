<?php
echo form_open('jenis/edit_execute');
echo '
        <div class="form-group">
            <label>Kode Jenis</label>
            ' . form_input('kode_jenis', $row["kode_jenis"], 'class="form-control" placeholder="..." required') . '
        </div>
    ';
echo '
        <div class="form-group">
            <label>Nama Jenis</label>
            ' . form_input('nama_jenis', $row["nama_jenis"], 'class="form-control" placeholder="..." required') . '
        </div>
    ';
echo '
        <div class="form-group">
            <label>Keterangan</label>
            ' . form_textarea('keterangan', $row["keterangan"], 'class="form-control" placeholder="..." required') . '
        </div>
    ';

echo form_hidden('id_jenis', $row['id_jenis']);
echo form_submit('submit_jenis', 'Perbaharui', 'class="btn btn-primary"');
echo anchor('jenis', 'Kembali', 'class="btn btn-danger float-right"');
echo form_close();