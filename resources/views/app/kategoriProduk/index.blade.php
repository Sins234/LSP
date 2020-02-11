@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
    <h1>Kategori Produk Master</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Kategori Produk</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <a href="#" class="btn btn-flat btn-icon icon-left btn-primary" data-toggle="modal" data-target="#modalCreate"><i class="fas fa-cube"></i> Tambah Data</a>
                &nbsp;
                <a target="blank" href="{{ route('printKategoriProduk') }}" class="btn btn-flat btn-icon icon-left btn-primary"><i class="fas fa-print"></i> Cetak</a>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori Produk</th>
                        <th>Dibuat Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @include("_____FUNCTION.tglIndo")
                    @foreach($kategoriProduks as $res)
                        @php
                            $d = $res->created_at;
                            $t = $d->format('Y-m-d');
                        @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $res->kategori }}</td>
                        <td>
                            <div class="badge badge-success">
                                {{ tgl_indo($t) }}
                            </div>
                        </td>
                        <td>
                            <a href="#"__kategori="{{ $res->kategori }}" __action="{{ route('kategoriProduk.update', $res->id) }}" class="btn btn-outline-warning btn-sm edit"><i class="fas fa-edit"></i></a>
                            <a href="#" data-uri="{{ route('kategoriProduk.destroy', $res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDestroy"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog confirm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('kategoriProduk.store') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control" name="kategori" required="" placeholder="Kategori Produk">
                        <div class="invalid-feedback">
                            Form Kategori Produk harus diisi!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button id="openModalEdit" data-toggle="modal" data-target="#modalEdit" style="display:none"></button>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog confirm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEdit" method="POST" action="" class="needs-validation" novalidate="">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <input id="kategoriInputEdit" type="text" class="form-control" name="kategori" required="" placeholder="Kategori Produk">
                        <div class="invalid-feedback">
                            Form Kategori Produk harus diisi!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include("layouts.toastSession")
@endsection
@section("scriptLibraies")
    <script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/izitoast/js/iziToast.min.js') }}"></script>
@endsection
@section("scriptSpesific")
    <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>
@endsection
@section("scriptCustom")
    <script>
        $('.edit').click(function(e){
            e.preventDefault()

            let __kategori = $(this).attr("__kategori")
            let __action = $(this).attr("__action")

            $('#formEdit').attr("action", __action)
            $("#kategoriInputEdit").val(__kategori)

            $("#openModalEdit").click()
        })
    </script>
    @include("layouts.toastSession")
@endsection
