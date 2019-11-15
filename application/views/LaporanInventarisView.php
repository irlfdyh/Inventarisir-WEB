<table class="table table-striped table-bordered">
	<thead>
		<tr class="text-center">
			<th>NO</th>
			<th>NAMA INVENTARIS</th>
			<th>KODE INVENTARIS</th>
			<th>JENIS</th>
			<th>RUANG</th>
			<th>KONDISI</th>
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
                        <td>'.$row->kode_inventaris.'</td>
                        <td>'.$row->nama_jenis.'</td>
                        <td>'.$row->nama_ruang.'</td>
                        <td>'.$row->kondisi.'</td>
                        <td>'.$row->jumlah.'</td>
                    </tr>
                ';
                $no++;
            }
		?>
	</tbody>
</table>