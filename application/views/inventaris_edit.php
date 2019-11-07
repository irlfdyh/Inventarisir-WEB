<?php
    echo form_open('inventaris/editExecute');

    $kondisi =  [
        "" => "- Pilih Kondisi -",
        "Bagus" => "Bagus",
        "Rusak Ringan" => "Rusak Ringan",
        "Rusak Berat" => "Rusak Berat"
    ];

    echo '
            <div class="form-group">
                <label>Nama</label>
                ' . form_input('nama', $result["nama"], 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo '
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                '. form_dropdown('kondisi', $kondisi, $result["kondisi"], '', 'class="form-control"
                placeholder="..." required').'
            </div>
        ';

    echo '
            <div class="form-group">
                <label>Keterangan</label>
                ' . form_textarea('keterangan', $result["keterangan"], 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo '
            <div class="form-group">
                <label>Jumlah</label>
                ' . form_input('jumlah', $result["jumlah"], 'class="form-control" placeholder="..." required') . '
            </div>
        ';

    echo '
        <div class="form-group">
            <label for="jenis">Jenis</label>
            '. form_dropdown('id_jenis', $jenis, $result["id_jenis"], 'class="form-control" placeholder="..." required').'
        </div>
        ';

    echo '
        <div class="form-group">
            <label for="ruang">Ruang</label>
            '. form_dropdown('id_ruang', $ruang, $result["id_ruang"], 'class="form-control"placeholder="..." required').'
        </div>
    ';

    echo form_hidden("id_inventaris", $result["id_inventaris"]);
    echo form_submit('submit_inventaris', 'Perbaharui', 'class="btn btn-primary"');
    echo anchor('inventaris', 'Kembali', 'class="btn btn-danger float-right"');
    echo form_close();
?>
