@extends('layouts.app')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                @if(Auth::user()->can(['keluhan-create']))
                    <a href="{{ url('/keluhan/tambah') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                        Tambah</a>
                @endif
            </h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tr>
                    <th style="width: 10px" class="text-center">Id</th>
                    <th>Invoice</th>
                    <th>Pelapor</th>
                    <th>Nama Product</th>
                    <th>Status</th>
                    <th>Pekerja</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">
                        @if(Auth::user()->can(['keluhan-edit','keluhan-delete']))
                            Aksi
                        @else
                            Print PDF
                        @endif
                    </th>
                </tr>

                @foreach ($keluhan as $kln)
                    <tr>
                        <td class="text-center">{{ $kln->id }}</td>
                        <td>{{ $kln->invoice}}</td>
                        <td>{{ $kln->user['name']}}</td>
                        <td>{{ $kln->product['name']}}</td>
                        <td>
                            @if($kln->status == 1)
                                <a
                                        @if(Auth::user()->can('keluhan-kerjakan'))
                                        href="{{url('/keluhan/kerjakan', $kln->id)}}"
                                        @else
                                        disabled
                                        @endif
                                        type="button"
                                        class="btn btn-sm btn-danger">
                                    <i class="fa fa-edit"></i> Belum di tanggapi
                                </a>
                            @elseif($kln->status == 2)
                                @foreach($kln->pekerja as $pkr)
                                    <a
                                            @if(Auth::user()->can('keluhan-kerjakan'))
                                            href="{{url('/keluhan/kerjakan', $kln->id)}}"
                                            @elseif(Auth::user()->id != $pkr->id )
                                            disabled
                                            @else
                                            disabled
                                            @endif
                                            type="button"
                                            class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                        Sedang di proses
                                    </a>
                                @endforeach
                            @else
                                <a type="button"
                                   class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                    Masalah selesai
                                </a>
                            @endif
                        </td>
                        <td>
                            @foreach($kln->pekerja as $pkr)
                                {{ $pkr->name }}
                            @endforeach
                        </td>
                        <td>
                            @if($kln->status == 3)
                                <center>
                                    <a @if(Auth::user()->can('keluhan-rate'))
                                       href="{{ url('/keluhan/dislike', $kln->id) }}"
                                       @else
                                       disabled
                                       @endif
                                       class="btn @if($kln->rate == 2) btn-danger @endif btn-sm ">
                                        <i class="fa fa-thumbs-o-down"></i>
                                        Dislike
                                    </a>
                                    <a @if(Auth::user()->can('keluhan-rate'))
                                       href="{{ url('/keluhan/like', $kln->id) }}"
                                       @else
                                       disabled
                                       @endif
                                       class="btn @if($kln->rate == 3) btn-success @endif btn-sm ">
                                        <i class="fa fa-thumbs-o-up"></i>
                                        Like
                                    </a>
                                </center>
                            @else
                                <center>unrated</center>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(Auth::user()->can(['keluhan-delete']))
                                <a href="{{ url('/keluhan/hapus', $kln->id) }}">
                                    <button type="submit" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </a>
                            @endif
                            @if(Auth::user()->can(['keluhan-edit']))
                                <a href="{{ url('/keluhan/edit', $kln->id) }}">
                                    <button type="submit" class="btn btn-warning btn-sm "><i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                </a>
                            @endif
                            <a href="{{ url('/keluhan/pdf', $kln->id) }}">
                                <button type="submit" class="btn btn-info btn-sm "><i class="fa fa-print"></i>
                                    PDF
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
