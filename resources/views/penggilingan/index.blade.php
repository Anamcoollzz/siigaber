@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Tanggal Dibuat</th>
        <th>Jenis</th>
        <th>Biaya</th>
        <th>Biaya Transport</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Tanggal Dibuat</th>
        <th>Jenis</th>
        <th>Biaya</th>
        <th>Biaya Transport</th>
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
        <td align="right">{{ number_format($d->biaya, 0, ',', '.') }}</td>
        <td align="right">{{ number_format($d->biaya_transport, 0, ',', '.') }}</td>
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
            @include('detail_button', ['link' => route('penggilingan.show', [$d->id])])
            @if($d->status == 'Menunggu persetujuan')
            @if(Auth::user()->role == 'Operator')
            @include('edit_button', ['link' => route('penggilingan.edit', [$d->id])])
            @include('delete_button', ['link' => route('penggilingan.destroy', [$d->id])])
            @endif
            @if(Auth::user()->role == 'Manajer')
            <a href="#" onclick='verifikasi(event, "{{route('penggilingan.verifikasi',[$d->id])}}")' class="btn btn-flat btn-warning">Verifikasi</a>
            @endif
            @endif
            @if($d->status == 'Dalam pengerjaan' && Auth::user()->role == 'Gudang')
            <a onclick='selesaiModal(event, {{$d->id}},{!!$d->toJson()!!})' class="btn bg-maroon btn-flat">Selesai</a>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

@section('modal')

<form method="post" role="form" id="form-selesai" class="form-horizontal">
    <div class="modal fade" id="modal-selesai" role="dialog">
        <div class="modal-dialog modal-lg">
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
                        @include('input',['custom'=>[4,6],'readonly'=>true,'id'=>'tanggal_mulai','label'=>'Tanggal Mulai','value'=>date('Y-m-d')])
                        @include('input',['custom'=>[4,6],'readonly'=>true,'id'=>'biaya','label'=>'Biaya Penggilingan'])
                        @include('input',['custom'=>[4,6],'readonly'=>true,'id'=>'mitra_kerja','label'=>'Mitra Kerja'])
                        @include('input',['custom'=>[4,6],'readonly'=>true,'id'=>'jenis_beras','label'=>'Jenis Beras'])
                        <div id="gudang"></div>
                        <div class="form-group @if($errors->has('biaya_transport')) has-error @endif">
                            <label for="biaya_transport" class="col-sm-4 control-label">Biaya Transportasi</label>
                            <div class="col-sm-6">
                                <input required="required" name="biaya_transport" value="{{old('biaya_transport')}}" type="number" class="form-control" id="biaya_transport" placeholder="Biaya Transportasi">
                                @if($errors->has('biaya_transport'))
                                <span class="help-block">{{$errors->first('biaya_transport')}}</span>
                                @endif
                            </div>
                        </div>
                        @foreach(\App\Gudang::all() as $g)
                        <div class="form-group ">
                            <label class="col-sm-4 control-label" for="gudang_{{$g->id}}">Jumlah Masuk ke {{$g->nama}}</label>
                            <div class="col-sm-6">
                                <input name="gudang[{{$g->id}}]" class="form-control" id="gudang_{{$g->id}}" type="number" placeholder="Jumlah Masuk ke {{$g->nama}}" value="0">
                            </div>
                        </div>
                        @endforeach
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

    function selesaiModal(e, id, data){
        e.preventDefault();
        $('#form-selesai').attr('action', '{{url('penggilingan')}}/'+id+'/selesai');
        $('#modal-selesai').find('#tanggal_mulai').val(data.tanggal_mulai);
        $('#modal-selesai').find('#biaya').val(data.biaya);
        $('#modal-selesai').find('#mitra_kerja').val(data.mitrakerja.nama);
        $('#modal-selesai').find('#jenis_beras').val(data.jenis.nama);
        var gudangHtml = '';
        for(var d of data.detail){
            gudangHtml += '<div class="form-group "><label class="col-sm-4 control-label" for="jenis_beras">Dari '+d.gudang.nama+'</label><div class="col-sm-6"><input name="gudang" class="form-control" id="gudang" type="text" readonly="readonly" placeholder="Dari '+d.gudang.nama+'" value="'+d.jumlah+'"></div></div>';
        }
        $('#modal-selesai').find('#gudang').html(gudangHtml);
        $('#modal-selesai').modal('show');
    }

    @if($errors->has('biaya_transport'))

    $(function(){

        $('[data-target="#modal-selesai-{{old('id_penggilingan')}}"]').trigger('click');

    });


    @endif
</script>
@endpush