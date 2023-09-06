@extends('artisVerified.components.artisVerifiedTemplate')

@foreach ($datas as $item)
    <div class="modal fade" id="staticBackdrop-{{ $item->code }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Kolaborasi</h1>
                    <button type="button" class="btn-unstyled" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close-circle-outline btn-icon text-danger"></i>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label"><b>Judul Lagu </b><strong class="">:</strong>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $item->name }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label"><b>Deskripsi </b><strong
                                class="">:</strong></label>
                        <div class="col-sm-5">
                            <p class="judul-lagu text-dark">{{ $item->konsep }}</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info rounded-3">
                        <a href="{{ route('lirikAndChat.artisVerified', $item->code) }}" class="btn-link"
                            style="color: inherit; text-decoration: none;">Buat
                            Proyek</a></button>
                </div>
            </div>
        </div>
    </div>
@endforeach


@section('content')
    <div class="main-panel">
        <style>
            .table-container {
                margin-bottom: 20px;
            }

            .table-sortable th {
                cursor: pointer;
                border-radius: 10px;
            }

            .table-sortable .th-sort-asc::after {
                content: "\25b4";
            }

            .table-sortable .th-sort-desc::after {
                content: "\25be";
            }

            .table-sortable .th-sort-asc::after,
            .table-sortable .th-sort-desc::after {
                margin-left: 10px;
            }

            /*---- style untuk table ----*/
            .table-body {
                padding: 20px;
            }


            .table-container {
                max-width: 100%;
                overflow-x: auto;
            }

            .table {
                width: 100%;
                border-spacing: 0;
            }

            .header {
                margin-bottom: 10px;
                background-color: #957DAD;
                overflow: hidden;
            }

            .table-cell {

                flex: 1;

                padding-left: 10%;

                text-align: left;

                padding: 10px;

            }

            .table-header {
                padding-top: 10px;
                padding-bottom: 10px;
                color: white;
            }

            .avatar {
                width: 40px;
                margin-right: 10px;
            }

            .table td img {
                border-radius: 0;
            }

            .cell-content {
                display: flex;
                align-items: center;
            }

            .table-cell h6,
            .table-cell p {
                margin: 0;
                padding: 5px 0;
            }

            .table-container {
                margin-bottom: 20px;
            }

            /*---- style untuk header dengan border lengkung ----*/
            .headerlengkung th:first-child {
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
            }

            .headerlengkung th:last-child {
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            /*---- style untuk jangka ----*/
            .card .card-body {
                padding: 5px 20px;
            }

            /* Style tombol sejajar */
            .sejajar {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
            }

            #tambahkategori {
                width: 100%;
                height: 100%;
                position: fixed;
                background: rgba(0, 0, 0, 0.7);
                top: 0;
                left: 0;
                z-index: 9999;
                visibility: hidden;
            }

            #tambahkategori .card-body {
                padding: 10px 7% 10px 7%;
            }

            /* Memunculkan Jendela Pop Up*/
            #tambahkategori:target {
                visibility: visible;
            }

            .window {
                background-color: #ffffff;
                width: 500px;
                border-radius: 10px;
                position: relative;
                margin: 7% auto;
                padding: 10px;
            }

            .close-button {
                display: block;
                color: #957dad;
                position: absolute;
                top: 10px;
                right: 10px;
            }
        </style>
        <div class="content-wrapper">
            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="sejajar">
                        <h3 style="color: #957DAD">Kolaborasi</h3>
                        <div class="text-lg-end mb-3">
                            <a href="#tambahkategori" class="btn full-width-btn" type="button">
                                <i class="fas fa-plus"></i>
                                Tambah kolaborasi
                            </a>
                        </div>
                    </div>
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="table-container">
                                <table class="table custom-table mt-3" style="">
                                    <thead class="table-header">
                                        <tr class="table-row header headerlengkung">
                                            <th class="table-cell"> Nama Proyek </th>
                                            <th class="table-cell"> Harga </th>
                                            <th class="table-cell"> Tanggal </th>
                                            <th class="table-cell"> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            @if (!$item->is_reject && $item->judul == 'none' && $item->lirik == 'none')
                                                <tr class="table-row">
                                                    <td class="table-cell">
                                                        <span class="pl-2">{{ $item->name }}</span>
                                                    </td>
                                                    <td class="table-cell">
                                                        <div>Rp {{ $item->harga }}</div>
                                                    </td>
                                                    <td class="table-cell">{{ $item->created_at->format('d F Y') }}</td>
                                                    <td class="d-flex align-items-center">
                                                        <a href="" class="btn-unstyled" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop-{{ $item->code }}">
                                                            <i class="mdi mdi-eye btn-icon text-primary" style="font-size: 20px; margin-right: 2px;"></i>
                                                        </a>
                                                        <form id="reject" action="{{ route('reject.project.artisVerified') }}" method="post"
                                                        class="">
                                                        @csrf
                                                        <button href="" type="submit">
                                                            <input type="hidden" name="code"
                                                                value="{{ $item->code }}">
                                                            <input type="hidden" name="is_reject" value="true">
                                                            <i
                                                                class="mdi mdi-close-circle-outline btn-icon text-danger" style="font-size: 20px"></i>
                                                        </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div id="tambahkategori">
                <div class="card window">
                    <div class="card-body">
                        <a href="" class="close-button far fa-times-circle"></a>
                        <h3 class="judul p-0 mb-3">Tambah Kolaborasi</h3>
                        <form class="row" action="{{ route('createProject.artisVerified') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12" style="font-size: 13px">
                                <div class="mb-3">
                                    <label for="namakategori" class="form-label judulnottebal">Nama
                                        Proyek</label>
                                    <input type="text" name="name" class="form-control form-i"
                                        id="namaproyek" required>
                                </div>
                                <div class="mb-3">
                                    <label for="konsep"
                                        class="form-label judulnottebal">Deskripsi</label>
                                    <textarea id="konsep" name="konsep" class="form-control" maxlength="500" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="text-md-right">
                                <button type="submit" href="#" class="btn"
                                    type="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
