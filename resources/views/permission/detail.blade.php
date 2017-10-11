@extends('layouts.app')

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="form_validation" action="{{ url('/permission/update',$show->id)}}" method="POST">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" value="{{ $show->name }}"  placeholder="Name" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="display_name" class="col-sm-2 control-label">Display Name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="display_name" id="display_name" value="{{ $show->display_name }}"  placeholder="Display Name" required>
                        @if ($errors->has('display_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('display_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" id="description" value="{{ $show->description }}" required placeholder="Description">
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('/permission') }}" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection