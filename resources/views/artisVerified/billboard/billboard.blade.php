@extends('artisVerified.components.artisVerifiedTemplate')

@section('content')
    <link rel="stylesheet" href="/user/assets/css/billboard.css">
    @include('partials.tambahkeplaylist')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card thin rounded-4" style="border: 1px solid #EAEAEA;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <div class="preview-list">
                                        <div class="d-flex flex-column gap-3" style="color: #6C6C6C;">
                                            <span class="fw-bold fs-4">{{ $billboard->artis->user->name }}</span>
                                            <span class="fs-5">{{ $billboard->deskripsi }}.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex text-right justify-content-center">
                                    <img src="{{ asset('storage/' . $billboard->image_artis) }}" alt=""
                                        class="d-block" style="width: 250px; height: 350px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="cards d-flex justify-content-center z-3 gap-4"
                        style="margin-top: -150px; margin-left: 12px;">
                        @foreach ($albums as $item)
                            <a href="{{ route('albumBillboard.artisVerified', $item->code) }}">
                                <img src="{{ asset('storage/' . $item->image) }}" width="170"
                                    class="img-fluid rounded-4 fit">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <h3 class="card-title mb-4 judul" style="font-size: 20px; font-weight: 700">Lagu Populer
                        {{ $billboard->artis->user->name }}</h3>
                    <div class="card scroll scrollbar-down thin">
                        <div class="card-body">
                            <div class="row" style="margin-top: -20px">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @foreach ($songs as $item)
                                            @if ($item->is_approved)
                                                <div class="preview-item">
                                                    <div class="preview-thumbnail">
                                                        <img src="{{ asset('storage/' . $item->image) }}" width="10%">
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <a href="" class="flex-grow text-decoration-none link">
                                                            <h6 class="preview-subject">{{ $item->judul }}</h6>
                                                            <p class="text-muted mb-0">{{ $item->artist->user->name }}</p>
                                                        </a>
                                                    </div>
                                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                        <div class="text-group">
                                                            <i id="like{{ $item->id }}"
                                                                data-id="{{ $item->id }}"
                                                                onclick="toggleLike(this, {{ $item->id }})"
                                                                class="shared-icon-like {{ $item->isLiked ? 'fas' : 'far' }} fa-heart pr-2"></i>
                                                            <p style="pointer-events: none;">{{ $item->waktu }}</p>
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
    <script>
        function togglePlayPause() {
            const playIcon = document.getElementById('playIcon');

            if (isPlaying) {
                // Jika sedang diputar, ganti menjadi pause
                playIcon.classList.remove('fa-pause');
                playIcon.classList.add('fa-play');
            } else {
                // Jika sedang tidak diputar, ganti menjadi play
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-pause');
            }

            // Ubah status pemutaran
            isPlaying = !isPlaying;

            // Panggil fungsi justplay() jika diperlukan
            justplay();
        }
    </script>
    {{-- <link rel="stylesheet" href="/user/assets/css/billboard.css">
    @include('partials.tambahkeplaylist')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card thin rounded-4" style="border: 1px solid #EAEAEA;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <div class="preview-list">
                                        <div class="d-flex flex-column gap-3" style="color: #6C6C6C;">
                                            <span class="fw-bold fs-4">{{ $billboard->artis->user->name }}</span>
                                            <span class="fs-5">{{ $billboard->deskripsi }}.</span>
                                            <div class="d-flex gap-4 align-content-center">
                                                <span>
                                                    <button
                                                        style="background-color: #957DAD; border: 1px solid #957dad; padding: 4px 25px;"
                                                        class="rounded-3">
                                                        <span class="text-white">
                                                            Mainkan
                                                        </span>
                                                    </button>
                                                    <a href="#lagu-diputar" class="flex-grow text-decoration-none link"
                                                        onclick="putar({{ 'id' }})">
                                                        <span
                                                            style="display: inline-block; width: 35px; height: 35px;left:90px; background-color: white; border-radius: 50%; text-align: center;position: absolute;top:27%;">
                                                            <button onclick="togglePlayPause()" id="play"
                                                                style="border: none; background: none;margin-top: -11px;margin-left: -13%">
                                                                <i id="playIcon" class="fas fa-play"
                                                                    style="line-height: 55px;"></i>
                                                            </button>
                                                        </span>
                                                    </a>
                                                    <script>
                                                        var isPlaying = false; // Default status pemutaran lagu
                                                    </script>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex text-right justify-content-center">
                                    <img src="{{ asset('storage/' . $billboard->image_artis) }}" alt=""
                                        class="d-block" style="width: 250px; height: 350px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="cards d-flex justify-content-center z-3 gap-4"
                        style="margin-top: -150px; margin-left: 12px;">
                        @foreach ($albums as $item)
                            <a href="{{ route('albumBillboard.artisVerified', $item->code) }}">
                                <img src="{{ asset('storage/' . $item->image) }}" width="170"
                                    class="img-fluid rounded-4 fit">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <h3 class="card-title mb-4 judul" style="font-size: 20px; font-weight: 700">Lagu Populer
                        {{ $billboard->artis->user->name }}</h3>
                    <div class="card scroll scrollbar-down thin">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @foreach ($songs as $item)
                                            @if ($item->is_approved)
                                            <div class="preview-item">
                                                <div class="preview-thumbnail">
                                                    <img src="{{ asset('storage/' . $item->image) }}" width="10%">
                                                </div>
                                                <div class="preview-item-content d-sm-flex flex-grow">
                                                    <a href="#lagu-diputar"
                                                        class="flex-grow text-decoration-none link"
                                                        onclick="putar({{ $item->id }})">
                                                        <h6 class="preview-subject" style="color: #4e4e4e;">
                                                            {{ $item->judul }}</h6>
                                                        <p class="text-muted mb-0" style="font-weight: 400">
                                                            {{ $item->artist->user->name }}</p>
                                                    </a>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <div class="text-group align-items-center">
                                                        <i id="like{{ $item->id }}"
                                                            data-id="{{ $item->id }}"
                                                            onclick="toggleLike(this, {{ $item->id }})"
                                                            class="shared-icon-like {{ $item->isLiked ? 'fas' : 'far' }} fa-heart pr-2"></i>
                                                        <p style="pointer-events: none;">{{ $item->waktu }}</p>
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
    <script>
        function togglePlayPause() {
            const playIcon = document.getElementById('playIcon');

            if (isPlaying) {
                // Jika sedang diputar, ganti menjadi pause
                playIcon.classList.remove('fa-pause');
                playIcon.classList.add('fa-play');
            } else {
                // Jika sedang tidak diputar, ganti menjadi play
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-pause');
            }

            // Ubah status pemutaran
            isPlaying = !isPlaying;

            // Panggil fungsi justplay() jika diperlukan
            justplay();
        }
    </script> --}}
@endsection
