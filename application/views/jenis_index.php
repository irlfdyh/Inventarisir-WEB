<?php
echo anchor(
	'jenis/add',
	'Tambah Jenis Barang',
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
						<td>'.$row->kode_jenis.'</td>
						<td>'.$row->nama_jenis.'</td>
						<td>'.$row->keterangan.'</td>
						<td>
							'.anchor('jenis/edit/'.$row->id_jenis, 'Edit', 'class="badge badge-primary"').'
							'.anchor('jenis/hapus/'.$row->id_jenis, 'Hapus', 'class="badge badge-danger" onClick="return confirm(\'Hapus Data?\')"').'
						</td>
					</tr>
				';
			$no++;
		}
		?>
	</tbody>
</table>