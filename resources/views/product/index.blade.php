@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                @if(Auth::user()->can(['product-create']))
                    <a href="{{ url('/product/tambah') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                @endif
            </h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tr>
                    <th style="width: 10px" class="text-center">Id</th>
                    <th style="width: 100px">Nama Product</th>
                    <th style="width: 150px">Deskripsi Product</th>
                    @if(Auth::user()->can(['product-edit','product-delete']))
                        <th style="width: 150px" class="text-center">Aksi</th>
                    @endif
                </tr>

                @foreach ($product as $pr)
                    <tr>
                        <td class="text-center">{{ $pr->id }}</td>
                        <td>{{ $pr->name }}</td>
                        <td>{{ $pr->keterangan }}</td>
                        <td class="text-center">
                            @if(Auth::user()->can(['product-delete']))
                                <a href="{{ url('/product/hapus', $pr->id) }}">
                                    <button type="submit" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i> Hapus
                                    </button>
                                </a>
                            @endif
                            @if(Auth::user()->can(['product-edit']))
                                <a href="{{ url('/product/edit', $pr->id) }}">
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