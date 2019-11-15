<?php

    echo form_open('PeminjamanController/addExecute');

    echo '
        <div class="form-group">
            <label for="nama">Nama</label>
            '. form_dropdown('idInvent', $inventaris, '', 'class="form-control" placeholder="..." required').'
        </div>
        ';

    echo '
            <div class="form-group">
                <label>Jumlah</label>
                ' . form_input('jumlah', '', 'class="form-control" placeholder="..." required min="1"') . '
            </div>
        ';

    echo form_submit('submitInvent', 'Simpan', 'class="btn btn-primary"');
    echo anchor('peminjaman', 'Kembali', 'class="btn btn-danger float-right"');
    echo form_close();
?>