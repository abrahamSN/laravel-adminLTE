@extends('layouts.app')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="form_validation" action="{{ url('/keluhan/update',$show->id)}}" method="POST">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="productkeluhan" class="col-sm-2 control-label">Product Keluhan</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="productkeluhan" id="productkeluhan" disabled>
                            @foreach($product as $pr)
                                <option value="{{ $pr->id }}"
                                        @if($pr->id == $show->product_id)
                                        selected
                                        @endif

                                >{{ $pr->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('productkeluhan'))
                            <span class="help-block">
                                <strong> {{$errors->first('productkeluhan')}} </strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="keterangan" id="keterangan"
                                  placeholder="Keterangan">{{ $show->keterangan }}</textarea>
                        @if ($errors->has('keterangan'))
                            <span class="help-block">
                                <strong> {{$errors->first('keterangan')}} </strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('/keluhan') }}" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection 