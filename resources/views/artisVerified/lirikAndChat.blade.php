@extends('artisVerified.components.artisVerifiedTemplate')

@section('content')
    <div class="main-panel">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <style>
            button {
                border: none;
                background: none;
            }

            .note-editor.note-frame .note-editing-area {
                overflow: hidden;
                background-color: #ffffff;
            }

            .dropdown-toggle::after {
                content: none;
            }

            .input-with-icon {
                display: flex;
                align-items: center;
            }

            .form-control {
                flex: 1;
            }

            .send-button {
                background-color: #957dad;
                /* Warna latar belakang tombol */
                color: #fff;
                /* Warna teks tombol */
                border: none;
                padding: 5px 10px;
                border-radius: 4px;
                cursor: pointer;
            }

            .send-button:hover {
                background-color: #634582;
                /* Warna latar belakang tombol saat dihover */
            }

            .full-width-button {
                width: 100%;
            }

            .slider {
                margin: 5px 0;
                width: 450px;
            }

            .slider:focus {
                outline: none;
            }

            .slider::-webkit-slider-runnable-track {
                width: 450px;
                cursor: pointer;
                animate: 0.2s;
                border-radius: 25px;
            }

            .slider::-webkit-slider-thumb {
                height: 20px;
                width: 20px;
                border-radius: 50%;
                background: #fff;
                box-shadow: 0 0 4px 0 rgba(0, 0, 0, 1);
                cursor: pointer;
            }

            #range {
                accent-color: #957dad;
            }

            .range-wrap {
                width: 450px;
                position: relative;
            }

            .range-value {}

            .range-value span {
                width: 30px;
                height: 24px;
                line-height: 24px;
                text-align: center;
                color: #957DAD;
                font-size: 12px;
                display: block;
                position: absolute;
                left: 50%;
                transform: translate(-50%, 0);
                border-radius: 6px;
            }

            .range-value span:before {
                position: absolute;
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                margin-top: -1px;
            }

            .output {
                margin-bottom: -100px;
                width: 100%;
                font-size: 2em;
                color: #957DAD;
            }
        </style>
        <div class="content-wrapper">
            <div class="row">
                <style>
                    .chat-box {
                        overflow-y: scroll;
                        height: 70vh;
                        background-color: white;
                        border-radius: 10px;
                        border: 1px solid rgba(0, 0, 0, 0.2);
                        padding: 10px;
                    }

                    /* CSS untuk pesan chat */
                    .chat-message {
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        margin-bottom: 10px;
                    }

                    .chat-name {
                        font-size: 12px;
                        color: rgb(171, 171, 171);
                        text-align: right;
                    }

                    .chat-text {
                        font-size: 14px;
                        color: rgb(52, 52, 52);
                        background-color: whitesmoke;
                        max-width: 50%;
                        border-radius: 15px;
                        padding: 8px 15px;
                    }

                    .chat-input {
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        padding: 10px;
                        display: flex;
                        align-items: center;
                        background-color: white;
                        background-color: white;
                        border-radius: 10px;
                        border: 1px solid #c9c9c9;
                    }

                    .chat-message.sent {
                        align-items: flex-end;
                    }

                    .chat-message.received {
                        align-self: flex-start;
                    }
                </style>
                <div class="col-md-6">
                    <div class="card kanan scrollbar-dusty-grass square thin rounded-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        <div class="preview-item">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <h3 class="fw-semibold mb-3" style="color: #957dad; margin-top: -30px;">Chat
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="chat" style="margin-top: -20px; position: relative">
                                            <form action="{{ route('message.project.artisVerified', $project->code) }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="id_project" value="{{ $project->id }}">
                                                <div class="card">
                                                    <div style="height: 415px">
                                                        <div class="card-body chat-box" style="height: 355px;">
                                                            @foreach ($messages as $key => $item)
                                                                <div
                                                                    class="chat-message mt-1 {{ $item->sender->user->id === auth()->user()->id ? 'sent' : 'received' }}">
                                                                    @if ($key == 0 || $item->sender->user->name != $messages[$key - 1]->sender->user->name)
                                                                        <div class="chat-name">
                                                                            {{ $item->sender->user->name }}
                                                                        </div>
                                                                    @endif
                                                                    <div class="chat-text">{{ $item->message }}</div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="input-with-icon chat-input">
                                                            <input type="text" class="form-control rounded-4"
                                                                placeholder="Ketik di sini" maxlength="250"
                                                                name="message">
                                                            <button type="submit" class="send-button ml-2 mr-1">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .cobai {
                        width: 150px;
                        height: 150px;
                        position: relative;
                        overflow: hidden;
                        border: none;
                        color: #957dad;
                        background-color: white
                    }

                    .cobai:hover {
                        background-color: #69547d;
                        color: #eaeaea;
                    }

                    .inputgambar {
                        display: none;
                    }

                    label {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: pointer;
                        width: 100%;
                        height: 100%;
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        margin: 0;
                    }

                    .upload-label i {
                        font-size: 20px;
                        margin-bottom: 10px;
                    }

                    .form-i {
                        height: 35px;
                        border-radius: 8px;
                    }

                    .inputcolor {
                        background-color: white
                    }

                    .inputcolor:hover {
                        background-color: white
                    }

                    #popup:target {
                        visibility: visible;
                    }
                </style>
                @if ($project->artist_id === $artis->id)
                    <div class="col-md-6">
                        <div class="card kiri scrollbar-dusty-grass square thin rounded-4">
                            <div class="card-body">
                                <div class="row">
                                    <h3 class="fw-semibold mb-3" style="color: #957dad; margin-top: -10px;">Unggah Musik
                                        Kolaborasi</h3>
                                    <div class="col-12">
                                        <div class="preview-list">
                                            <form action="{{ route('create.project.artisVerified', $project->code) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-5 pr-0">
                                                        <div class="card cobai">
                                                            <label for="gambar" id="tampil_gambar">
                                                                <i class="fas fa-pen fa-2x"></i>
                                                            </label>
                                                            <input type="file" id="gambar" name="images"
                                                                accept="image/png,image/jpg" class="inputgambar" required>
                                                        </div>
                                                        @if ($errors->has('images'))
                                                            <div class="text-danger" style="font-size: 12px;">
                                                                {{ $errors->first('images') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="mb-4">
                                                            <input type="text" required class="form-control form-i inputcolor"
                                                                name="name" id="nama" placeholder="Judul Lagu"
                                                                value="{{ old('name') }}" maxlength="55">
                                                            @if ($errors->has('name'))
                                                                <div class="text-danger" style="font-size: 12px">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="my-3">
                                                            <input type="file" name="audio"
                                                                class="form-control inputcolor" id="namaproyek" required
                                                                value="{{ old('audio') }}">
                                                            @if ($errors->has('audio'))
                                                                <div class="text-danger" style="font-size: 12px">
                                                                    {{ $errors->first('audio') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <select name="genre" class="form-select"
                                                                style="border-radius: 13px"
                                                                aria-label="Default select example" required>
                                                                <option value="" disabled selected>Music Genre
                                                                </option>
                                                                @foreach ($genre as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button class="btn pl-3 kirim rounded-3 full-width-button"
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#kirimkolaborasi-{{ $project->code }}">
                                                        Unggah
                                                    </button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <style>
                        label {
                            justify-content: start
                        }
                    </style>
                    <div class="col-md-6">
                        <div class="card kiri scrollbar-dusty-grass square thin rounded-4">
                            <div class="card-body">
                                <div class="row">
                                    <h3 class="fw-semibold mb-3" style="color: #957dad; margin-top: -10px;">Detail
                                        Kolaborasi</h3>
                                    <div class="col-12">
                                        <div class="preview-list">
                                            <form action="{{ route('create.project.artisVerified', $project->code) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="namakategori"
                                                                class="form-label judulnottebal fs-6">Nama Project</label>
                                                            <input type="text"
                                                                class="form-control form-i inputcolor bg-white"
                                                                name="name" value="{{ $project->name }}"
                                                                id="nama" readonly disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="namakategori"
                                                                class="form-label judulnottebal fs-6">Konsep</label>
                                                            <textarea name="konsep" disabled class="form-control form-i inputcolor bg-white" cols="30" rows="10"
                                                                readonly>{{ $project->konsep }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="namakategori"
                                                                class="form-label judulnottebal fs-6">Harga</label>
                                                            <input type="text" name="harga"
                                                                class="form-control inputcolor bg-white" id="namaproyek"
                                                                value="Rp. {{ number_format($uang, 2, ',', '.') }}"
                                                                readonly disabled>
                                                            <span class="pl-1"
                                                                style="color: darkgray; font-size: 13px;">admin memiliki
                                                                hak sebesar 20% dalam penghasilan kolaborasi.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Modal -->
            <div class="modal fade" id="kirimkolaborasi-{{ $project->code }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                {{-- <form action="{{ route('bayar', $project->code) }}" method="post"> --}}
                {{-- @csrf --}}
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0" style="background-color: white">
                        <div class="modal-header border-0">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #957DAD">Pembayaran</h1>
                            <button type="button" class="btn-unstyled" data-bs-dismiss="modal" aria-label="Close">
                                <i class="mdi mdi-close-circle-outline btn-icon" style="color: #957DAD"></i>
                            </button>
                        </div>
                        <div class="modal-body border-0">
                            <div class="col-md-12" style="font-size: 13px">
                                <h5 class="judulnottebal mb-4">Persentase Pembayaran</h5>
                                <div class="mb-3">
                                    <div class="range-wrap">
                                        <div class="range-value" id="rangeV">0%</div>
                                        <input class="slider mb-4" id="range" name="range" type="range"
                                            min="40" max="60" step="1">
                                        <output for="range" class="output">Rp. 0</output>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn rounded-3 full-width-button">
                                <a href="" class="btn-link"
                                    style="color: inherit; text-decoration: none;">Bayar</a>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
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

        const range = document.getElementById('range');
        const rangeV = document.getElementById('rangeV');
        const output = document.querySelector('.output');

        const setValue = () => {
            fetch(`/nominal`)
                .then(response => response.json())
                .then(data => {
                    const faktor = data.nominal;
                    const persentase = Number(range.value);
                    if (persentase < 40) {
                        range.value = 40;
                    } else if (persentase > 80) {
                        range.value = 80;
                    }
                    const uang = (persentase / 100) * faktor;
                    rangeV.innerHTML = `${persentase}%`;
                    const harga = formatRupiah(uang);
                    output.textContent = harga;
                })
                .catch(error => {
                    const persentase = Number(range.value);
                    if (persentase < 40) {
                        range.value = 40;
                    } else if (persentase > 80) {
                        range.value = 80;
                    }

                    const uang = (persentase / 100) * 20000;
                    rangeV.innerHTML = `${persentase}%`;

                    const harga = formatRupiah(uang);
                    output.textContent = harga;
                });

        };

        const formatRupiah = (angka) => {
            return angka.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
        };


        document.addEventListener("DOMContentLoaded", () => {
            setValue();
        });

        range.addEventListener('input', () => {
            setValue();
        });

        // Agar rangeV mengikuti pergerakan thumb
        range.addEventListener('mousemove', () => {
            const newValue = Number(range.value);
            const newPosition = 10 - (newValue * 0.2);
            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        });
    </script>
    </div>
@endsection
