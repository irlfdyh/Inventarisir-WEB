<?php
    echo form_open('ruang/editExecute');
    echo '
            <div class="form-group">
                <label>Kode ruang</label>
                ' . form_input('kode_ruang', $row["kode_ruang"], 'class="form-control" placeholder="..." required') . '
            </div>
        ';
    echo '
            <div class="form-group">
                <label>Nama ruang</label>
                ' . form_input('nama_ruang', $row["nama_ruang"], 'class="form-control" placeholder="..." required') . '
            </div>
        ';
    echo '
            <div class="form-group">
                <label>Keterangan</label>
                ' . form_textarea('keterangan', $row["keterangan"], 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo form_hidden('id_ruang', $row['id_ruang']);
    echo form_submit('submit_ruang', 'Perbaharui', 'class="btn btn-primary"');
    echo anchor('ruang', 'Kembali', 'class="btn btn-danger float-right"');
    echo form_close();