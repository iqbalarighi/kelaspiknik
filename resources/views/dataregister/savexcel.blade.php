<style type="text/css">
	th {
		font-weight: bold;
	}
</style>
	<table border="1" width="100%">
						<tr>
							<th colspan="5" align="center" style="font-size: 18pt;">{{$data[0]->sekolah}}</th>
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
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$data->firstitem()+$key}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kode_trip}}</td> --}}
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->bus}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->id_reg}}</td> --}}
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->nama_lengkap}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->sekolah}}</td> --}}
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kelas}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{explode(',', $item->ttl)[0]}}, {{Carbon\Carbon::parse(str_replace(' ', '', explode(',', $item->ttl)[1]))->isoFormat('DD MMMM YYYY')}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->email}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->alamat}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->penyakit}}</td> --}}

                        </tr>
                        @endforeach
                    </table>
