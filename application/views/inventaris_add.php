<?php
    echo form_open('inventaris/add_execute');

    echo '
            <div class="form-group">
                <label>Nama</label>
                ' . form_input('nama', '', 'class="form-control" placeholder="..." required') . '
            </div>
        ';
    
    $kondisi =  [
        "" => "- Pilih Kondisi -",
        "Bagus" => "Bagus",
        "Rusak Ringan" => "Rusak Ringan",
        "Rusak Berat" => "Rusak Berat"
    ];

    echo '
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                '. form_dropdown('kondisi', $kondisi, '', 'class="form-control"
                placeholder="..." required').'
            </div>
        ';

    echo '
            <div class="form-group">
                <label>Keterangan</label>
                ' . form_textarea('keterangan', '', 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo '
            <div class="form-group">
                <label>Jumlah</label>
                ' . form_input('jumlah', '', 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo '
        <div class="form-group">
            <label for="jenis">Jenis</label>
            '. form_dropdown('id_jenis', $jenis, '', 'class="form-control" placeholder="..." required').'
        </div>
        ';

    echo '
        <div class="form-group">
            <label for="ruang">Ruang</label>
            '. form_dropdown('id_ruang', $ruang, '', 'class="form-control"placeholder="..." required').'
        </div>
    ';

    echo form_submit('submit_inventaris', 'Simpan', 'class="btn btn-primary"');
    echo anchor('jenis', 'Kembali', 'class="btn btn-danger float-right"');
    echo form_close();
?>
