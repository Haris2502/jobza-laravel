<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobza — Platform Karir & Freelance Terdepan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #0A0F1E;
            --navy-mid: #111827;
            --navy-light: #1B2438;
            --accent: #3B82F6;
            --accent-bright: #60A5FA;
            --accent-glow: rgba(59,130,246,0.35);
            --cyan: #06B6D4;
            --white: #F8FAFF;
            --gray: #94A3B8;
            --gray-light: #CBD5E1;
            --border: rgba(255,255,255,0.07);
            --glass: rgba(255,255,255,0.04);
            --radius: 16px;
            --radius-sm: 10px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            color: var(--white);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .brand {
            font-family: 'Syne', sans-serif;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.5;
        }

        /* ── NAVBAR ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 0 2rem;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(10,15,30,0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--cyan) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .nav-logo span {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--white);
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--gray);
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--white); }

        .nav-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-ghost {
            padding: 0.5rem 1.25rem;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--gray-light);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-ghost:hover { border-color: var(--accent); color: var(--white); }

        .btn-primary {
            padding: 0.5rem 1.4rem;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 0 20px rgba(59,130,246,0.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 24px rgba(59,130,246,0.45); }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 2rem 80px;
        }

        /* Animated gradient mesh background */
        .hero-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.25;
            animation: floatOrb 8s ease-in-out infinite;
        }
        .orb-1 { width: 600px; height: 600px; background: var(--accent); top: -100px; left: -100px; animation-delay: 0s; }
        .orb-2 { width: 500px; height: 500px; background: var(--cyan); bottom: -150px; right: -100px; animation-delay: -3s; }
        .orb-3 { width: 350px; height: 350px; background: #8B5CF6; top: 40%; left: 40%; animation-delay: -5s; }

        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.05); }
            66% { transform: translate(-20px, 20px) scale(0.97); }
        }

        /* Grid lines */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.25);
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.82rem;
            color: var(--accent-bright);
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.6s ease both;
        }

        .badge-dot {
            width: 6px; height: 6px;
            background: var(--accent-bright);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.4); }
        }

        .hero-title {
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.6s 0.1s ease both;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--accent-bright), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            color: var(--gray);
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 2.5rem;
            font-weight: 300;
            animation: fadeUp 0.6s 0.2s ease both;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
            animation: fadeUp 0.6s 0.3s ease both;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.875rem 2rem;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
            box-shadow: 0 4px 30px rgba(59,130,246,0.35);
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 40px rgba(59,130,246,0.5); }

        .btn-hero-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.875rem 2rem;
            background: var(--glass);
            color: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
            backdrop-filter: blur(10px);
        }
        .btn-hero-outline:hover { border-color: rgba(255,255,255,0.2); background: rgba(255,255,255,0.07); }

        .hero-stats {
            display: flex;
            gap: 2rem;
            animation: fadeUp 0.6s 0.4s ease both;
        }

        .stat-item { }
        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--white), var(--gray-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            font-size: 0.8rem;
            color: var(--gray);
            margin-top: 2px;
            font-weight: 400;
        }

        /* Hero right - dashboard mockup */
        .hero-mockup {
            animation: fadeUp 0.7s 0.2s ease both;
            position: relative;
        }

        .mockup-card {
            background: var(--navy-light);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
            position: relative;
            overflow: hidden;
        }

        .mockup-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59,130,246,0.5), transparent);
        }

        .mockup-topbar {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.25rem;
        }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-r { background: #FF5F57; }
        .dot-y { background: #FEBC2E; }
        .dot-g { background: #28C840; }

        .mockup-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray);
            margin-left: auto;
        }

        .job-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        .job-card:hover { background: rgba(59,130,246,0.08); border-color: rgba(59,130,246,0.2); }

        .job-logo {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .job-logo-1 { background: rgba(59,130,246,0.15); }
        .job-logo-2 { background: rgba(6,182,212,0.15); }
        .job-logo-3 { background: rgba(139,92,246,0.15); }

        .job-info { flex: 1; }
        .job-title { font-family: 'Syne', sans-serif; font-size: 0.88rem; font-weight: 600; margin-bottom: 2px; }
        .job-company { font-size: 0.78rem; color: var(--gray); }

        .job-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }
        .job-salary { font-size: 0.8rem; font-weight: 600; color: var(--accent-bright); }
        .job-tag {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 500;
        }
        .tag-green { background: rgba(16,185,129,0.15); color: #34D399; }
        .tag-blue { background: rgba(59,130,246,0.15); color: var(--accent-bright); }

        .mockup-search {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Floating badges on mockup */
        .float-badge {
            position: absolute;
            background: var(--navy-light);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-size: 0.78rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            white-space: nowrap;
        }
        .float-1 { top: -20px; right: -20px; animation: floatBadge 4s ease-in-out infinite; }
        .float-2 { bottom: 20px; left: -30px; animation: floatBadge 4s ease-in-out infinite reverse; animation-delay: -2s; }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── SECTION COMMON ── */
        section { padding: 6rem 2rem; }
        .section-inner { max-width: 1200px; margin: 0 auto; }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--accent-bright);
            margin-bottom: 1rem;
        }
        .eyebrow-line {
            width: 24px; height: 1px;
            background: var(--accent-bright);
        }

        .section-title {
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .section-sub {
            color: var(--gray);
            font-size: 1.05rem;
            max-width: 520px;
            line-height: 1.7;
            font-weight: 300;
        }

        /* ── LOGOS STRIP ── */
        .logos-section {
            padding: 3rem 2rem;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .logos-label {
            text-align: center;
            color: var(--gray);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 2rem;
        }

        .logos-track {
            display: flex;
            justify-content: center;
            gap: 3rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo-item {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: rgba(255,255,255,0.2);
            letter-spacing: -0.02em;
            transition: color 0.3s;
        }
        .logo-item:hover { color: rgba(255,255,255,0.5); }

        /* ── FEATURES ── */
        .features-section { background: var(--navy-mid); }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 3.5rem;
        }

        .feature-card {
            background: var(--navy-mid);
            padding: 2.5rem;
            transition: background 0.25s;
            cursor: default;
        }
        .feature-card:hover { background: var(--navy-light); }

        .feature-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .feature-icon::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 15px;
            border: 1px solid var(--border);
        }

        .fi-blue { background: rgba(59,130,246,0.12); }
        .fi-cyan { background: rgba(6,182,212,0.12); }
        .fi-purple { background: rgba(139,92,246,0.12); }
        .fi-green { background: rgba(16,185,129,0.12); }
        .fi-orange { background: rgba(249,115,22,0.12); }
        .fi-rose { background: rgba(244,63,94,0.12); }

        .feature-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            letter-spacing: -0.01em;
        }

        .feature-desc {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.65;
            font-weight: 300;
        }

        /* ── HOW IT WORKS ── */
        .steps-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 4rem;
            position: relative;
        }

        .steps-row::before {
            content: '';
            position: absolute;
            top: 28px;
            left: calc(12.5% + 28px);
            right: calc(12.5% + 28px);
            height: 1px;
            background: linear-gradient(90deg, var(--accent), var(--cyan), var(--accent));
            opacity: 0.3;
        }

        .step-card {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-num {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0 auto 1.5rem;
            box-shadow: 0 0 30px var(--accent-glow);
        }

        .step-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .step-desc {
            color: var(--gray);
            font-size: 0.85rem;
            line-height: 1.6;
            font-weight: 300;
        }

        /* ── PRICING ── */
        .pricing-section { background: var(--navy-mid); }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .pricing-card {
            background: var(--navy-light);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .pricing-card:hover { transform: translateY(-4px); box-shadow: 0 20px 60px rgba(0,0,0,0.4); }

        .pricing-card.featured {
            border-color: var(--accent);
            position: relative;
        }

        .pricing-card.featured::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            box-shadow: 0 0 60px rgba(59,130,246,0.15);
            pointer-events: none;
        }

        .pricing-header {
            padding: 2rem 2rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .pricing-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }

        .pricing-name {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
        }

        .pricing-price {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .price-num {
            font-family: 'Syne', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .price-period {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .badge-popular {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 3px 10px;
            border-radius: 100px;
            margin-left: 10px;
            vertical-align: middle;
        }

        .pricing-body { padding: 1.75rem 2rem 2rem; }

        .pricing-features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .pricing-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.55rem 0;
            font-size: 0.9rem;
            color: var(--gray-light);
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .pricing-features li:last-child { border-bottom: none; }

        .check { color: #34D399; font-size: 0.85rem; }
        .cross { color: rgba(255,255,255,0.15); font-size: 0.85rem; }
        .li-off { color: var(--gray); text-decoration: line-through; opacity: 0.4; }

        .btn-pricing {
            width: 100%;
            padding: 0.9rem;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .btn-pricing-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--white);
        }
        .btn-pricing-outline:hover { border-color: var(--accent); color: var(--accent-bright); }

        .btn-pricing-filled {
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            border: none;
            color: white;
            box-shadow: 0 4px 20px rgba(59,130,246,0.3);
        }
        .btn-pricing-filled:hover { transform: translateY(-1px); box-shadow: 0 8px 30px rgba(59,130,246,0.45); }

        /* Commission table */
        .commission-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .commission-card {
            background: var(--navy);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
        }

        .commission-title {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--gray-light);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .commission-list { list-style: none; }
        .commission-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            font-size: 0.88rem;
        }
        .commission-list li:last-child { border-bottom: none; }
        .commission-list .cl-label { color: var(--gray); }
        .commission-list .cl-val { font-weight: 600; color: var(--accent-bright); }

        /* ── ABOUT / TIMELINE ── */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-text .section-sub { max-width: 100%; margin-bottom: 2rem; }

        .about-numbers {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .about-num-card {
            background: var(--navy-light);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem;
        }

        .about-num {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-bright), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-num-label {
            font-size: 0.82rem;
            color: var(--gray);
            margin-top: 2px;
        }

        .timeline { list-style: none; position: relative; }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 8px;
            bottom: 8px;
            width: 1px;
            background: linear-gradient(to bottom, var(--accent), var(--cyan), transparent);
        }

        .tl-item {
            display: flex;
            gap: 1.5rem;
            padding-bottom: 1.75rem;
            position: relative;
        }

        .tl-dot {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 0.65rem;
            font-weight: 800;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
            box-shadow: 0 0 15px var(--accent-glow);
        }

        .tl-content { padding-top: 4px; }
        .tl-year { font-size: 0.75rem; color: var(--accent-bright); font-weight: 600; margin-bottom: 2px; }
        .tl-title { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
        .tl-desc { font-size: 0.85rem; color: var(--gray); line-height: 1.5; font-weight: 300; }

        /* ── TESTIMONIALS ── */
        .testi-section { background: var(--navy-mid); }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .testi-card {
            background: var(--navy-light);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
            transition: border-color 0.2s;
        }
        .testi-card:hover { border-color: rgba(59,130,246,0.3); }

        .testi-stars { color: #FBBF24; font-size: 0.9rem; margin-bottom: 1rem; }
        .testi-text { font-size: 0.9rem; color: var(--gray-light); line-height: 1.7; margin-bottom: 1.25rem; font-weight: 300; font-style: italic; }

        .testi-author { display: flex; align-items: center; gap: 10px; }
        .testi-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }
        .av-blue { background: rgba(59,130,246,0.2); color: var(--accent-bright); }
        .av-cyan { background: rgba(6,182,212,0.2); color: var(--cyan); }
        .av-purple { background: rgba(139,92,246,0.2); color: #A78BFA; }

        .testi-name { font-weight: 600; font-size: 0.88rem; }
        .testi-role { font-size: 0.78rem; color: var(--gray); }

        /* ── CTA ── */
        .cta-section {
            position: relative;
            overflow: hidden;
            text-align: center;
            padding: 8rem 2rem;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 60% at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 70%);
        }

        .cta-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }

        .cta-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.05;
            margin-bottom: 1.5rem;
        }

        .cta-desc {
            color: var(--gray);
            font-size: 1.05rem;
            line-height: 1.7;
            font-weight: 300;
            margin-bottom: 2.5rem;
        }

        .cta-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-note {
            margin-top: 1.25rem;
            font-size: 0.82rem;
            color: var(--gray);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--navy-mid);
            border-top: 1px solid var(--border);
            padding: 4rem 2rem 2rem;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand p {
            color: var(--gray);
            font-size: 0.88rem;
            line-height: 1.6;
            margin-top: 1rem;
            max-width: 260px;
            font-weight: 300;
        }

        .footer-social {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .social-btn {
            width: 34px; height: 34px;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--gray);
        }
        .social-btn:hover { border-color: var(--accent); color: var(--accent-bright); }

        .footer-col h4 {
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.6rem; }
        .footer-col ul li a {
            text-decoration: none;
            color: var(--gray);
            font-size: 0.88rem;
            transition: color 0.2s;
        }
        .footer-col ul li a:hover { color: var(--white); }

        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            font-size: 0.82rem;
            color: var(--gray);
        }

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .hero-inner { grid-template-columns: 1fr; }
            .hero-mockup { display: none; }
            .features-grid { grid-template-columns: 1fr 1fr; }
            .steps-row { grid-template-columns: 1fr 1fr; gap: 2rem; }
            .steps-row::before { display: none; }
            .pricing-grid { grid-template-columns: 1fr; max-width: 420px; margin-left: auto; margin-right: auto; }
            .about-grid { grid-template-columns: 1fr; gap: 3rem; }
            .testi-grid { grid-template-columns: 1fr; max-width: 480px; margin-left: auto; margin-right: auto; }
            .commission-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 600px) {
            .features-grid { grid-template-columns: 1fr; }
            .steps-row { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr; }
            .hero-stats { flex-wrap: wrap; gap: 1.25rem; }
        }
    </style>
</head>
<body>

<!-- ════ NAVBAR ════ -->
<nav>
    <a class="nav-logo" href="#">
        <div class="nav-logo-icon">J</div>
        <span>Jobza</span>
    </a>

    <ul class="nav-links">
        <li><a href="#features">Fitur</a></li>
        <li><a href="#how">Cara Kerja</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#pricing">Harga</a></li>
    </ul>

    <div class="nav-actions">
        <a href="{{ route('register') }}" class="btn-ghost" wire:navigate>Daftar</a>
        <a href="{{ route('login') }}" class="btn-primary" wire:navigate>Masuk →</a>
    </div>
</nav>


<!-- ════ HERO ════ -->
<section class="hero">
    <div class="hero-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="hero-grid"></div>
    </div>

    <div class="hero-inner">
        <!-- Left -->
        <div>
            <div class="hero-badge">
                <span class="badge-dot"></span>
                Platform #1 Karir & Freelance Indonesia
            </div>

            <h1 class="hero-title">
                Temukan<br>
                <span class="highlight">Pekerjaan</span><br>
                Impian Anda
            </h1>

            <p class="hero-desc">
                Jobza menghubungkan ribuan talent terbaik dengan peluang kerja dan proyek freelance pilihan — dengan teknologi AI yang cerdas dan sistem pembayaran yang aman.
            </p>

            <div class="hero-cta">
                <a href="#" class="btn-hero-primary">
                    Mulai Gratis
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#how" class="btn-hero-outline">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Lihat Demo
                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <p class="stat-num">50K+</p>
                    <p class="stat-label">Pengguna Aktif</p>
                </div>
                <div class="stat-item">
                    <p class="stat-num">10K+</p>
                    <p class="stat-label">Lowongan Tersedia</p>
                </div>
                <div class="stat-item">
                    <p class="stat-num">5K+</p>
                    <p class="stat-label">Proyek Sukses</p>
                </div>
            </div>
        </div>

        <!-- Right - Mockup -->
        <div class="hero-mockup">
            <div style="position:relative;">
                <div class="float-badge float-1">
                    <span style="color:#34D399;">●</span> 3 Interview Baru
                </div>
                <div class="float-badge float-2">
                    🎉 Tawaran Diterima!
                </div>

                <div class="mockup-card">
                    <div class="mockup-topbar">
                        <span class="dot dot-r"></span>
                        <span class="dot dot-y"></span>
                        <span class="dot dot-g"></span>
                        <span class="mockup-title">Jobza — Dashboard</span>
                    </div>

                    <div class="mockup-search">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#64748b" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                        Cari lowongan, freelance, atau talent...
                    </div>

                    <div class="job-card">
                        <div class="job-logo job-logo-1">💻</div>
                        <div class="job-info">
                            <p class="job-title">Frontend Developer</p>
                            <p class="job-company">PT Teknologi Nusantara</p>
                        </div>
                        <div class="job-meta">
                            <p class="job-salary">Rp 12–16 Jt</p>
                            <span class="job-tag tag-green">Full-time</span>
                        </div>
                    </div>

                    <div class="job-card">
                        <div class="job-logo job-logo-2">🎨</div>
                        <div class="job-info">
                            <p class="job-title">UI/UX Designer</p>
                            <p class="job-company">Freelance · Remote</p>
                        </div>
                        <div class="job-meta">
                            <p class="job-salary">Rp 7–10 Jt</p>
                            <span class="job-tag tag-blue">Proyek</span>
                        </div>
                    </div>

                    <div class="job-card">
                        <div class="job-logo job-logo-3">📊</div>
                        <div class="job-info">
                            <p class="job-title">Data Analyst</p>
                            <p class="job-company">Startup Fintech · Hybrid</p>
                        </div>
                        <div class="job-meta">
                            <p class="job-salary">Rp 10–14 Jt</p>
                            <span class="job-tag tag-green">Full-time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ════ LOGOS ════ -->
<div class="logos-section">
    <div style="max-width:1200px;margin:0 auto;">
        <p class="logos-label">Dipercaya oleh perusahaan terkemuka</p>
        <div class="logos-track">
            <span class="logo-item">Tokopedia</span>
            <span class="logo-item">Gojek</span>
            <span class="logo-item">Traveloka</span>
            <span class="logo-item">Bukalapak</span>
            <span class="logo-item">OVO</span>
            <span class="logo-item">Tiket.com</span>
            <span class="logo-item">Shopee</span>
        </div>
    </div>
</div>


<!-- ════ FEATURES ════ -->
<section id="features" class="features-section">
    <div class="section-inner">
        <div class="reveal">
            <p class="section-eyebrow"><span class="eyebrow-line"></span> Fitur Platform</p>
            <h2 class="section-title">Semua yang Anda<br>butuhkan, di satu tempat</h2>
            <p class="section-sub">Dari matching cerdas hingga pembayaran aman — Jobza hadir dengan ekosistem lengkap untuk karir Anda.</p>
        </div>

        <div class="features-grid reveal">
            <div class="feature-card">
                <div class="feature-icon fi-blue">🎯</div>
                <h3 class="feature-title">Smart AI Matching</h3>
                <p class="feature-desc">Algoritma kami menganalisis skill, pengalaman, dan preferensi untuk menampilkan peluang yang paling relevan secara real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-cyan">💬</div>
                <h3 class="feature-title">Chat Real-time</h3>
                <p class="feature-desc">Komunikasi langsung dengan employer atau talent tanpa perlu aplikasi pihak ketiga. End-to-end encrypted.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-purple">🛡️</div>
                <h3 class="feature-title">Escrow & Pembayaran Aman</h3>
                <p class="feature-desc">Dana disimpan aman di escrow hingga pekerjaan selesai dan disetujui kedua belah pihak. Zero risiko penipuan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-green">⭐</div>
                <h3 class="feature-title">Rating Transparan</h3>
                <p class="feature-desc">Sistem review dua arah yang terverifikasi membangun kepercayaan dan reputasi yang nyata di komunitas Jobza.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-orange">📊</div>
                <h3 class="feature-title">Dashboard Analytics</h3>
                <p class="feature-desc">Pantau lamaran, pendapatan, dan performa dengan dashboard interaktif yang dilengkapi insight actionable.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-rose">🚀</div>
                <h3 class="feature-title">Career Growth Hub</h3>
                <p class="feature-desc">Akses ribuan konten pelatihan, sertifikasi, dan mentoring dari para profesional berpengalaman di industri.</p>
            </div>
        </div>
    </div>
</section>


<!-- ════ HOW IT WORKS ════ -->
<section id="how">
    <div class="section-inner">
        <div class="reveal" style="text-align:center; margin-bottom: 0;">
            <p class="section-eyebrow" style="justify-content:center;"><span class="eyebrow-line"></span> Cara Kerja <span class="eyebrow-line"></span></p>
            <h2 class="section-title">4 Langkah Mudah<br>Menuju Karir Terbaik</h2>
        </div>

        <div class="steps-row reveal">
            <div class="step-card">
                <div class="step-num">1</div>
                <h3 class="step-title">Buat Profil</h3>
                <p class="step-desc">Daftar dalam 2 menit dan lengkapi profil dengan skill, pengalaman, dan portofolio Anda.</p>
            </div>
            <div class="step-card">
                <div class="step-num">2</div>
                <h3 class="step-title">Temukan Match</h3>
                <p class="step-desc">AI kami langsung merekomendasikan lowongan atau talent yang paling cocok dengan profil Anda.</p>
            </div>
            <div class="step-card">
                <div class="step-num">3</div>
                <h3 class="step-title">Diskusi & Negosiasi</h3>
                <p class="step-desc">Chat langsung, kirim proposal, dan sepakati detail pekerjaan dengan nyaman di dalam platform.</p>
            </div>
            <div class="step-card">
                <div class="step-num">4</div>
                <h3 class="step-title">Kerja & Dibayar</h3>
                <p class="step-desc">Mulai bekerja dengan jaminan pembayaran aman melalui sistem escrow kami yang terpercaya.</p>
            </div>
        </div>
    </div>
</section>


<!-- ════ ABOUT + TIMELINE ════ -->
<section id="about" style="background: var(--navy-mid);">
    <div class="section-inner">
        <div class="about-grid">
            <div class="about-text reveal">
                <p class="section-eyebrow"><span class="eyebrow-line"></span> Tentang Jobza</p>
                <h2 class="section-title">Menghubungkan Talent<br>Terbaik dengan Peluang<br><span style="background:linear-gradient(135deg,#60A5FA,#06B6D4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Tanpa Batas</span></h2>
                <p class="section-sub" style="margin-bottom:2rem;">Jobza lahir dari misi sederhana: membuat dunia kerja lebih adil, transparan, dan mudah diakses oleh semua orang di seluruh Indonesia.</p>

                <div class="about-numbers">
                    <div class="about-num-card">
                        <p class="about-num">50K+</p>
                        <p class="about-num-label">Pengguna Aktif</p>
                    </div>
                    <div class="about-num-card">
                        <p class="about-num">10K+</p>
                        <p class="about-num-label">Lowongan Aktif</p>
                    </div>
                    <div class="about-num-card">
                        <p class="about-num">5K+</p>
                        <p class="about-num-label">Proyek Sukses</p>
                    </div>
                    <div class="about-num-card">
                        <p class="about-num">98%</p>
                        <p class="about-num-label">Tingkat Kepuasan</p>
                    </div>
                </div>
            </div>

            <div class="reveal">
                <ul class="timeline">
                    <li class="tl-item">
                        <div class="tl-dot" style="font-size:0.6rem;">2021</div>
                        <div class="tl-content">
                            <p class="tl-year">2021</p>
                            <p class="tl-title">Platform Diluncurkan</p>
                            <p class="tl-desc">Jobza resmi hadir dengan fitur dasar matching dan chat real-time untuk pencari kerja dan employer.</p>
                        </div>
                    </li>
                    <li class="tl-item">
                        <div class="tl-dot" style="font-size:0.6rem;">2022</div>
                        <div class="tl-content">
                            <p class="tl-year">2022</p>
                            <p class="tl-title">Mencapai 10.000 Pengguna</p>
                            <p class="tl-desc">Komunitas Jobza berkembang pesat. Fitur freelance dan escrow payment resmi diluncurkan.</p>
                        </div>
                    </li>
                    <li class="tl-item">
                        <div class="tl-dot" style="font-size:0.6rem;">2023</div>
                        <div class="tl-content">
                            <p class="tl-year">2023</p>
                            <p class="tl-title">Sistem AI Matching</p>
                            <p class="tl-desc">Integrasi AI generatif untuk smart matching dengan akurasi hingga 94%, merevolusi cara orang menemukan pekerjaan.</p>
                        </div>
                    </li>
                    <li class="tl-item">
                        <div class="tl-dot" style="font-size:0.6rem;">2024</div>
                        <div class="tl-content">
                            <p class="tl-year">2024</p>
                            <p class="tl-title">50.000+ Pengguna Aktif</p>
                            <p class="tl-desc">Jobza menjadi platform karir terpercaya dengan ribuan kesuksesan setiap bulannya di seluruh Indonesia.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- ════ TESTIMONIALS ════ -->
<section class="testi-section">
    <div class="section-inner">
        <div class="reveal" style="text-align:center;">
            <p class="section-eyebrow" style="justify-content:center;"><span class="eyebrow-line"></span> Testimoni <span class="eyebrow-line"></span></p>
            <h2 class="section-title">Dipercaya Oleh Ribuan<br>Profesional Indonesia</h2>
        </div>

        <div class="testi-grid reveal">
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Dalam 2 minggu setelah daftar di Jobza, saya sudah dapat 3 tawaran kerja yang semuanya relevan dengan skill saya. AI matching-nya beneran akurat!"</p>
                <div class="testi-author">
                    <div class="testi-avatar av-blue">AR</div>
                    <div>
                        <p class="testi-name">Ahmad Riyanto</p>
                        <p class="testi-role">Senior Frontend Dev · Jakarta</p>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Sebagai employer, Jobza membantu kami menemukan UI/UX designer berkualitas dalam hitungan hari. Prosesnya mudah dan transparan dari awal sampai akhir."</p>
                <div class="testi-author">
                    <div class="testi-avatar av-cyan">DN</div>
                    <div>
                        <p class="testi-name">Dewi Nastiti</p>
                        <p class="testi-role">HR Manager · Startup SaaS</p>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Sistem escrow Jobza bikin saya tenang dalam mengerjakan proyek freelance. Bayaran selalu tepat waktu dan aman. Sudah 15+ proyek sukses lewat sini!"</p>
                <div class="testi-author">
                    <div class="testi-avatar av-purple">SN</div>
                    <div>
                        <p class="testi-name">Siti Nurhaliza</p>
                        <p class="testi-role">Freelance Designer · Bandung</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ════ PRICING ════ -->
<section id="pricing">
    <div class="section-inner">
        <div class="reveal" style="text-align:center;">
            <p class="section-eyebrow" style="justify-content:center;"><span class="eyebrow-line"></span> Paket Harga <span class="eyebrow-line"></span></p>
            <h2 class="section-title">Investasi Terbaik untuk<br>Karir Anda</h2>
            <p class="section-sub" style="margin:0 auto;">Mulai gratis, upgrade kapan saja. Tidak perlu kartu kredit.</p>
        </div>

        <div class="pricing-grid reveal">
            <!-- Basic -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <p class="pricing-label">Untuk Pemula</p>
                    <h3 class="pricing-name">Basic</h3>
                    <div class="pricing-price">
                        <span class="price-num">Gratis</span>
                    </div>
                    <p style="color:var(--gray);font-size:0.83rem;margin-top:6px;">Selamanya, tanpa syarat</p>
                </div>
                <div class="pricing-body">
                    <ul class="pricing-features">
                        <li><span class="check">✓</span> Profil & Portofolio Dasar</li>
                        <li><span class="check">✓</span> Chat Unlimited</li>
                        <li><span class="check">✓</span> Akses Semua Lowongan</li>
                        <li><span class="check">✓</span> Rating & Review</li>
                        <li><span class="cross">✗</span> <span class="li-off">Verified Badge</span></li>
                        <li><span class="cross">✗</span> <span class="li-off">CV Builder Premium</span></li>
                    </ul>
                    <button class="btn-pricing btn-pricing-outline">Daftar Gratis</button>
                </div>
            </div>

            <!-- Pro -->
            <div class="pricing-card featured">
                <div class="pricing-header" style="background:linear-gradient(135deg,rgba(59,130,246,0.12),rgba(6,182,212,0.08));">
                    <p class="pricing-label">Untuk Profesional</p>
                    <h3 class="pricing-name">
                        Pro
                        <span class="badge-popular">POPULER</span>
                    </h3>
                    <div class="pricing-price">
                        <span class="price-num">Rp49K</span>
                        <span class="price-period">/bulan</span>
                    </div>
                    <p style="color:var(--gray);font-size:0.83rem;margin-top:6px;">Hemat 30% dengan paket tahunan</p>
                </div>
                <div class="pricing-body">
                    <ul class="pricing-features">
                        <li><span class="check">✓</span> Semua fitur Basic</li>
                        <li><span class="check">✓</span> Portofolio Premium</li>
                        <li><span class="check">✓</span> Verified Badge ✦</li>
                        <li><span class="check">✓</span> Priority Support 24/7</li>
                        <li><span class="check">✓</span> CV Builder Premium</li>
                        <li><span class="check">✓</span> Analytics Dashboard</li>
                    </ul>
                    <button class="btn-pricing btn-pricing-filled">Mulai Sekarang</button>
                </div>
            </div>

            <!-- Enterprise -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <p class="pricing-label">Untuk Tim & Perusahaan</p>
                    <h3 class="pricing-name">Enterprise</h3>
                    <div class="pricing-price">
                        <span class="price-num">Custom</span>
                    </div>
                    <p style="color:var(--gray);font-size:0.83rem;margin-top:6px;">Harga disesuaikan kebutuhan</p>
                </div>
                <div class="pricing-body">
                    <ul class="pricing-features">
                        <li><span class="check">✓</span> Semua fitur Pro</li>
                        <li><span class="check">✓</span> Custom API Integration</li>
                        <li><span class="check">✓</span> Dedicated Account Manager</li>
                        <li><span class="check">✓</span> Unlimited Job Posting</li>
                        <li><span class="check">✓</span> ATS Integration</li>
                        <li><span class="check">✓</span> SLA & Premium Support</li>
                    </ul>
                    <button class="btn-pricing btn-pricing-outline">Hubungi Sales →</button>
                </div>
            </div>
        </div>

        <!-- Commission -->
        <div class="commission-grid reveal">
            <div class="commission-card">
                <p class="commission-title">
                    <span style="color:var(--accent-bright);">💼</span>
                    Komisi Transaksional
                </p>
                <ul class="commission-list">
                    <li><span class="cl-label">Full-time Job</span><span class="cl-val">Gratis</span></li>
                    <li><span class="cl-label">Freelance Project</span><span class="cl-val">5% dari nilai</span></li>
                    <li><span class="cl-label">Biaya Withdrawal</span><span class="cl-val">2.5% admin</span></li>
                </ul>
            </div>
            <div class="commission-card">
                <p class="commission-title">
                    <span style="color:var(--cyan);">🏢</span>
                    Paket Employer
                </p>
                <ul class="commission-list">
                    <li><span class="cl-label">Posting Lowongan</span><span class="cl-val">Rp 99K – 299K</span></li>
                    <li><span class="cl-label">Featured Posting</span><span class="cl-val">Rp 499K – 999K</span></li>
                    <li><span class="cl-label">Subscription Bulanan</span><span class="cl-val">Rp 1.9Jt/bln</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- ════ CTA ════ -->
<section class="cta-section">
    <div class="cta-bg"></div>
    <div class="cta-inner reveal">
        <h2 class="cta-title">Siap Mengubah<br><span style="background:linear-gradient(135deg,#60A5FA,#06B6D4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Karir Anda?</span></h2>
        <p class="cta-desc">Bergabunglah dengan 50,000+ profesional yang telah menemukan pekerjaan impian dan talent terbaik mereka melalui Jobza.</p>
        <div class="cta-btns">
            <a href="#" class="btn-hero-primary">
                Daftar Gratis Sekarang
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="#" class="btn-hero-outline">Hubungi Tim Sales</a>
        </div>
        <p class="cta-note">Tidak perlu kartu kredit · Gratis selamanya untuk paket Basic</p>
    </div>
</section>


<!-- ════ FOOTER ════ -->
<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <a class="nav-logo" href="#" style="display:inline-flex;">
                    <div class="nav-logo-icon">J</div>
                    <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.3rem;color:var(--white);">Jobza</span>
                </a>
                <p>Platform all-in-one untuk lowongan kerja dan freelance terpercaya di Indonesia. Menghubungkan talent terbaik dengan peluang terbaik.</p>
                <div class="footer-social">
                    <a class="social-btn" href="#">f</a>
                    <a class="social-btn" href="#">𝕏</a>
                    <a class="social-btn" href="#">in</a>
                    <a class="social-btn" href="#">▶</a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Produk</h4>
                <ul>
                    <li><a href="#">Lowongan Kerja</a></li>
                    <li><a href="#">Freelance</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Career Hub</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Press Kit</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2024 Jobza. Semua hak cipta dilindungi.</p>
            <p>Dibuat dengan ❤️ di Indonesia 🇮🇩</p>
        </div>
    </div>
</footer>


<!-- ════ SCRIPTS ════ -->
<script>
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const t = document.querySelector(a.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
        });
    });

    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    reveals.forEach(r => observer.observe(r));

    // Navbar scroll effect
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        nav.style.background = window.scrollY > 40
            ? 'rgba(10,15,30,0.95)'
            : 'rgba(10,15,30,0.7)';
    });

    // Counter animation
    function animateCount(el, target, duration = 1800) {
        const isK = target.toString().includes('K');
        const num = parseFloat(target);
        let start = 0;
        const step = num / (duration / 16);
        const timer = setInterval(() => {
            start = Math.min(start + step, num);
            el.textContent = start >= num
                ? target
                : (Math.floor(start) + (isK ? 'K+' : '%'));
            if (start >= num) clearInterval(timer);
        }, 16);
    }

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const nums = e.target.querySelectorAll('.stat-num, .about-num');
                nums.forEach(n => animateCount(n, n.textContent));
                statsObserver.unobserve(e.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.hero-stats, .about-numbers').forEach(el => statsObserver.observe(el));
</script>

</body>
</html>
