<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JasaCuci - Layanan Cuci Mobil & Motor Premium</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ============================================
           CSS VARIABLES - Design Tokens
           ============================================ */
        :root {
            /* Colors */
            --color-primary: #0066FF;
            --color-primary-dark: #0052CC;
            --color-primary-light: #E6F0FF;

            --color-secondary: #00C781;
            --color-accent: #FF6B35;

            --color-gray-50: #F8FAFC;
            --color-gray-100: #F1F5F9;
            --color-gray-200: #E2E8F0;
            --color-gray-300: #CBD5E1;
            --color-gray-400: #94A3B8;
            --color-gray-500: #64748B;
            --color-gray-600: #475569;
            --color-gray-700: #334155;
            --color-gray-800: #1E293B;
            --color-gray-900: #0F172A;

            --color-white: #FFFFFF;
            --color-black: #000000;

            /* Typography */
            --font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;

            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 2rem;
            --font-size-4xl: 2.5rem;
            --font-size-5xl: 3.5rem;

            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;

            /* Border Radius */
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;

            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 32px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 24px 48px rgba(0, 0, 0, 0.16);

            /* Transitions */
            --transition-fast: 150ms ease;
            --transition-base: 250ms ease;
            --transition-slow: 400ms ease;
        }

        /* ============================================
           RESET & BASE
           ============================================ */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: var(--font-family);
            font-size: var(--font-size-base);
            line-height: 1.6;
            color: var(--color-gray-800);
            background-color: var(--color-white);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        button {
            font-family: inherit;
            cursor: pointer;
            border: none;
            background: none;
        }

        /* ============================================
           LAYOUT UTILITIES
           ============================================ */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }

        /* ============================================
           HEADER / NAVIGATION
           ============================================ */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--color-gray-100);
            transition: var(--transition-base);
        }

        .header.scrolled {
            box-shadow: var(--shadow-sm);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--font-size-xl);
            font-weight: 800;
            color: var(--color-primary);
            letter-spacing: -0.02em;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-white);
            font-size: var(--font-size-lg);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        /* ============================================
           BUTTONS
           ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-5);
            font-size: var(--font-size-sm);
            font-weight: 600;
            border-radius: var(--radius-md);
            transition: var(--transition-fast);
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--color-primary);
            color: var(--color-white);
            box-shadow: 0 2px 8px rgba(0, 102, 255, 0.3);
        }

        .btn-primary:hover {
            background: var(--color-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.4);
        }

        .btn-ghost {
            color: var(--color-gray-700);
            background: transparent;
        }

        .btn-ghost:hover {
            background: var(--color-gray-100);
            color: var(--color-gray-900);
        }

        .btn-outline {
            background: transparent;
            color: var(--color-primary);
            border: 1.5px solid var(--color-primary);
        }

        .btn-outline:hover {
            background: var(--color-primary);
            color: var(--color-white);
        }

        .btn-danger {
            background: #FEE2E2;
            color: #DC2626;
        }

        .btn-danger:hover {
            background: #DC2626;
            color: var(--color-white);
        }

        .btn-lg {
            padding: var(--space-4) var(--space-8);
            font-size: var(--font-size-base);
            border-radius: var(--radius-lg);
        }

        /* ============================================
           HERO SECTION
           ============================================ */
        .hero {
            position: relative;
            padding: calc(72px + var(--space-20)) 0 var(--space-20);
            background: linear-gradient(180deg, var(--color-primary-light) 0%, var(--color-white) 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(0, 102, 255, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 199, 129, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-4);
            background: var(--color-white);
            border: 1px solid var(--color-gray-200);
            border-radius: var(--radius-full);
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--color-gray-600);
            margin-bottom: var(--space-6);
            box-shadow: var(--shadow-sm);
        }

        .hero-badge-dot {
            width: 8px;
            height: 8px;
            background: var(--color-secondary);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }

        .hero-title {
            font-size: var(--font-size-5xl);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.03em;
            color: var(--color-gray-900);
            margin-bottom: var(--space-6);
        }

        .hero-title-highlight {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: var(--font-size-lg);
            color: var(--color-gray-600);
            line-height: 1.7;
            margin-bottom: var(--space-10);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-4);
            flex-wrap: wrap;
        }

        /* ============================================
           STATS SECTION
           ============================================ */
        .stats {
            padding: var(--space-16) 0;
            background: var(--color-white);
            border-bottom: 1px solid var(--color-gray-100);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--space-8);
        }

        .stat-card {
            text-align: center;
            padding: var(--space-6);
        }

        .stat-value {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            color: var(--color-primary);
            letter-spacing: -0.02em;
            line-height: 1;
            margin-bottom: var(--space-2);
        }

        .stat-label {
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--color-gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ============================================
           SERVICES SECTION
           ============================================ */
        .services {
            padding: var(--space-24) 0;
            background: var(--color-gray-50);
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--space-16);
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-4);
            background: var(--color-primary-light);
            color: var(--color-primary);
            font-size: var(--font-size-xs);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-radius: var(--radius-full);
            margin-bottom: var(--space-4);
        }

        .section-title {
            font-size: var(--font-size-3xl);
            font-weight: 800;
            color: var(--color-gray-900);
            letter-spacing: -0.02em;
            margin-bottom: var(--space-3);
        }

        .section-subtitle {
            font-size: var(--font-size-lg);
            color: var(--color-gray-500);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Service Cards Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: var(--space-6);
        }

        /* Service Card */
        .service-card {
            background: var(--color-white);
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid var(--color-gray-100);
            transition: var(--transition-base);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .service-image {
            position: relative;
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-slow);
        }

        .service-card:hover .service-image img {
            transform: scale(1.05);
        }

        .service-image-placeholder {
            font-size: 4rem;
            opacity: 0.9;
        }

        .service-body {
            padding: var(--space-6);
        }

        .service-category {
            display: inline-block;
            padding: var(--space-1) var(--space-3);
            background: var(--color-primary-light);
            color: var(--color-primary);
            font-size: var(--font-size-xs);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: var(--radius-full);
            margin-bottom: var(--space-3);
        }

        .service-name {
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--color-gray-900);
            margin-bottom: var(--space-2);
            letter-spacing: -0.01em;
        }

        .service-description {
            font-size: var(--font-size-sm);
            color: var(--color-gray-500);
            line-height: 1.7;
            margin-bottom: var(--space-4);
        }

        .service-phone {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-3);
            background: var(--color-gray-50);
            border-radius: var(--radius-md);
            font-size: var(--font-size-sm);
            font-weight: 600;
            color: var(--color-secondary);
        }

        .service-phone-icon {
            width: 16px;
            height: 16px;
        }

        /* ============================================
           EMPTY STATE
           ============================================ */
        .empty-state {
            text-align: center;
            padding: var(--space-16) var(--space-6);
            background: var(--color-white);
            border-radius: var(--radius-xl);
            border: 2px dashed var(--color-gray-200);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: var(--color-gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto var(--space-6);
        }

        .empty-title {
            font-size: var(--font-size-lg);
            font-weight: 600;
            color: var(--color-gray-700);
            margin-bottom: var(--space-2);
        }

        .empty-description {
            font-size: var(--font-size-sm);
            color: var(--color-gray-500);
        }

        /* ============================================
           FOOTER
           ============================================ */
        .footer {
            background: var(--color-gray-900);
            color: var(--color-white);
            padding: var(--space-12) 0;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: var(--space-6);
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--font-size-lg);
            font-weight: 700;
        }

        .footer-logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-sm);
        }

        .footer-divider {
            width: 100%;
            height: 1px;
            background: var(--color-gray-700);
        }

        .footer-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-2);
        }

        .footer-copyright {
            font-size: var(--font-size-sm);
            color: var(--color-gray-400);
        }

        .footer-tagline {
            font-size: var(--font-size-sm);
            color: var(--color-gray-500);
        }

        /* ============================================
           RESPONSIVE DESIGN
           ============================================ */
        @media (max-width: 768px) {
            .hero-title {
                font-size: var(--font-size-3xl);
            }

            .hero-description {
                font-size: var(--font-size-base);
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: var(--space-4);
            }

            .stat-card {
                padding: var(--space-4);
            }

            .stat-value {
                font-size: var(--font-size-3xl);
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: var(--font-size-2xl);
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .hero-buttons .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 var(--space-4);
            }

            .nav {
                height: 64px;
            }

            .logo {
                font-size: var(--font-size-base);
            }

            .logo-icon {
                width: 32px;
                height: 32px;
            }
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <!-- ========================================
         HEADER / NAVIGATION
         ======================================== -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <!-- Logo -->
                <a href="/" class="logo">
                    <span class="logo-icon">🚗</span>
                    <span>JasaCuci</span>
                </a>

                <!-- Navigation Actions -->
                <?php if(auth()->check()): ?>
                    <div class="nav-actions">
                        <a href="<?= url('/dashboard') ?>" class="btn btn-ghost">Dashboard</a>
                        <form action="<?= route('logout') ?>" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="nav-actions">
                        <a href="<?= route('login') ?>" class="btn btn-ghost">Masuk</a>
                        <a href="<?= route('register') ?>" class="btn btn-primary">Daftar Sekarang</a>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- ========================================
         HERO SECTION
         ======================================== -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <!-- Badge -->
                <div class="hero-badge animate-fade-in-up">
                    <span class="hero-badge-dot"></span>
                    <span>Platform Terpercaya Sejak 1945</span>
                </div>

                <!-- Title -->
                <h1 class="hero-title animate-fade-in-up delay-1">
                    Layanan Cuci <span class="hero-title-highlight">Mobil & Motor</span> Terbaik di Indonesia
                </h1>

                <!-- Description -->
                <p class="hero-description animate-fade-in-up delay-2">
                    Temukan penyedia jasa cuci kendaraan profesional dengan kualitas terjamin dan harga transparan di sekitar Anda
                </p>

                <!-- CTA Buttons -->
                <?php if(auth()->check()): ?>
                    <div class="hero-buttons animate-fade-in-up delay-3">
                        <a href="<?= url('/dashboard') ?>" class="btn btn-primary btn-lg">
                            🚀 Masuk Dashboard
                        </a>
                    </div>
                <?php else: ?>
                    <div class="hero-buttons animate-fade-in-up delay-3">
                        <a href="<?= route('register') ?>" class="btn btn-primary btn-lg">
                            Mulai Sekarang
                        </a>
                        <a href="<?= route('login') ?>" class="btn btn-outline btn-lg">
                            Sudah Punya Akun?
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ========================================
         STATS SECTION
         ======================================== -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value"><?= number_format($serviceProviders->count()) ?>+</div>
                    <div class="stat-label">Service Provider</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= number_format($categories->count()) ?>+</div>
                    <div class="stat-label">Kategori Layanan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">24/7</div>
                    <div class="stat-label">Dukungan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         SERVICES SECTION
         ======================================== -->
    <section class="services">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <span class="section-tag">✨ Layanan Kami</span>
                <h2 class="section-title">Service Provider Profesional</h2>
                <p class="section-subtitle">
                    Pilih penyedia jasa cuci kendaraan terbaik dengan kualitas layanan premium
                </p>
            </div>

            <!-- Services Grid -->
            <?php if($serviceProviders->count() > 0): ?>
                <div class="services-grid">
                    <?php foreach($serviceProviders as $provider): ?>
                        <article class="service-card">
                            <!-- Image -->
                            <div class="service-image">
                                <?php if($provider->photo): ?>
                                    <img src="<?= asset('storage/' . $provider->photo) ?>" alt="<?= $provider->name ?>" loading="lazy">
                                <?php else: ?>
                                    <span class="service-image-placeholder">🚗</span>
                                <?php endif; ?>
                            </div>

                            <!-- Content -->
                            <div class="service-body">
                                <span class="service-category"><?= $provider->category->name ?></span>
                                <h3 class="service-name"><?= $provider->name ?></h3>
                                <p class="service-description">
                                    <?= \Illuminate\Support\Str::limit($provider->description, 100) ?>
                                </p>
                                <?php if($provider->phone): ?>
                                    <div class="service-phone">
                                        <svg class="service-phone-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span><?= $provider->phone ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3 class="empty-title">Belum Ada Service Provider</h3>
                    <p class="empty-description">
                        Service provider akan segera tersedia. Silakan cek kembali nanti.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ========================================
         FOOTER
         ======================================== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- Logo -->
                <div class="footer-logo">
                    <span class="footer-logo-icon">🚗</span>
                    <span>JasaCuci</span>
                </div>

                <!-- Divider -->
                <div class="footer-divider"></div>

                <!-- Bottom -->
                <div class="footer-bottom">
                    <p class="footer-copyright">
                        &copy; 2025 JasaCuci. All rights reserved.
                    </p>
                    <p class="footer-tagline">
                        Made with ❤️ in Indonesia
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========================================
         SCRIPTS
         ======================================== -->
    <script>
        // Header scroll effect
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
