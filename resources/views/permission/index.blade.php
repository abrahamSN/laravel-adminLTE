@extends('layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                @if(Auth::user()->can(['permission-create']))
                    <a href="{{ url('/permission/tambah') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                        Tambah</a>
                @endif
            </h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tr>
                    <th style="width: 10px" class="text-center">Id</th>
                    <th>Nama Permission</th>
                    <th>Nama Unik Permission</th>
                    <th class="text-center" colspan="{{ count($roles) }}">Permission Role</th>

                    @if(Auth::user()->can(['permission-edit','permission-delete']))
                        <th style="width: 150px" class="text-center">Aksi</th>
                    @endif
                </tr>

                @foreach ($perms as $perm)
                    <tr>
                        <td class="text-center">{{ $perm->id }}</td>
                        <td>{{ $perm->display_name }}</td>
                        <td>{{ $perm->name }}</td>

                        @foreach ($roles as $role)
                            <td class="text-center">
                                <input id="{{ $role->id }}-{{ $perm->id }}" class="filled-in"
                                       onclick="return coba('{{$perm->id}}','{{$role->id}}','{{ $role->id }}-{{ $perm->id }}')"
                                       type="checkbox"
                                       @if($perm->hasRole($role->name))
                                       checked
                                        @endif
                                >
                                <label for="{{ $role->id }}-{{ $perm->id }}">
                                    {{$role->display_name}}</label>
                            </td>
                        @endforeach

                        <td>
                            @if(Auth::user()->can(['permission-delete']))
                                <a href="{{ url('/permission/hapus', $perm->id) }}">
                                    <button type="submit" class="btn btn-danger btn-sm ">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </a>
                            @endif
                            @if(Auth::user()->can(['permission-edit']))
                                <a href="{{ url('/permission/edit', $perm->id) }}">
                                    <button type="submit" class="btn btn-warning btn-sm ">
                                        <i class="fa fa-edit"></i> Edit
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

@section('js')

    <script type="text/javascript">
        function coba(perm, role, id) {
            var url = "permission/edtpermirole";
            var $x = $("#" + id);

            if ($x.is(":checked")) {
                $.ajax({
                    url: "http://localhost:8000/permission/makepermirole/" + perm + "/" + role
                });
            }
            else {
                $.ajax({
                    url: "http://localhost:8000/permission/delepermirole/" + perm + "/" + role
                });
            }
        }
    </script>
@endsection