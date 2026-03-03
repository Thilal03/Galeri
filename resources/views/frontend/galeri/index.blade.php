<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }
        .gallery-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.2);
        }
        .gallery-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .gallery-card .card-body {
            padding: 20px;
        }
        .gallery-card .card-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .gallery-card .card-text {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .photo-count {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .btn-view {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s;
        }
        .btn-view:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-camera"></i> MyGallery
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('galeri.index') }}">Galeri</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-images"></i> Galeri Foto
            </h1>
            <p class="lead">Jelajahi koleksi foto-foto menarik kami</p>
        </div>
    </div>

    <div class="container mb-5">
        @if($galeri->count() > 0)
            <div class="row">
                @foreach($galeri as $item)
                    <div class="col-md-4">
                        <div class="gallery-card card">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->judul }}"
                                     class="card-img-top">
                            @else
                                <div style="width: 100%; height: 250px; background: #ddd; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <span class="photo-count">
                                    <i class="fas fa-images"></i> {{ $item->detailGaleri->count() }} Foto
                                </span>
                                <h5 class="card-title">{{ $item->judul }}</h5>
                                @if($item->deskripsi)
                                    <p class="card-text">
                                        {{ Str::limit($item->deskripsi, 100) }}
                                    </p>
                                @endif
                                <a href="{{ route('galeri.show', $item->slug) }}" class="btn btn-view w-100">
                                    <i class="fas fa-eye"></i> Lihat Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $galeri->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>Belum Ada Galeri</h3>
                <p class="text-muted">Galeri foto akan ditampilkan di sini</p>
            </div>
        @endif
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2024 MyGallery. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
