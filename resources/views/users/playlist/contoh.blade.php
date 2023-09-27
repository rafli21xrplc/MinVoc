@extends('users.components.usersTemplates')

@section('content')
    @include('partials.tambahkeplaylist')
    <link rel="stylesheet" href="/user/assets/css/contohPlaylist.css">
    <style>
        .coba {
            width: 200px;
            height: 200px;
            position: relative;
            overflow: hidden;
            border: none;
            margin-right: 5px;

            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 10px;
            margin: 0;
            color: #957dad;
        }

        .coba:hover {
            background-color: #8452b5;
            color: #ffffff;
        }

        .cobai {
            width: 150px;
            height: 150px;
            position: relative;
            overflow: hidden;
            border: none;
            color: #957dad;
        }

        .cobai:hover {
            background-color: #69547d;
            color: #eaeaea;
        }

        .coba img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .custom-container {
            display: flex;
            flex-direction: column;
            position: relative;
            height: 100%;
        }

        .bottom-left-text {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 10px;
        }

        .img-and-text {
            display: flex;
            align-items: center;
        }

        .img-and-text img {
            margin-right: 10px;
        }

        .judulnottebal {
            margin: 0;
            display: flex;
            align-items: center;
        }

        .divider {
            border: none;
            border-top: 2px solid #6d6d6d;
            margin: 20px 0;
        }

        .scroll {
            position: relative;
            overflow-y: scroll;
            height: 50vh;
        }

        .scrollbar-down::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border-radius: 10px;
        }

        .scrollbar-down::-webkit-scrollbar {
            width: 12px;
            background-color: #f5f5f5;
        }

        .scrollbar-down::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #957dad;
        }

        .thin::-webkit-scrollbar {
            width: 6px;
        }

        #tambahkeplaylist {
            width: 100%;
            height: 100%;
            position: fixed;
            background: rgba(0, 0, 0, 0.7);
            top: 0;
            left: 0;
            z-index: 9999;
            visibility: hidden;
        }

        #tambahkeplaylist .card-body {
            padding: 10px 7% 10px 7%;
        }

        /* Memunculkan Jendela Pop Up Detail*/
        #tambahkeplaylist:target {
            visibility: visible;
        }

        .windowi {
            background-color: #ffffff;
            width: 300px;
            border-radius: 10px;
            position: relative;
            margin: 15% auto;
            padding: 10px;
        }

        .close-button {
            display: block;
            color: #957dad;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .judul {
            font-size: 20px;
        }

        .iconminus {
            border: none;
            padding: 0 0 0 5px;
            font-size: 17px;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="custom-container">
                        <div class="row">
                            <div class="col-3">
                                @if ($playlistDetail->user_id === auth()->user()->id)
                                    <div class="col-3">
                                        <a href="#popup" class="card coba">
                                            <img src="{{ asset('storage/' . $playlistDetail->images) }}" alt="Gambar">
                                        </a>
                                    </div>
                                @else
                                    <div class="col-3">
                                        <div class="card coba">
                                            <img src="{{ asset('storage/' . $playlistDetail->images) }}" alt="Gambar">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-9 text-xxl-end">
                                <div class="bottom-left-text">
                                    <h3 class="m-0" style="font-weight: 600">{{ $playlistDetail->name }}
                                    </h3>
                                    <p style="font-size: 16px; margin-top: 3px;">
                                        <span class="mt-5">
                                            <img src="{{ asset('storage/' . $playlistDetail->user->avatar) }}" width="20" style="border-radius: 20px" alt="" srcset="">
                                        </span>
                                        {{ $playlistDetail->user->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr class="divider"> <!-- Divider -->
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <h3 class="card-title judul">{{ $playlistDetail->deskripsi == 'none' ? '' : "$playlistDetail->deskripsi" }}</h3>
                <form class="col-6 mb-4 p-0 nav-link search">
                    <input type="text" id="search_song" class="form-control rounded-4" placeholder="Cari musik">
                    <ul id="search-results-song"></ul>
                </form>
                <div class="card scroll scrollbar-down thin">
                    <div class="card-body">
                        <div class="row" style="margin-top: -20px">
                            <div class="col-12">
                                <div class="preview-list">
                                    @foreach ($songs->reverse() as $item)
                                        @if ($item->is_approved)
                                            <div class="preview-item">
                                                <div class="preview-thumbnail">
                                                    <img src="{{ asset('storage/' . $item->image) }}" width="10%">
                                                </div>
                                                <div class="preview-item-content d-sm-flex flex-grow">
                                                    <a href="#lagu-diputar" class="flex-grow text-decoration-none link"
                                                        onclick="putar({{ $item->id }})">
                                                        <h6 class="preview-subject">{{ $item->judul }}</h6>
                                                        <p class="text-muted mb-0">{{ $item->artist->user->name }}</p>
                                                    </a>
                                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                        <div class="text-group">
                                                            <i id="audio-player-like-icon like"
                                                                data-id="{{ $item->id }}"
                                                                onclick="toggleLike(this, {{ $item->id }})"
                                                                class="shared-icon-like {{ $item->likes > 0 ? 'fas' : 'far' }} fa-heart pr-2"></i>
                                                            <p>{{ $item->waktu }}</p>
                                                            @if (count($playlists) > 0)
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop-{{ $item->code }}"
                                                                    style="color: #957dad">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                        y="0px" width="20" height="20"
                                                                        viewBox="0 2 24 24">
                                                                        <path fill="#957DAD"
                                                                            d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 11 L 7 11 L 7 13 L 11 13 L 11 17 L 13 17 L 13 13 L 17 13 L 17 11 L 13 11 L 13 7 L 11 7 z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                            <form action="{{ route('hapusSongPlaylist', $item->code) }}"
                                                                method="get">
                                                                <button type="submit" class="iconminus">
                                                                    <i class="far fa-minus-square text-danger"
                                                                        style="font-size: 19px"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endIf
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <style>
        .btn-delete {
            background-color: rgb(215, 0, 0);
        }

        .btn-delete:hover {
            color: red;
            background-color: white;
            border: 1px solid red;
        }

        .button-container {
            display: inline-block;
            margin-right: 13px;
        }
    </style>

    <div id="popup">
        <div class="card window">
            <div class="card-body">
                <a href="#" class="close-button mdi mdi-close-circle-outline"></a>
                <h3 class="judul">Edit Playlist</h3>
                <div>
                    <form class="row" action="{{ route('ubah.playlist', $playlistDetail->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-4">
                            <div class="card cobai">
                                <label for="gambar" id="tampil_gambar">
                                    <img src="{{ asset('storage/' . $playlistDetail->images) }}"
                                        style="height: 100%; object-fit: cover;" width="150" alt="Gambar">
                                </label>
                                <input type="file" id="gambar" name="images" accept="image/png,image/jpg"
                                    class="inputgambar">
                            </div>
                        </div>
                        <div class="col-md-7 ml-4">
                            <div class="mb-3">
                                <input type="text" class="form-control form-i" name="name" id="nama"
                                    placeholder="{{ $playlistDetail->name }}">
                            </div>
                            <div class="mb-3">
                                <textarea id="deskripsi" class="form-control" name="deskripsi" maxlength="500" rows="6"
                                    placeholder="{{ $playlistDetail->deskripsi == 'none' ? '' : $playlistDetail->deskripsi }}"></textarea>
                            </div>
                        </div>
                        <div class="text-md-right col-md-12">
                            <div class="button-container"> <!-- Add this container -->
                                <button class="btn btn-primary" type="submit">Ubah</button>
                                <button form="hapus" class="btn btn-delete" type="submit">Hapus</button>
                            </div>
                        </div>
                    </form>
                    <form id="hapus" action="{{ route('hapus.playlist.user', $playlistDetail->code) }}"
                        method="GET">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function myFunction(x) {
            x.classList.toggle("far"); // Menghapus kelas "fa fa-heart"
            x.classList.toggle("fas"); // Menambahkan kelas "fas fa-heart"
            x.classList.toggle("warna-kostum-like"); // Menambahkan kelas warna merah
        }

        const gambar = document.querySelector("#gambar");

        const tampilGambar = document.querySelector("#tampil_gambar");

        gambar.addEventListener("change", function() {
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                tampilGambar.style.backgroundImage = `url(${reader.result})`;

                tampilGambar.innerHTML = "";
            });

            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
