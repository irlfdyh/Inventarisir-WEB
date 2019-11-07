<?php
    echo anchor(
        'inventaris/add',
        'tambah data',
        'class="btn btn-success mb-3"'
    );
?>

<table class="table table-striped table-bordered">
	<thead>
		<tr class="text-center">
			<th>NO</th>
			<th>NAMA INVENTARIS</th>
			<th>JENIS</th>
			<th>RUANG</th>
			<th>JUMLAH</th>
			<th>AKSI</th>
		</tr>
    </thead>
    
	<tbody>
        <?php
            $no = 1;
            foreach($data->result() as $row) {
                echo '
                    <tr>
                        <td>'.$no.'</td>
                        <td>'.$row->nama.'</td>
                        <td>'.$row->nama_jenis.'</td>
                        <td>'.$row->nama_ruang.'</td>
                        <td>'.$row->jumlah.'</td>
                        <td>
                            '.anchor('inventaris/edit/'.$row->id_inventaris, 'Edit', 'class="badge badge-primary"').'
                            '.anchor('inventaris/hapus/'.$row->id_inventaris, 'Hapus', 'class="badge badge-danger" onClick="return confirm(\'Hapus Data?\')"').'
                        </td>
                    </tr>
                ';
                $no++;
            }
		?>
	</tbody>
</table>