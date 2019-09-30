<?php
    echo anchor(
        'ruang/add',
        'Tambah Ruangan',
        ' class="btn btn-success" style="margin-bottom: 20px;" '
    );
?>

<table class="table table-striped table-bordered">
	<thead>
		<tr class="text-center">
			<th>NO</th>
			<th>KODE</th>
			<th>NAMA</th>
			<th>KET</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($data->result() as $row) {
			echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$row->kode_ruang.'</td>
						<td>'.$row->nama_ruang.'</td>
						<td>'.$row->keterangan.'</td>
						<td>
							'.anchor('ruang/edit/'.$row->id_ruang, 'Edit', 'class="badge badge-primary"').'
							'.anchor('ruang/hapus/'.$row->id_ruang, 'Hapus', 'class="badge badge-danger" onClick="return confirm(\'Hapus Data?\')"').'
						</td>
					</tr>
				';
			$no++;
		}
		?>
	</tbody>
</table>