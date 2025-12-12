<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alizo - Connect With Professional Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #2d3748;
            overflow-x: hidden;
            background: #f7fafc;
            line-height: 1.6;
        }
        
        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.2rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
        }
        
        .nav-menu {
            display: flex;
            gap: 3rem;
            align-items: center;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #444;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-menu a:hover {
            color: #667eea;
        }
        
        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s;
        }
        
        .nav-menu a:hover::after {
            width: 100%;
        }
        
        .btn-nav {
            padding: 0.75rem 1.8rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
        }
        
        /* Hero Section */
        .hero {
            padding: 140px 3rem 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }
        
        .hero-container {
            max-width: 1300px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }
        
        .hero-content h1 {
            font-size: 4.5rem;
            font-weight: 900;
            color: white;
            line-height: 1.15;
            margin-bottom: 1.8rem;
            letter-spacing: -2px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-content p {
            font-size: 1.35rem;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.7;
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            padding: 1.1rem 3rem;
            background: white;
            color: #667eea;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            background: #f7fafc;
        }
        
        .btn-secondary {
            padding: 1.1rem 3rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
        }
        
        .hero-stats {
            margin-top: 5rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        .stat-item h3 {
            font-size: 2.5rem;
            color: white;
            font-weight: 800;
            margin-bottom: 0.3rem;
        }
        
        .stat-item p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            margin: 0;
        }
        
        /* Services Section */
        .services {
            padding: 100px 3rem;
            background: #f8f9fa;
        }
        
        .services-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-label {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }
        
        .service-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            transition: all 0.3s;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        
        .service-card:hover::before {
            transform: scaleX(1);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }
        
        .service-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }
        
        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }
        
        .service-card p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        
        .service-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .service-link:hover {
            gap: 1rem;
        }
        
        /* Brands Section */
        .brands {
            padding: 60px 3rem;
            background: white;
            border-top: 1px solid #e2e8f0;
        }
        
        .brands-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .brands-container p {
            color: #718096;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 2rem;
        }
        
        .brands-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 3rem;
            align-items: center;
        }
        
        .brand-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #cbd5e0;
            transition: color 0.3s;
        }
        
        .brand-logo:hover {
            color: #667eea;
        }
        
        /* CTA Section */
        .cta {
            padding: 100px 3rem;
            background: white;
        }
        
        .cta-container {
            max-width: 1000px;
            margin: 0 auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5rem;
            border-radius: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .cta-container::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        }
        
        .cta-container h2 {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .cta-container p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
        }
        
        /* Footer */
        .footer {
            background: #1a1a1a;
            padding: 80px 3rem 40px;
            color: white;
        }
        
        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }
        
        .footer-brand h3 {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }
        
        .footer-brand p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        
        .footer-section h4 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .footer-section a {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            margin-bottom: 0.8rem;
            transition: all 0.3s;
        }
        
        .footer-section a:hover {
            color: #667eea;
            padding-left: 5px;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .brands-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .footer-container {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
            .nav-container {
                padding: 1rem 1.5rem;
            }
            
            .nav-menu {
                gap: 1rem;
                font-size: 0.9rem;
            }
            
            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .brands-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Alizo</div>
            <div class="nav-menu">
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="#services">Services</a>
                <a href="{{ url('/api/documentation') }}">API</a>
                <a href="#" class="btn-nav">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">🚀 Trusted by 10,000+ Users</div>
                <h1>Your Gateway to Professional Services</h1>
                <p>Connect with verified experts, book instantly, and experience seamless service management. Everything you need, all in one place.</p>
                <div class="hero-buttons">
                    <a href="#services" class="btn-primary">
                        Get Started
                        <span>→</span>
                    </a>
                    <a href="{{ url('/about') }}" class="btn-secondary">Learn More</a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <h3>10K+</h3>
                    <p>Active Users</p>
                </div>
                <div class="stat-item">
                    <h3>2K+</h3>
                    <p>Professionals</p>
                </div>
                <div class="stat-item">
                    <h3>50K+</h3>
                    <p>Bookings</p>
                </div>
                <div class="stat-item">
                    <h3>4.9⭐</h3>
                    <p>Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="services-container">
            <div class="section-header">
                <span class="section-label">Our Services</span>
                <h2 class="section-title">Everything You Need</h2>
                <p class="section-subtitle">From booking to payment, we've got you covered with powerful features designed for modern service management.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🔍</div>
                    <h3>Smart Search</h3>
                    <p>Advanced filters and intelligent recommendations help you find exactly what you're looking for.</p>
                    <a href="#" class="service-link">Learn more →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">⚡</div>
                    <h3>Instant Booking</h3>
                    <p>Book appointments in real-time with automatic confirmation and calendar integration.</p>
                    <a href="#" class="service-link">Learn more →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">💳</div>
                    <h3>Secure Payments</h3>
                    <p>Multiple payment options with bank-level security and instant transaction confirmation.</p>
                    <a href="#" class="service-link">Learn more →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">⭐</div>
                    <h3>Reviews & Ratings</h3>
                    <p>Make informed decisions with verified reviews from real customers.</p>
                    <a href="#" class="service-link">Learn more →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">💝</div>
                    <h3>Personal Wishlist</h3>
                    <p>Save your favorite services and providers for quick access anytime.</p>
                    <a href="#" class="service-link">Learn more →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">📱</div>
                    <h3>Mobile First</h3>
                    <p>Fully responsive design works seamlessly on all your devices.</p>
                    <a href="#" class="service-link">Learn more →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands">
        <div class="brands-container">
            <p>Trusted by Leading Companies</p>
            <div class="brands-grid">
                <div class="brand-logo">TechCorp</div>
                <div class="brand-logo">StartHub</div>
                <div class="brand-logo">CloudNine</div>
                <div class="brand-logo">Innovate</div>
                <div class="brand-logo">NextGen</div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of satisfied customers experiencing hassle-free professional services.</p>
            <div class="hero-buttons">
                <a href="#" class="btn-primary">Start Now</a>
                <a href="{{ url('/about') }}" class="btn-secondary">About Us</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <h3>Alizo</h3>
                <p>Your trusted platform for professional services. Connecting people with quality service providers since 2025.</p>
            </div>
            <div class="footer-section">
                <h4>Platform</h4>
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ url('/about') }}">About Us</a>
                <a href="#services">Services</a>
                <a href="#">Pricing</a>
            </div>
            <div class="footer-section">
                <h4>Developers</h4>
                <a href="{{ url('/api/documentation') }}">API Docs</a>
                <a href="#">GitHub</a>
                <a href="#">Support</a>
                <a href="#">Status</a>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <a href="mailto:{{ config('mail.from.address') }}">Email Us</a>
                <a href="#">Twitter</a>
                <a href="#">LinkedIn</a>
                <a href="#">Facebook</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Alizo. All rights reserved. Built with ❤️</p>
        </div>
    </footer>
</body>
</html>
