<style type="text/css">
	table, th {
		font-weight: bold;
	}
</style>
	<table border="1" width="100%">

nama lengkap 
Nama orang tua
Nomor telp
						<tr>
							<th colspan="8" align="center" style="font-size: 18pt; height: 40px; text-align: center; vertical-align: middle;">{{$data[0]->trip->nama_sekolah}}</th>
						</tr>
                        <tr>
                            <th>No</th>
                            <th>Bus</th>
                            <th>Nama Lengkap</th>
                            <th>No. Telepon Siswa</th>
                            <th>No. WA Siswa</th>
                            <th>Nama Orang Tua</th>
                            <th>No. Telepon Orang Tua1</th>
                            <th>No. Telepon Orang Tua2</th>
                        </tr>
                        @foreach($data as $key => $item)
                        <tr>
                            <td>{{$data->firstitem()+$key}}</td>
                            <td>{{$item->bus}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            <td>{{$item->no_tel}}</td>
                            <td>{{$item->no_wa}}</td>
                            <td>{{$item->nm_ortu}}</td>
                            <td>{{$item->no_tel_ortu1}}</td>
                            <td>{{$item->no_tel_ortu2}}</td>
                        </tr>
                        @endforeach
                    </table>
