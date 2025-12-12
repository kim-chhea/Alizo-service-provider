<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Alizo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            overflow-x: hidden;
            background: #ffffff;
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
            transition: color 0.3s;
        }
        
        .nav-menu a:hover {
            color: #667eea;
        }
        
        .btn-nav {
            padding: 0.75rem 1.8rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }
        
        /* Page Header */
        .page-header {
            padding: 160px 3rem 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            text-align: center;
            color: white;
        }
        
        .page-header h1 {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
        }
        
        .page-header p {
            font-size: 1.3rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        /* Story Section */
        .story {
            padding: 100px 3rem;
            background: white;
        }
        
        .story-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }
        
        .story-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #1a1a1a;
        }
        
        .story-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 1.5rem;
        }
        
        .story-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
        }
        
        .story-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
        
        .stat-box {
            background: rgba(255, 255, 255, 0.15);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        
        .stat-box h3 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 0.5rem;
        }
        
        .stat-box p {
            color: rgba(255, 255, 255, 0.9);
        }
        
        /* Mission Section */
        .mission {
            padding: 100px 3rem;
            background: #f8f9fa;
        }
        
        .mission-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .mission h2 {
            font-size: 3rem;
            margin-bottom: 2rem;
            color: #1a1a1a;
        }
        
        .mission-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
            margin-top: 4rem;
        }
        
        .mission-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .mission-card:hover {
            transform: translateY(-10px);
        }
        
        .mission-card .icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .mission-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #667eea;
        }
        
        .mission-card p {
            color: #666;
            line-height: 1.8;
        }
        
        /* Team Section */
        .team {
            padding: 100px 3rem;
            background: white;
        }
        
        .team-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .team h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }
        
        .team p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 4rem;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2.5rem;
        }
        
        .team-member {
            text-align: center;
        }
        
        .team-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            font-weight: bold;
        }
        
        .team-member h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }
        
        .team-member p {
            color: #667eea;
            font-weight: 600;
            margin: 0;
        }
        
        /* CTA Section */
        .cta {
            padding: 100px 3rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            text-align: center;
            color: white;
        }
        
        .cta h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .cta p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }
        
        .btn-white {
            padding: 1rem 2.5rem;
            background: white;
            color: #667eea;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        /* Footer */
        .footer {
            background: #1a1a1a;
            padding: 40px 3rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }
        
        @media (max-width: 1024px) {
            .story-container, .mission-grid, .team-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
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
                <a href="{{ url('/home#services') }}">Services</a>
                <a href="{{ url('/api/documentation') }}">API</a>
                <a href="#" class="btn-nav">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <h1>About Alizo</h1>
        <p>Building the future of professional services, one connection at a time</p>
    </section>

    <!-- Story Section -->
    <section class="story">
        <div class="story-container">
            <div class="story-content">
                <h2>Our Story</h2>
                <p>Founded in 2025, Alizo was born from a simple idea: connecting people with quality professional services shouldn't be complicated.</p>
                <p>We noticed that finding reliable service providers was often frustrating, time-consuming, and uncertain. So we built a platform that makes it simple, transparent, and trustworthy.</p>
                <p>Today, we're proud to serve thousands of users and connect them with verified professionals across multiple service categories.</p>
            </div>
            <div class="story-image">
                <div class="story-stats">
                    <div class="stat-box">
                        <h3>2025</h3>
                        <p>Founded</p>
                    </div>
                    <div class="stat-box">
                        <h3>10K+</h3>
                        <p>Users</p>
                    </div>
                    <div class="stat-box">
                        <h3>2K+</h3>
                        <p>Providers</p>
                    </div>
                    <div class="stat-box">
                        <h3>50K+</h3>
                        <p>Bookings</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission">
        <div class="mission-container">
            <h2>Our Mission & Values</h2>
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="icon">🎯</div>
                    <h3>Quality First</h3>
                    <p>We verify every service provider to ensure you always get professional, reliable service.</p>
                </div>
                <div class="mission-card">
                    <div class="icon">🤝</div>
                    <h3>Trust & Transparency</h3>
                    <p>Real reviews, honest pricing, and clear communication build lasting trust.</p>
                </div>
                <div class="mission-card">
                    <div class="icon">⚡</div>
                    <h3>Innovation</h3>
                    <p>We continuously improve our platform with cutting-edge technology and user feedback.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
        <div class="team-container">
            <h2>Meet Our Team</h2>
            <p>The passionate people behind Alizo</p>
            <div class="team-grid">
                <div class="team-member">
                    <div class="team-avatar">A</div>
                    <h4>Alex Johnson</h4>
                    <p>CEO & Founder</p>
                </div>
                <div class="team-member">
                    <div class="team-avatar">S</div>
                    <h4>Sarah Chen</h4>
                    <p>CTO</p>
                </div>
                <div class="team-member">
                    <div class="team-avatar">M</div>
                    <h4>Michael Brown</h4>
                    <p>Head of Product</p>
                </div>
                <div class="team-member">
                    <div class="team-avatar">E</div>
                    <h4>Emily Davis</h4>
                    <p>Head of Operations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Join Our Growing Community</h2>
        <p>Be part of the revolution in professional services</p>
        <a href="{{ url('/home') }}" class="btn-white">Get Started Today</a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Alizo. All rights reserved.</p>
    </footer>
</body>
</html>
