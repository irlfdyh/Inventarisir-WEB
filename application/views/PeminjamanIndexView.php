<?php
    echo anchor(
        'PeminjamanController/add',
        'tambah data',
        'class="btn btn-success mb-3"'
    );
?>

<table class="table table-striped table-bordered">
	<thead>
		<tr class="text-center">
			<th>NO</th>
			<th>NAMA INVENTARIS</th>
			<th>JUMLAH PINJAM</th>
			<th>TANGGAL PINJAM</th>
			<th>STATUS</th>
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
                        <td>'.$row->jumlah.'</td>
                        <td>'.$row->tanggal_pinjam.'</td>
                        <td>'.$row->status_peminjaman.'</td>
                        <td>
                            '.anchor('PeminjamanController/getBack/'.$row->id_peminjaman, 'Kembalikan', 'class="badge badge-primary" onClick="return confirm(\'Barang Dikembalikan?\')" ').'
                        </td>
                    </tr>
                ';
                $no++;
            }
		?>
	</tbody>
</table>