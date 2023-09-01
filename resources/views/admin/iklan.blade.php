@extends('admin.components.adminTemplate')

@section('content')
<link rel="stylesheet" href="/admin/assets/css/iklan.css">
    <!-- partial | ISI -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="sejajar">
                            <h3 class="judul">Papan iklan</h3>
                            <div class="text-lg-end mb-3">
                                <a href="#popuptambah" class="btn full-width-btn" type="button">
                                    <i class="fas fa-plus"></i>
                                    Tambah iklan
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="table-body">
                                    <div class="table-container">
                                        <table class="table">
                                            <thead class="table-header">
                                                <tr class="table-row headerlengkung">
                                                    <th class="table-cell">Gambar</th>
                                                    <th class="table-cell">Nama Artis</th>
                                                    <th class="table-cell">Deskripsi</th>
                                                    <th class="table-cell">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-row">
                                                    <td class="table-cell">
                                                        <div class="cell-content">
                                                            <img src="../assets/images/faces/face9.jpg" alt="Face"
                                                                class="avatar">
                                                        </div>
                                                    </td>
                                                    <td class="table-cell">Agnez Monica</td>
                                                    <td class="table-cell">Agnez Monica ...</td>
                                                    <td class="table-cell">
                                                        <a href="#popupdetail" class="btn btnicon">
                                                            <i class="far fa-eye text-info"></i>
                                                        </a>
                                                        <button class="btn btnicon">
                                                            <i class="far fa-times-circle text-danger"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <div class="text-center">
                                            <ul class="pagination justify-content-center">
                                                <!-- Item-item pagination akan ditambahkan secara dinamis menggunakan JavaScript -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- partial -->
                    </div>

                    <!-- popup -->
                    <div id="popuptambah">
                        <div class="card window">
                            <div class="card-body">
                                <a href="#" class="close-button far fa-times-circle"></a>
                                <h3 class="judul">Tambah Iklan</h3>
                                <form class="row" action="">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="namakategori" class="form-label judulnottebal">Nama
                                                artis</label>
                                            <input type="text" class="form-control form-i" id="namaproyek" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label judulnottebal">Deskripsi</label>
                                            <textarea id="deskripsi" class="form-control" maxlength="500" rows="6" required></textarea>
                                        </div>
                                    </div>
                                    <div class="text-md-right">
                                        <a href="#" class="btn" type="submit">Tambah</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="popupdetail">
                        <div class="card window">
                            <div class="card-body">
                                <a href="#" class="close-button far fa-times-circle"></a>
                                <h3 class="judul">Detail Papan Iklan</h3>
                                <form class="row" action="">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="namakategori" class="form-label judulnottebal">Gambar</label>
                                            <div class="cell-content">
                                                <img src="../assets/images/faces/face9.jpg" alt="Face"
                                                    class="avatar">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="namakategori" class="form-label judulnottebal">Nama
                                                artis</label>
                                            <input type="text" class="form-control form-i" id="namaproyek"
                                                value="Agnez Monica" readonly disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label judulnottebal">Deskripsi</label>
                                            <textarea id="deskripsi" class="form-control" maxlength="500" rows="6" readonly disabled>Agnes Monica Muljoto, yang dikenal dengan nama profesional Agnez Mo, adalah seorang penyanyi, penulis lagu, penari, dan aktris Indonesia. Pada awal kariernya, dia juga dikenal sebagai Agnes Monica. </textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->



            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                /* ============Dengan Rupiah=========== */
                var harga = document.getElementById('harga');
                harga.addEventListener('keyup', function(e) {
                    harga.value = formatRupiah(this.value, 'Rp. ');
                });

                /* Fungsi */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }


                /*================Pagination===================*/

                $(document).ready(function() {
                    var itemsPerPage = 5;

                    $(".table-row").hide();


                    $(".table-row").slice(0, itemsPerPage).show();


                    var numPages = Math.ceil($(".table-row").length / itemsPerPage);


                    for (var i = 1; i <= numPages; i++) {
                        $(".pagination").append("<li class='page-item'><a class='page-link' href='#'>" + i + "</a></li>");
                    }

                    if (numPages <= 1) {
                        $(".pagination").hide();
                    }

                    $(".pagination a").click(function(e) {
                        e.preventDefault();
                        var page = $(this).text();
                        var start = (page - 1) * itemsPerPage;
                        var end = start + itemsPerPage;
                        $(".table-row").hide();
                        $(".table-row").slice(start, end).show();
                        $(".pagination a").removeClass("active");
                        $(this).addClass("active");
                    });

                    $(".pagination .prev").click(function(e) {
                        e.preventDefault();
                        var activePage = $(".pagination .active").text();
                        var prevPage = parseInt(activePage) - 1;
                        if (prevPage >= 1) {
                            $(".pagination a").eq(prevPage - 1).click();
                        }
                    });
                });
            </script>
        @endsection
