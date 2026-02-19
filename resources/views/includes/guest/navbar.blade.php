<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <div class="mobile-menu-logo">
            <img src="{{ asset('Images/Default/Logo.png') }}" alt="{{ config('app.name') }} Logo">
            {{-- <span class="mobile-menu-brand">{{ config('app.name') }}</span> --}}
        </div>
        <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close menu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="mobile-menu-content">
        <div class="mobile-quick-actions">
            <a href="#" class="mobile-quick-action" id="mobileSearchAction">
                <i class="fas fa-search"></i>
                <span>Search</span>
            </a>
            <a href="#" class="mobile-quick-action">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
                @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
                    <span class="badge"></span>
                @endif
            </a>
        </div>

        <div class="mobile-nav-section">
            <div class="mobile-nav-title">Menu</div>
            <div class="mobile-nav-links">
                <a href="{{ route('home') }}" class="mobile-nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('about') }}" class="mobile-nav-link {{ Request::routeIs('about') ? 'active' : '' }}">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
                <a href="{{ route('contact.index') }}"
                    class="mobile-nav-link {{ Request::routeIs('contact.index') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </div>
        </div>

        @auth
            <div class="mobile-nav-section">
                <div class="mobile-nav-title">Account</div>
                <div class="mobile-nav-links">
                    <a href="{{ route('dashboard') }}" class="mobile-nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('profile') }}" class="mobile-nav-link">
                        <i class="fas fa-user-circle"></i>
                        <span>Profile</span>
                    </a>
                    <a href="{{ route('settings') }}" class="mobile-nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>
        @endauth
    </div>

    <div class="mobile-action-buttons">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="mobile-action-btn secondary"
                    style="width: 100%; border: none; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="mobile-action-btn primary">
                <i class="fas fa-sign-in-alt"></i>
                <span>Sign In</span>
            </a>

        @endauth
    </div>
</div>

<nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="nav-left">
        <div class="logo-container">
            <a href="{{ route('home') }}" class="logo-link">
                <img class="logo-img" src="{{ asset('Images/Default/Logo.png') }}"
                    alt="{{ config('app.name') }} Logo">
            </a>
            {{-- <span class="brand-name">{{ config('app.name') }}</span> --}}
        </div>
    </div>

    <div class="nav-center" id="navMenu">
        <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
            {{ Request::routeIs('home') ? 'aria-current=page' : '' }}>
            <i class="fas fa-home"></i>
            Home
        </a>
        <a href="{{ route('about') }}" class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}"
            {{ Request::routeIs('about') ? 'aria-current=page' : '' }}>
            <i class="fas fa-info-circle"></i>
            About
        </a>
        <a href="{{ route('contact.index') }}"
            class="nav-link {{ Request::routeIs('contact.index') ? 'active' : '' }}"
            {{ Request::routeIs('contact.index') ? 'aria-current=page' : '' }}>
            <i class="fas fa-envelope"></i>
            Contact
        </a>
    </div>

    <div class="nav-right">
        <a href="#" class="icon-button" data-tooltip="Notifications" aria-label="View notifications">
            <i class="fas fa-bell"></i>
            @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
                <span class="badge"></span>
            @endif
        </a>

        <a href="#" class="icon-button" data-tooltip="Search" aria-label="Search">
            <i class="fas fa-search"></i>
        </a>

        @auth
            <a href="{{ route('/') }}" class="cta-button" aria-label="Go to dashboard">
                <i class="fas fa-user"></i>
                {{-- <span>Dashboard</span> --}}
            </a>
        @else
            <a href="{{ route('login') }}" class="cta-button" aria-label="Sign in to your account">
                <i class="fas fa-user"></i>
            </a>
        @endauth
    </div>

    <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation menu" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuClose = document.getElementById('mobileMenuClose');

        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.classList.add('menu-open');
            mobileToggle.setAttribute('aria-expanded', 'true');
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.classList.remove('menu-open');
            mobileToggle.setAttribute('aria-expanded', 'false');
        }

        function toggleMobileMenu() {
            if (mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', closeMobileMenu);
        }

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
        }

        document.querySelectorAll('.mobile-nav-link, .mobile-action-btn, .mobile-quick-action').forEach(
            link => {
                link.addEventListener('click', (e) => {
                    if (link.tagName === 'BUTTON' && link.closest('form')) {
                        return;
                    }
                    setTimeout(closeMobileMenu, 200);
                });
            });

        document.querySelector('.skip-link')?.addEventListener('click', (e) => {
            e.preventDefault();
            const mainContent = document.getElementById('main-content');
            if (mainContent) {
                mainContent.focus();
                mainContent.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });

        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                navbar.style.transform = 'translateY(-5px)';
                navbar.style.boxShadow =
                    '0 1px 3px rgba(0, 0, 0, 0.08), 0 20px 60px -15px rgba(0, 0, 0, 0.15)';
            } else {
                navbar.style.transform = 'translateY(0)';
                navbar.style.boxShadow =
                    '0 1px 3px rgba(0, 0, 0, 0.05), 0 10px 40px -10px rgba(0, 0, 0, 0.08)';
            }

            lastScroll = currentScroll;
        });

        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
            });
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 900 && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        if (mobileMenu) {
            mobileMenu.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }

        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        document.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const swipeThreshold = 100;
            const swipeDistance = touchEndX - touchStartX;

            if (mobileMenu.classList.contains('active') && swipeDistance > swipeThreshold &&
                touchStartX > window
                .innerWidth * 0.7) {
                closeMobileMenu();
            }
        }, false);

        document.querySelectorAll('.mobile-action-btn, .cta-button').forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.classList.contains('primary') && !this.closest('form')) {
                    this.style.opacity = '0.7';
                    this.style.pointerEvents = 'none';

                    setTimeout(() => {
                        this.style.opacity = '1';
                        this.style.pointerEvents = 'auto';
                    }, 1000);
                }
            });
        });

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML =
                        '<i class="fas fa-spinner fa-spin"></i> Loading...';
                }
            });
        });
    });
</script>
