@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Tanggal Dibuat</th>
        <th>Jenis Beras</th>
        <th>Tipe</th>
        <th>Biaya</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Tanggal Dibuat</th>
        <th>Jenis Beras</th>
        <th>Tipe</th>
        <th>Biaya</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->created_at }}</td>
        <td>{{ $d->jenis->nama }}</td>
        <td>{{ $d->tipe }}</td>
        <td align="right">{{ number_format($d->biaya, 0, ',', '.') }}</td>
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
            @include('detail_button', ['link' => route('distribusi.show', [$d->id])])
            @if($d->status == 'Menunggu persetujuan')
            @if(Auth::user()->role == 'Operator')
            @include('edit_button', ['link' => route('distribusi.edit', [$d->id])])
            @include('delete_button', ['link' => route('distribusi.destroy', [$d->id])])
            @endif
            @if(Auth::user()->role == 'Manajer')
            <a href="#" onclick="verifikasi(event, '{{route('distribusi.verifikasi',[$d->id])}}')" class="btn btn-flat btn-warning">Verifikasi</a>
            @endif
            @endif
            @if($d->status == 'Dalam pengerjaan')
            <a data-toggle="modal" data-target="#modal-selesai-{{$d->id}}" class="btn bg-maroon btn-flat">Selesai</a>
            <form action="{{ route('distribusi.selesai',[$d->id]) }}" method="post" role="form" class="form-horizontal">
                <div class="modal fade" id="modal-selesai-{{$d->id}}" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Selesai Penggilingan</h4>
                            </div>
                            <div class="modal-body">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id_penggilingan" value="{{$d->id}}">
                                <div class="row">
                                    <div class="form-group {{$errors->has('biaya_transport')}} has-error @endid">
                                        <label for="biaya_transport" class="col-sm-6 control-label">Biaya Transportasi</label>
                                        <div class="col-sm-6">
                                            <input required="required" name="biaya_transport" value="{{old('biaya_transport')}}" type="number" class="form-control" id="biaya_transport" placeholder="Biaya Transportasi">
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

    @if($errors->has('biaya_transport'))

    $(function(){

        $('[data-target="#modal-selesai-{{old('id_penggilingan')}}"]').trigger('click');

    });


    @endif
</script>
@endpush