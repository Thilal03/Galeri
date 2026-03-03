<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $galeri->judul }} - Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .gallery-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 40px;
        }
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .photo-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background: white;
        }
        .photo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.2);
        }
        .photo-item img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block;
        }
        .photo-caption {
            padding: 15px;
            background: white;
        }
        .photo-caption p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .photo-item:hover .photo-overlay {
            opacity: 1;
        }
        .photo-overlay i {
            color: white;
            font-size: 40px;
        }
        .back-btn {
            background: white;
            color: #667eea;
            border: 2px solid white;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s;
        }
        .back-btn:hover {
            background: transparent;
            color: white;
            border-color: white;
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

    <div class="gallery-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">{{ $galeri->judul }}</h1>
                    @if($galeri->deskripsi)
                        <p class="lead mb-3">{{ $galeri->deskripsi }}</p>
                    @endif
                    <p class="mb-0">
                        <i class="fas fa-images"></i> {{ $galeri->detailGaleri->count() }} Foto
                        <span class="mx-2">|</span>
                        <i class="fas fa-calendar"></i> {{ $galeri->created_at->format('d M Y') }}
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('galeri.index') }}" class="back-btn btn">
                        <i class="fas fa-arrow-left"></i> Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        @if($galeri->detailGaleri->count() > 0)
            <div class="photo-grid">
                @foreach($galeri->detailGaleri as $detail)
                    <div class="photo-item">
                        <a href="{{ asset('storage/' . $detail->foto) }}" 
                           data-lightbox="gallery-{{ $galeri->slug }}" 
                           data-title="{{ $detail->caption ?? $galeri->judul }}">
                            <img src="{{ asset('storage/' . $detail->foto) }}" 
                                 alt="{{ $detail->caption ?? $galeri->judul }}">
                            <div class="photo-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </a>
                        @if($detail->caption)
                            <div class="photo-caption">
                                <p><i class="fas fa-comment"></i> {{ $detail->caption }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-images fa-5x text-muted mb-3"></i>
                <h3>Belum Ada Foto</h3>
                <p class="text-muted">Galeri ini belum memiliki foto</p>
            </div>
        @endif
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2024 MyGallery. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Foto %1 dari %2'
        });
    </script>
</body>
</html>
