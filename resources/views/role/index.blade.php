@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                @if(Auth::user()->can(['role-create']))
                    <a href="{{ url('/role/tambah') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                @endif
            </h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tr>
                    <th style="width: 10px" class="text-center">Id</th>
                    <th style="width: 100px">Nama Role</th>
                    <th style="width: 150px">Deskripsi Role</th>
                    <th>Permission Role</th>

                    @if(Auth::user()->can(['role-edit','role-delete']))
                        <th style="width: 150px" class="text-center">Aksi</th>
                    @endif
                </tr>

                @foreach ($role as $ro)
                    <tr>
                        <td class="text-center">{{ $ro->id }}</td>
                        <td>{{ $ro->display_name }}</td>
                        <td>{{ $ro->description }}</td>
                        <td>
                            @foreach($ro->perms as $perm)
                                <span class="label label-info">{{ $perm->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if(Auth::user()->can(['role-delete']))
                                <a href="{{ url('/role/hapus', $ro->id) }}">
                                    <button type="submit" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i> Hapus
                                    </button>
                                </a>
                            @endif
                            @if(Auth::user()->can(['role-edit']))
                                <a href="{{ url('/role/edit', $ro->id) }}">
                                    <button type="submit" class="btn btn-warning btn-sm "><i class="fa fa-edit"></i> Edit
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection