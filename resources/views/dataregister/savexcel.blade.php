<style type="text/css">
	table, th {
		font-weight: bold;
	}
</style>
	<table border="1" width="100%">

						<tr>
							<th colspan="4" align="center" style="font-size: 18pt; height: 40px; text-align: center; vertical-align: middle;">{{$data[0]->sekolah}}</th>
						</tr>
                        <tr>
                            <th>No</th>
                            {{-- <th>Kode Trip</th> --}}
                            <th>Bus</th>
                            {{-- <th>No. Registrasi</th> --}}
                            <th>Nama</th>
                            {{-- <th>Sekolah</th> --}}
                            <th>Kelas</th>
                            {{-- <th>TTL</th> --}}
                            {{-- <th>Email</th> --}}
                            {{-- <th>Alamat</th> --}}
                            {{-- <th>Penyakit</th> --}}

                        </tr>
                        @foreach($data as $key => $item)
                        <tr>
                            <td>{{$data->firstitem()+$key}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kode_trip}}</td> --}}
                            <td>{{$item->bus}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->id_reg}}</td> --}}
                            <td>{{$item->nama_lengkap}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->sekolah}}</td> --}}
                            <td>{{$item->kelas}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{explode(',', $item->ttl)[0]}}, {{Carbon\Carbon::parse(str_replace(' ', '', explode(',', $item->ttl)[1]))->isoFormat('DD MMMM YYYY')}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->email}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->alamat}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->penyakit}}</td> --}}

                        </tr>
                        @endforeach
                    </table>
