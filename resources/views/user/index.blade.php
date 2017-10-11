@extends('layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                @if(Auth::user()->can(['user-create']))
                    <a href="{{ url('/user/tambah') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                @endif
            </h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tr>
                    <th style="width: 10px" class="text-center">Id</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th class="text-center" colspan="{{ count($roles) }}">User Role</th>

                    @if(Auth::user()->can(['user-edit','user-delete']))
                        <th style="width: 150px" class="text-center">Aksi</th>
                    @endif
                </tr>

                @foreach ($user as $us)
                    <tr>
                        <td class="text-center">{{ $us->id }}</td>
                        <td>{{ $us->name }}</td>
                        <td>{{ $us->email }}</td>
                        @foreach ($roles as $role)
                            <td class="text-center">
                                <input id="{{ $role->id }}-{{ $us->id }}" class="filled-in"
                                       onclick="return coba('{{$us->id}}','{{$role->id}}','{{ $role->id }}-{{ $us->id }}')"
                                       type="checkbox"
                                       @if($us->hasRole($role->name))
                                       checked
                                        @endif
                                >
                                <label for="{{ $role->id }}-{{ $us->id }}">
                                    {{$role->display_name}} </label>
                            </td>
                        @endforeach
                        <td class="text-center">
                            @if(Auth::user()->can(['user-delete']))
                                <a href="{{ url('/user/hapus', $us->id) }}">
                                    <button type="submit" class="btn btn-danger btn-sm "><i
                                                class="fa fa-trash"></i> Hapus
                                    </button>
                                </a>
                            @endif
                            @if(Auth::user()->can(['user-edit']))
                                <a href="{{ url('/user/edit', $us->id) }}">
                                    <button type="submit" class="btn btn-warning btn-sm "><i
                                                class="fa fa-edit"></i> Edit
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
        function coba(user, role, id) {
            var url = "user/edtuserrole";
            var $x = $("#" + id);

            if ($x.is(":checked")) {
                $.ajax({
                    url: "http://localhost:8000/user/makeuserrole/" + user + "/" + role
                });
            }
            else {
                $.ajax({
                    url: "http://localhost:8000/user/deleuserrole/" + user + "/" + role
                });
            }
        }
    </script>
@endsection