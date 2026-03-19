@extends('layouts.app')

@section('title', 'Sign In | BUGGXIT Couture | Geometric Luxury Fashion')

@section('content')
    <!-- Hero Section -->
    <section class="signin-hero" style="position: relative; padding: 8rem 0 4rem; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h1 class="section-title" style="font-size: 3.5rem; margin-bottom: 1rem;">
                    Enter Your <span class="accent">Geometric</span> World
                </h1>
                <p style="font-size: 1.2rem; color: var(--text-light); line-height: 1.8; max-width: 700px; margin: 0 auto 2rem;">
                    Access your exclusive account to manage orders, save favorites, and experience personalized luxury shopping.
                </p>
            </div>
        </div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(10,10,10,0.95) 0%, rgba(26,26,26,0.85) 100%); z-index: 1;"></div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://images.unsplash.com/photo-1558769132-cb1ceedf8beb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; opacity: 0.3; z-index: 0;"></div>
    </section>

    <!-- Sign In Section -->
    <section class="signin-form-section" style="padding: 6rem 0; background: var(--bg);">
        <div class="container">
            <div style="max-width: 500px; margin: 0 auto;">
                <!-- Sign In Form -->
                <div style="background: var(--surface); border: 1px solid var(--border); padding: 3rem;">
                    <div style="text-align: center; margin-bottom: 2.5rem;">
                        <div style="position: relative; display: inline-block;">
                            <div style="width: 80px; height: 80px; background: rgba(212, 175, 55, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; border: 2px solid var(--accent);">
                                <i class="fas fa-user" style="font-size: 2rem; color: var(--accent);"></i>
                            </div>
                            <div style="position: absolute; top: -5px; right: -5px; width: 25px; height: 25px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-lock" style="font-size: 0.8rem; color: var(--bg);"></i>
                            </div>
                        </div>
                        <h2 style="font-family: 'Manrope', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">
                            Welcome <span class="accent">Back</span>
                        </h2>
                        <p style="color: var(--text-light);">Sign in to your BUGGXIT account</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" id="signinForm">
                        @csrf

                        <!-- Email Field -->
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 0.5rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                Email Address *
                            </label>
                            <div style="position: relative;">
                                <input type="email" name="email" value="{{ old('email') }}" required 
                                       style="width: 100%; padding: 1rem 1rem 1rem 3rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem; transition: all 0.3s;"
                                       placeholder="your.email@example.com"
                                       onfocus="this.style.borderColor='var(--accent)'; this.style.boxShadow='0 0 0 2px rgba(212, 175, 55, 0.2)';"
                                       onblur="this.style.borderColor='var(--border)'; this.style.boxShadow='none';">
                                <div style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            @error('email')
                                <div style="color: #ff4444; font-size: 0.85rem; margin-top: 0.5rem;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div style="margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <label style="color: var(--text-light); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                    Password *
                                </label>
                                <a href="{{ route('password.forgot') }}" style="color: var(--accent); text-decoration: none; font-size: 0.85rem; transition: all 0.3s;"
                                   onmouseover="this.style.opacity='0.8';" onmouseout="this.style.opacity='1';">
                                    Forgot Password?
                                </a>
                            </div>
                            <div style="position: relative;">
                                <input type="password" name="password" required 
                                       id="passwordInput"
                                       style="width: 100%; padding: 1rem 3rem 1rem 3rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem; transition: all 0.3s;"
                                       placeholder="Enter your password"
                                       onfocus="this.style.borderColor='var(--accent)'; this.style.boxShadow='0 0 0 2px rgba(212, 175, 55, 0.2)';"
                                       onblur="this.style.borderColor='var(--border)'; this.style.boxShadow='none';">
                                <div style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <button type="button" id="togglePassword" 
                                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-light); cursor: pointer;"
                                        onmouseover="this.style.color='var(--accent)';" onmouseout="this.style.color='var(--text-light)';">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div style="color: #ff4444; font-size: 0.85rem; margin-top: 0.5rem;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div style="margin-bottom: 2rem;">
                            <label style="display: flex; align-items: center; color: var(--text-light); font-size: 0.9rem; cursor: pointer;">
                                <input type="checkbox" name="remember" 
                                       style="margin-right: 0.75rem; accent-color: var(--accent); width: 1.1rem; height: 1.1rem; cursor: pointer;"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me for 30 days</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                style="width: 100%; padding: 1rem; background: var(--accent); color: var(--bg); border: none; font-size: 1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: all 0.3s;"
                                onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)';">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </button>

                        <!-- Error Alert -->
                        @if ($errors->has('login'))
                            <div style="background: rgba(255, 68, 68, 0.1); border: 1px solid #ff4444; color: #ff4444; padding: 1rem; margin-top: 1.5rem; border-radius: 4px; font-size: 0.9rem;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                {{ $errors->first('login') }}
                            </div>
                        @endif
                    </form>

                    <!-- Divider -->
                    <div style="display: flex; align-items: center; margin: 2.5rem 0;">
                        <div style="flex: 1; height: 1px; background: var(--border);"></div>
                        <span style="padding: 0 1rem; color: var(--text-light); font-size: 0.9rem; text-transform: uppercase;">Or Continue With</span>
                        <div style="flex: 1; height: 1px; background: var(--border);"></div>
                    </div>

                    <!-- Social Login -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2.5rem;">
                        <button type="button" 
                                style="padding: 0.75rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s;"
                                onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                            <i class="fab fa-google" style="color: #DB4437;"></i>
                        </button>
                        <button type="button" 
                                style="padding: 0.75rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s;"
                                onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                            <i class="fab fa-facebook-f" style="color: #4267B2;"></i>
                        </button>
                        <button type="button" 
                                style="padding: 0.75rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s;"
                                onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                            <i class="fab fa-apple" style="color: #000;"></i>
                        </button>
                    </div>

                    <!-- Sign Up Link -->
                    <div style="text-align: center; padding-top: 1.5rem; border-top: 1px solid var(--border);">
                        <p style="color: var(--text-light); margin-bottom: 1rem;">
                            Don't have an account?
                        </p>
                        <a href="{{ route('register') }}" 
                           style="display: inline-block; padding: 0.875rem 2.5rem; border: 2px solid var(--accent); color: var(--accent); text-decoration: none; font-weight: 600; transition: all 0.3s;"
                           onmouseover="this.style.background='var(--accent)'; this.style.color='var(--bg)';"
                           onmouseout="this.style.background='transparent'; this.style.color='var(--accent)';">
                            Create Account
                        </a>
                    </div>
                </div>

                <!-- Features Grid -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 3rem;">
                    <div style="text-align: center; padding: 1.5rem; background: var(--surface); border: 1px solid var(--border);">
                        <div style="font-size: 1.5rem; color: var(--accent); margin-bottom: 0.75rem;">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <p style="font-size: 0.85rem; color: var(--text-light); line-height: 1.4;">
                            Track Orders & Returns
                        </p>
                    </div>
                    <div style="text-align: center; padding: 1.5rem; background: var(--surface); border: 1px solid var(--border);">
                        <div style="font-size: 1.5rem; color: var(--accent); margin-bottom: 0.75rem;">
                            <i class="fas fa-heart"></i>
                        </div>
                        <p style="font-size: 0.85rem; color: var(--text-light); line-height: 1.4;">
                            Save Your Favorites
                        </p>
                    </div>
                    <div style="text-align: center; padding: 1.5rem; background: var(--surface); border: 1px solid var(--border);">
                        <div style="font-size: 1.5rem; color: var(--accent); margin-bottom: 0.75rem;">
                            <i class="fas fa-tag"></i>
                        </div>
                        <p style="font-size: 0.85rem; color: var(--text-light); line-height: 1.4;">
                            Exclusive Offers
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="signin-cta" style="padding: 6rem 0; background: linear-gradient(135deg, var(--surface) 0%, var(--surface-light) 100%); border-top: 1px solid var(--border);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    Not a Member <span class="accent">Yet</span>?
                </h2>
                <p style="color: var(--text-light); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2.5rem;">
                    Join BUGGXIT Couture and unlock exclusive benefits, early access to collections, 
                    and personalized geometric style recommendations.
                </p>
                <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('register') }}" class="btn" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        <i class="fas fa-user-plus" style="margin-right: 0.75rem;"></i> Create Account
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        Learn About Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Geometric Pattern Overlay -->
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999; opacity: 0.03;">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="geometric-pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                    <path d="M0 0L100 0 100 100 0 100Z" fill="none" stroke="var(--accent)" stroke-width="2"/>
                    <path d="M50 0L50 100" stroke="var(--accent)" stroke-width="1"/>
                    <path d="M0 50L100 50" stroke="var(--accent)" stroke-width="1"/>
                    <circle cx="50" cy="50" r="20" fill="none" stroke="var(--accent)" stroke-width="1"/>
                    <polygon points="50,10 60,30 80,30 65,45 75,65 50,55 25,65 35,45 20,30 40,30" fill="none" stroke="var(--accent)" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#geometric-pattern)"/>
        </svg>
    </div>
