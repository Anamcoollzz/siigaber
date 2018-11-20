@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Jenis Pengadaan</th>
        <th>Jenis Beras</th>
        {{-- <th>Jumlah</th> --}}
        <th>Biaya</th>
        {{-- <th>Biaya Transport</th> --}}
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Jenis Pengadaan</th>
        <th>Jenis Beras</th>
        {{-- <th>Jumlah</th> --}}
        <th>Biaya</th>
        {{-- <th>Biaya Transport</th> --}}
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->tanggal }}</td>
        <td>{{ $d->jenis_pengadaan }}</td>
        <td>{{ $d->jenis->nama }}</td>
        {{-- <td align="right">{{ angka($d->jumlah) }}</td> --}}
        <td align="right">{{ number_format($d->biaya, 0, ',', '.') }}</td>
        {{-- <td align="right">{{ number_format($d->biaya_transport, 0, ',', '.') }}</td> --}}
        <td>
            @if($d->status == 'Menunggu persetujuan')
            <span class="label bg-red">{{$d->status}}</span>
            @elseif($d->status == 'Dalam pengerjaan')
            <span class="label bg-yellow">{{$d->status}}</span>
            @elseif($d->status == 'Selesai')
            <span class="label bg-green">{{$d->status}}</span>
            @endif
        </td>
        <td>
            @include('detail_button', ['link' => route('pengadaan.show', [$d->id])])
            @if($d->status == 'Menunggu persetujuan')
            @if(Auth::user()->role == 'Operator')
            @include('edit_button', ['link' => route('pengadaan.edit', [$d->id])])
            @include('delete_button', ['link' => route('pengadaan.destroy', [$d->id])])
            @endif
            @if(Auth::user()->role == 'Manajer')
            <a href="#" onclick="verifikasi(event, '{{route('pengadaan.verifikasi',[$d->id])}}')" class="btn btn-flat btn-warning">Verifikasi</a>
            @endif
            @elseif($d->status == 'Dalam pengerjaan' && Auth::user()->role == 'Gudang')
            <a onclick="showModal(event,{{$d->id}})" class="btn bg-maroon btn-flat">Selesai</a>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

@push('script')
<form action="" id="verifikasi-form" method="post">
    @csrf
    @method('put')
</form>
<script>
    function verifikasi(e, link) {
        e.preventDefault();
        if(confirm('Anda yakin?')){
            var form = document.getElementById('verifikasi-form');
            form.action = link;
            form.submit();
        }
    }

    function showModal(e,id){
        if(e != null)
            e.preventDefault();
        $('.modal').modal('show');
        $('#modal-form').attr('action',$('#modal-form').attr('action')+'/'+id);
        $('#modal-form').find('[name="id_selesai"]').val(id);
    }

    @if($errors->has('biaya_transport'))

    showModal(event, {{old('id_selesai')}});

    @endif
</script>
@endpush

@section('modal')

<form id="modal-form" action="{{ url('pengadaan/selesai') }}" method="post" role="form" class="form-horizontal">
    <input type="hidden" name="id_selesai">
    <div class="modal fade" id="modal-selesai" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Selesai Pengadaan</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id_penggilingan">
                    <div class="row">
                        <div class="form-group {{$errors->has('biaya_transport') ? 'has-error' : ''}}">
                            <label for="biaya_transport" class="col-sm-4 control-label">Biaya Transportasi</label>
                            <div class="col-sm-6">
                                <input required="required" name="biaya_transport" value="{{old('biaya_transport')}}" type="number" class="form-control" id="biaya_transport" min="1000" placeholder="Biaya Transportasi">
                                @if($errors->has('biaya_transport'))
                                <span class="help-block">{{$errors->first('biaya_transport')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-flat">Selesai</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection