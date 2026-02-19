@php
    $ministries = \App\Models\Ministry::orderBy('id')->limit(7)->get();
@endphp

<footer class="church-footer">
    <div class="footer-ornament"></div>
    <div class="footer-pattern"></div>

    <div class="footer-content">
        <div class="verse">
            <div class="verse-text">
                "For where two or three gather in my name, there am I with them."
            </div>
            <div class="verse-reference">MATTHEW 18:20</div>
        </div>

        <div class="footer-main">
            <div class="footer-brand">
                <div class="brand-cross"></div>
                <h2 class="brand-name">Emmanuel World Mission Church</h2>
                <p class="brand-tagline">A Place of Faith, Hope, and Love</p>
                <p class="brand-mission">
                    We are a vibrant community dedicated to growing in faith, serving others with love,
                    and spreading the Gospel of Jesus Christ. Join us as we walk together in spiritual growth and
                    fellowship.
                </p>
                <div class="social-links">
                    <a href="https://www.facebook.com/emmanuelworldmissionchurch" class="social-link" target="__blank"
                        aria-label="Facebook">f</a>
                    <a href="#" class="social-link" aria-label="Instagram">📷</a>
                    <a href="#" class="social-link" aria-label="YouTube">▶</a>
                    <a href="#" class="social-link" aria-label="Podcast">🎙</a>
                </div>
            </div>

            <div class="footer-column">
                <h3 class="column-title">Ministries</h3>
                <ul class="footer-links">
                    @forelse ($ministries as $ministry)
                        <li><a href="#">{{ $ministry->name }}</a></li>
                    @empty
                        <li><a href="#">No ministries available</a></li>
                    @endforelse
                </ul>
            </div>

            <div class="footer-column">
                <h3 class="column-title">Service Times</h3>
                <div class="service-times">
                    <div class="service-time">
                        <span class="service-day">Sunday</span>
                        <span class="service-hour">9:00 AM</span>
                    </div>
                    <div class="service-time">
                        <span class="service-day">Wednesday</span>
                        <span class="service-hour">7:00 PM</span>
                    </div>
                    <div class="service-time">
                        <span class="service-day">Friday</span>
                        <span class="service-hour">7:30 PM</span>
                    </div>
                </div>
            </div>

            <div class="footer-column">
                <h3 class="column-title">Contact Us</h3>
                <div class="contact-item">
                    <i class="fa-solid fa-location-dot contact-icon" aria-hidden="true"></i>
                    <span>Block 6 Section 2 <br>1st Street</span>
                </div>

                <div class="contact-item">
                    <i class="fa-solid fa-phone contact-icon"></i>
                    <span>(555) 123-4567</span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-envelope contact-icon"></i>
                    <span>emwc.com</span>
                </div>
                <ul class="footer-links" style="margin-top: 20px;">
                    <li><a href="#">Get Directions</a></li>
                    <li><a href="#">Plan Your Visit</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            <p class="copyright">
                © {{ date('Y') }} Emmanuel World Mission Church. All rights reserved.
            </p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
                <a href="#">Donations</a>
                <a href="#">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<style>
    :root {
        --primary-violet: #6366f1;
        --secondary-violet: #8b5cf6;
        --light-violet: rgba(99, 102, 241, 0.1);
        --dark-bg: #1f2937;
        --text-primary: #1a1a1a;
        --text-secondary: #4b5563;
        --text-light: #9ca3af;
        --white: #ffffff;
        --border-color: rgba(0, 0, 0, 0.06);
    }

    .church-footer {
        width: 100%;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        position: relative;
        overflow: hidden;
        box-shadow: 0 -10px 40px rgba(99, 102, 241, 0.2);
        margin-top: auto;
    }

    .footer-ornament {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg,
                transparent 0%,
                rgba(255, 255, 255, 0.3) 30%,
                rgba(255, 255, 255, 0.5) 50%,
                rgba(255, 255, 255, 0.3) 70%,
                transparent 100%);
        box-shadow: 0 2px 20px rgba(255, 255, 255, 0.3);
    }

    .footer-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 50%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .footer-content {
        position: relative;
        max-width: 1400px;
        margin: 0 auto;
        padding: 80px 60px 40px;
        z-index: 1;
    }

    .footer-main {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 60px;
        margin-bottom: 60px;
    }

    .footer-brand {
        padding-right: 40px;
    }

    .brand-cross {
        width: 50px;
        height: 50px;
        position: relative;
        margin-bottom: 24px;
        animation: glowPulse 3s ease-in-out infinite;
    }

    @keyframes glowPulse {

        0%,
        100% {
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.4));
        }

        50% {
            filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.6));
        }
    }

    .brand-cross::before,
    .brand-cross::after {
        content: '';
        position: absolute;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .brand-cross::before {
        width: 8px;
        height: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 4px;
    }

    .brand-cross::after {
        width: 100%;
        height: 8px;
        top: 30%;
        transform: translateY(-50%);
        border-radius: 4px;
    }

    .brand-name {
        font-size: 32px;
        font-weight: 700;
        color: white;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .brand-tagline {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 24px;
        font-style: italic;
        font-weight: 400;
        line-height: 1.6;
    }

    .brand-mission {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.8;
        margin-bottom: 28px;
    }

    .social-links {
        display: flex;
        gap: 12px;
    }

    .social-link {
        width: 44px;
        height: 44px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 18px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .social-link:hover {
        background: white;
        color: var(--primary-violet);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        border-color: white;
    }

    .footer-column {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .footer-column:nth-child(2) {
        animation-delay: 0.1s;
    }

    .footer-column:nth-child(3) {
        animation-delay: 0.2s;
    }

    .footer-column:nth-child(4) {
        animation-delay: 0.3s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .column-title {
        font-size: 20px;
        font-weight: 700;
        color: white;
        margin-bottom: 24px;
        letter-spacing: -0.3px;
        position: relative;
        display: inline-block;
    }

    .column-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background: white;
        border-radius: 2px;
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 14px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-size: 16px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
        position: relative;
    }

    .footer-links a:hover {
        color: white;
        transform: translateX(4px);
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 18px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 15px;
        line-height: 1.6;
    }

    .contact-icon {
        font-size: 18px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .service-times {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .service-time {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .service-time:last-child {
        margin-bottom: 0;
    }

    .service-day {
        color: white;
        font-weight: 600;
    }

    .service-hour {
        color: rgba(255, 255, 255, 0.9);
    }

    .footer-divider {
        height: 1px;
        background: linear-gradient(90deg,
                transparent 0%,
                rgba(255, 255, 255, 0.3) 20%,
                rgba(255, 255, 255, 0.3) 80%,
                transparent 100%);
        margin: 40px 0;
    }

    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .copyright {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
    }

    .footer-bottom-links {
        display: flex;
        gap: 28px;
    }

    .footer-bottom-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-bottom-links a:hover {
        color: white;
    }

    .verse {
        text-align: center;
        margin-bottom: 32px;
        padding: 32px 40px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .verse-text {
        font-size: 22px;
        font-style: italic;
        color: white;
        margin-bottom: 12px;
        line-height: 1.6;
        font-weight: 400;
    }

    .verse-reference {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    @media (max-width: 1024px) {
        .footer-main {
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .footer-brand {
            grid-column: 1 / -1;
            padding-right: 0;
        }
    }

    @media (max-width: 640px) {
        .footer-content {
            padding: 60px 30px 30px;
        }

        .footer-main {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .brand-name {
            font-size: 28px;
        }

        .verse {
            padding: 24px 20px;
        }

        .verse-text {
            font-size: 18px;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }

        .footer-bottom-links {
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>
