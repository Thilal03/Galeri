<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            color: #fff;
            overflow: hidden;
            position: relative;
        }

        /* Animated background */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 80%, rgba(236, 72, 153, 0.08) 0%, transparent 50%);
            animation: bgShift 15s ease-in-out infinite alternate;
            z-index: 0;
        }

        @keyframes bgShift {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-5%, 3%) rotate(3deg); }
        }

        /* Floating particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(99, 102, 241, 0.3);
            border-radius: 50%;
            animation: float linear infinite;
        }

        .particle:nth-child(1) { left: 10%; width: 6px; height: 6px; animation-duration: 20s; animation-delay: 0s; }
        .particle:nth-child(2) { left: 25%; animation-duration: 25s; animation-delay: 2s; }
        .particle:nth-child(3) { left: 40%; width: 5px; height: 5px; animation-duration: 18s; animation-delay: 4s; }
        .particle:nth-child(4) { left: 55%; animation-duration: 22s; animation-delay: 1s; }
        .particle:nth-child(5) { left: 70%; width: 3px; height: 3px; animation-duration: 28s; animation-delay: 3s; }
        .particle:nth-child(6) { left: 85%; width: 7px; height: 7px; animation-duration: 16s; animation-delay: 5s; }
        .particle:nth-child(7) { left: 95%; animation-duration: 24s; animation-delay: 0.5s; }
        .particle:nth-child(8) { left: 5%; width: 5px; height: 5px; animation-duration: 19s; animation-delay: 6s; }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .error-container {
            text-align: center;
            z-index: 1;
            position: relative;
            max-width: 600px;
            padding: 40px 24px;
        }

        /* Glowing 404 icon */
        .error-icon {
            position: relative;
            margin-bottom: 32px;
            display: inline-block;
        }

        .error-icon .icon-bg {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
            animation: pulse 3s ease-in-out infinite;
        }

        .error-icon .icon-bg::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #ec4899);
            z-index: -1;
            opacity: 0.5;
            filter: blur(15px);
            animation: glowPulse 3s ease-in-out infinite;
        }

        .error-icon .icon-bg i {
            font-size: 56px;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes glowPulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        /* 404 number */
        .error-code {
            font-size: 96px;
            font-weight: 800;
            letter-spacing: -4px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 16px;
            animation: fadeInUp 0.6s ease-out;
        }

        .error-title {
            font-size: 24px;
            font-weight: 700;
            color: #e2e8f0;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .error-message {
            font-size: 16px;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 12px;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .error-detail {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 40px;
            padding: 16px 24px;
            background: rgba(99, 102, 241, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.15);
            border-radius: 12px;
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .error-detail i {
            color: #f59e0b;
            margin-right: 6px;
        }

        /* Buttons */
        .error-actions {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
            color: #fff;
        }

        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            transform: translateY(-2px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .error-code {
                font-size: 64px;
            }

            .error-title {
                font-size: 20px;
            }

            .error-message {
                font-size: 14px;
            }

            .error-icon .icon-bg {
                width: 110px;
                height: 110px;
            }

            .error-icon .icon-bg i {
                font-size: 42px;
            }

            .btn-back {
                padding: 12px 22px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
        <div class="particle">4</div>   <div class="particle">0</div>   <div class="particle">4</div>
    </div>

    <div class="error-container">
        <!-- Glowing Icon -->
        <div class="error-icon">
            <div class="icon-bg">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <!-- 404 Code -->
        <div class="error-code">404</div>

        <!-- Title -->
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>

        <!-- Message -->
        <p class="error-message">
            {{ $exception->getMessage() ?: 'Anda tidak dapat mengakses halaman ini.' }}
        </p>

        <!-- Detail Box -->
        <div class="error-detail">
            <i class="fas fa-exclamation-triangle"></i>
            Halaman ini hanya dapat diakses oleh <strong style="color: #818cf8;">Admin</strong> dan <strong style="color: #818cf8;">Guru</strong>.
            Silakan hubungi administrator jika Anda memerlukan akses.
        </div>

        <!-- Action Buttons -->
        <div class="error-actions">
            <a href="{{ url('/dashboard') }}" class="btn-back btn-primary-custom">
                <i class="fas fa-home"></i>
                Kembali ke Dashboard
            </a>
            <a href="{{ url()->previous() }}" class="btn-back btn-secondary-custom">
                <i class="fas fa-arrow-left"></i>
                Halaman Sebelumnya
            </a>
        </div>
    </div>
</body>
</html>