@endsection

@push('styles')
    <style>
        /* Form field animations */
        input[type="email"], input[type="password"] {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Submit button hover effect */
        button[type="submit"]:hover {
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }
        
        /* Feature cards hover effect */
        .signin-form-section div[style*="text-align: center; padding: 1.5rem;"]:hover {
            transform: translateY(-5px);
            border-color: var(--accent) !important;
            box-shadow: var(--shadow);
        }
        
        /* Social buttons icon animation */
        .signin-form-section button[style*="padding: 0.75rem;"]:hover i {
            transform: scale(1.2);
            transition: transform 0.3s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .signin-hero h1.section-title {
                font-size: 2.5rem;
            }
            
            .signin-form-section {
                padding: 4rem 0 !important;
            }
            
            .signin-form-section > .container > div {
                padding: 0 1rem;
            }
            
            .signin-form-section div[style*="background: var(--surface);"] {
                padding: 2rem !important;
            }
            
            .signin-cta .btn {
                width: 100%;
                max-width: 300px;
            }
            
            .signin-form-section div[style*="display: grid; grid-template-columns: repeat(3, 1fr)"] {
                grid-template-columns: 1fr !important;
            }
        }
        
        @media (max-width: 480px) {
            .signin-hero h1.section-title {
                font-size: 2rem;
            }
            
            .signin-form-section h2 {
                font-size: 1.75rem !important;
            }
            
            .signin-cta h2 {
                font-size: 2rem !important;
            }
            
            .signin-form-section div[style*="display: grid; grid-template-columns: repeat(3, 1fr)"] {
                gap: 1rem !important;
            }
        }
        
        /* Loading animation for form submission */
        .loading {
            position: relative;
            color: transparent !important;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid var(--bg);
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Success animation */
        @keyframes checkmark {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .success-check {
            animation: checkmark 0.5s cubic-bezier(0.65, 0, 0.45, 1);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
            
            // Form submission with loading state
            const signinForm = document.getElementById('signinForm');
            if (signinForm) {
                signinForm.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.classList.add('loading');
                        submitButton.disabled = true;
                        
                        // Simulate form validation
                        setTimeout(() => {
                            // Remove loading state after 2 seconds (in real app, this would be after AJAX response)
                            submitButton.classList.remove('loading');
                            submitButton.disabled = false;
                        }, 2000);
                    }
                });
            }
            
            // Social login buttons
            const socialButtons = document.querySelectorAll('.signin-form-section button[style*="padding: 0.75rem;"]');
            socialButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const originalIcon = icon.className;
                    
                    // Add loading animation
                    icon.className = 'fas fa-spinner fa-spin';
                    
                    // Simulate social login process
                    setTimeout(() => {
                        icon.className = originalIcon;
                        // In a real app, this would redirect to social login
                        alert('Social login would redirect to authentication provider.');
                    }, 1500);
                });
            });
            
            // Form input validation styling
            const formInputs = document.querySelectorAll('#signinForm input[type="email"], #signinForm input[type="password"]');
            formInputs.forEach(input => {
                // Add validation on blur
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.style.borderColor = '#ff4444';
                        this.style.boxShadow = '0 0 0 2px rgba(255, 68, 68, 0.2)';
                    } else {
                        this.style.borderColor = 'var(--border)';
                        this.style.boxShadow = 'none';
                    }
                });
                
                // Clear validation on input
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = 'var(--border)';
                        this.style.boxShadow = 'none';
                    }
                });
            });
            
            // Animate features grid on scroll
            const observerOptions = {
                threshold: 0.2,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, observerOptions);
            
            // Observe feature cards
            const featureCards = document.querySelectorAll('.signin-form-section div[style*="text-align: center; padding: 1.5rem;"]');
            featureCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease-out';
                observer.observe(card);
            });
            
            // Geometric pattern animation
            const pattern = document.querySelector('svg pattern');
            if (pattern) {
                let rotation = 0;
                setInterval(() => {
                    rotation = (rotation + 0.1) % 360;
                    pattern.style.transform = `rotate(${rotation}deg)`;
                }, 50);
            }
        });
    </script>
@endpush