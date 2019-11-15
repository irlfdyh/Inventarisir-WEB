<table class="table table-striped table-bordered">
	<thead>
		<tr class="text-center">
			<th>NO</th>
			<th>NAMA INVENTARIS</th>
			<th>JUMLAH PINJAM</th>
			<th>TANGGAL PINJAM</th>
			<th>TANGGAL KEMBALI</th>
			<th>STATUS</th>
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
                        <td>'.$row->tanggal_kembali.'</td>
                        <td>'.$row->status_peminjaman.'</td>
                    </tr>
                ';
                $no++;
            }
		?>
	</tbody>
</table>