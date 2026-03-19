@extends('layouts.app')

@section('title', 'About BUGGXIT | Geometric Luxury Fashion')

@section('content')
    <!-- Hero Section -->
    <section class="about-hero" style="position: relative; padding: 8rem 0 6rem; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h1 class="section-title" style="font-size: 3.5rem; margin-bottom: 1.5rem;">
                    Redefining <span class="accent">Geometric</span> Elegance
                </h1>
                <p style="font-size: 1.2rem; color: var(--text-light); line-height: 1.8; max-width: 700px; margin: 0 auto;">
                    At BUGGXIT Couture, we transform sharp angles and precise lines into wearable art. 
                    Since 2018, we've been challenging conventional fashion with our geometric luxury collections.
                </p>
            </div>
        </div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(10,10,10,0.9) 0%, rgba(26,26,26,0.7) 100%); z-index: 1;"></div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; opacity: 0.3; z-index: 0;"></div>
    </section>

    <!-- Story Section -->
    <section class="about-story" style="padding: 6rem 0; background: var(--surface);">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 4rem; align-items: center;">
                <div>
                    <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                        Our <span class="accent">Origin</span> Story
                    </h2>
                    <div style="color: var(--text-light); line-height: 1.8;">
                        <p style="margin-bottom: 1.5rem;">
                            Founded by visionary designer Alexei Volkov, BUGGXIT emerged from a fascination with 
                            architectural forms and their intersection with human movement. What began as a 
                            graduate thesis project has evolved into a globally recognized luxury brand.
                        </p>
                        <p style="margin-bottom: 1.5rem;">
                            The name "BUGGXIT" derives from the concept of "breaking out of the box" – 
                            challenging traditional fashion norms through angular precision and mathematical elegance.
                        </p>
                        <p>
                            Each collection is meticulously crafted, combining advanced tailoring techniques 
                            with innovative materials to create pieces that are both structurally remarkable 
                            and surprisingly comfortable.
                        </p>
                    </div>
                </div>
                <div style="position: relative;">
                    <div style="border: 2px solid var(--accent); padding: 1.5rem; position: relative; z-index: 2;">
                        <div style="width: 100%; height: 400px; background: var(--bg); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <div style="font-size: 8rem; color: var(--accent); opacity: 0.7; transform: rotate(45deg);">
                                <i class="fas fa-gem"></i>
                            </div>
                        </div>
                    </div>
                    <div style="position: absolute; top: -20px; left: -20px; width: 100%; height: 100%; border: 2px solid var(--border); z-index: 1;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section class="about-philosophy" style="padding: 6rem 0; background: var(--bg);">
        <div class="container">
            <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 3rem;">
                Our Design <span class="accent">Philosophy</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <div style="background: var(--surface); padding: 2.5rem; border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Precision Geometry</h3>
                    <p style="color: var(--text-light); line-height: 1.6;">
                        Every angle is calculated, every line intentional. We believe clothing should have the 
                        mathematical precision of architecture.
                    </p>
                </div>
                
                <div style="background: var(--surface); padding: 2.5rem; border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Sustainable Luxury</h3>
                    <p style="color: var(--text-light); line-height: 1.6;">
                        We source only ethical materials and implement zero-waste patterns. Luxury shouldn't 
                        come at the expense of our planet.
                    </p>
                </div>
                
                <div style="background: var(--surface); padding: 2.5rem; border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-hands"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Artisan Craft</h3>
                    <p style="color: var(--text-light); line-height: 1.6;">
                        Each piece is hand-finished by master tailors with decades of experience. Traditional 
                        techniques meet futuristic design.
                    </p>
                </div>
                
                <div style="background: var(--surface); padding: 2.5rem; border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Timeless Innovation</h3>
                    <p style="color: var(--text-light); line-height: 1.6;">
                        We create pieces that defy trends. Our geometric designs remain relevant through seasons, 
                        becoming heirlooms of the future.
                    </p>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <p style="font-style: italic; color: var(--text-light); max-width: 800px; margin: 0 auto; font-size: 1.2rem; line-height: 1.8;">
                    "Fashion is architecture: it is a matter of proportions. At BUGGXIT, we build clothing 
                    that becomes a second skin of structured beauty."
                </p>
                <p style="color: var(--accent); margin-top: 1rem; font-weight: 600;">— Alexei Volkov, Founder & Creative Director</p>
            </div>
        </div>
    </section>

    <!-- Craftsmanship Section -->
    <section class="about-craft" style="padding: 6rem 0; background: var(--surface);">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 4rem; align-items: center;">
                <div style="order: 2;">
                    <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                        The <span class="accent">Craftsmanship</span>
                    </h2>
                    <div style="color: var(--text-light); line-height: 1.8;">
                        <p style="margin-bottom: 1.5rem;">
                            Every BUGGXIT garment undergoes 127 precise steps from concept to completion. 
                            Our atelier in Milan houses state-of-the-art laser cutting technology alongside 
                            traditional tailoring stations.
                        </p>
                        <ul style="list-style: none; margin-bottom: 2rem;">
                            <li style="margin-bottom: 1rem; display: flex; align-items: flex-start;">
                                <span style="color: var(--accent); margin-right: 10px; font-weight: bold;">✓</span>
                                <span>Italian wool and Japanese technical fabrics</span>
                            </li>
                            <li style="margin-bottom: 1rem; display: flex; align-items: flex-start;">
                                <span style="color: var(--accent); margin-right: 10px; font-weight: bold;">✓</span>
                                <span>Laser precision cutting for perfect geometry</span>
                            </li>
                            <li style="margin-bottom: 1rem; display: flex; align-items: flex-start;">
                                <span style="color: var(--accent); margin-right: 10px; font-weight: bold;">✓</span>
                                <span>Hand-finished seams and edges</span>
                            </li>
                            <li style="margin-bottom: 1rem; display: flex; align-items: flex-start;">
                                <span style="color: var(--accent); margin-right: 10px; font-weight: bold;">✓</span>
                                <span>48-hour quality inspection for each piece</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="order: 1;">
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                        <div style="grid-column: span 1; grid-row: span 2;">
                            <div style="height: 300px; background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center;">
                                <div style="font-size: 4rem; color: var(--accent); opacity: 0.7;">
                                    <i class="fas fa-ruler-combined"></i>
                                </div>
                            </div>
                        </div>
                        <div style="grid-column: span 1;">
                            <div style="height: 140px; background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center;">
                                <div style="font-size: 2rem; color: var(--accent); opacity: 0.7;">
                                    <i class="fas fa-cut"></i>
                                </div>
                            </div>
                        </div>
                        <div style="grid-column: span 1;">
                            <div style="height: 140px; background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center;">
                                <div style="font-size: 2rem; color: var(--accent); opacity: 0.7;">
                                    <i class="fas fa-seedling"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="about-values" style="padding: 6rem 0; background: var(--bg);">
        <div class="container">
            <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 3rem;">
                Our <span class="accent">Commitments</span>
            </h2>
            
            <div style="max-width: 1000px; margin: 0 auto;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    <div style="text-align: center; padding: 2rem;">
                        <div style="width: 80px; height: 80px; background: var(--surface); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; border: 2px solid var(--accent);">
                            <span style="font-size: 2rem; color: var(--accent);">01</span>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Ethical Production</h3>
                        <p style="color: var(--text-light); line-height: 1.6;">
                            We maintain direct relationships with all our suppliers and ensure fair wages 
                            and safe working conditions throughout our supply chain.
                        </p>
                    </div>
                    
                    <div style="text-align: center; padding: 2rem;">
                        <div style="width: 80px; height: 80px; background: var(--surface); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; border: 2px solid var(--accent);">
                            <span style="font-size: 2rem; color: var(--accent);">02</span>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Zero Waste Initiative</h3>
                        <p style="color: var(--text-light); line-height: 1.6;">
                            Our pattern-making is engineered to minimize fabric waste. Remaining materials 
                            are repurposed into accessories or donated to design schools.
                        </p>
                    </div>
                    
                    <div style="text-align: center; padding: 2rem;">
                        <div style="width: 80px; height: 80px; background: var(--surface); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; border: 2px solid var(--accent);">
                            <span style="font-size: 2rem; color: var(--accent);">03</span>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Lifetime Care</h3>
                        <p style="color: var(--text-light); line-height: 1.6;">
                            Every BUGGXIT piece comes with complimentary lifetime alterations and repair 
                            services because we believe true luxury is designed to last.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="about-cta" style="padding: 6rem 0; background: linear-gradient(135deg, var(--surface) 0%, var(--surface-light) 100%); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    Experience <span class="accent">Geometric</span> Luxury
                </h2>
                <p style="color: var(--text-light); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2.5rem;">
                    Join thousands who have transformed their wardrobe with architectural elegance. 
                    Explore our collections and discover why precision never goes out of style.
                </p>
                <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('products') }}" class="btn" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        Explore Collections
                    </a>
                    <a href="{{ route('newarrival') }}" class="btn btn-outline" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        View New Arrivals
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="about-stats" style="padding: 4rem 0; background: var(--bg);">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; text-align: center;">
                <div>
                    <h3 style="font-size: 3rem; font-weight: 700; color: var(--accent); margin-bottom: 0.5rem;">2018</h3>
                    <p style="color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">Year Founded</p>
                </div>
                <div>
                    <h3 style="font-size: 3rem; font-weight: 700; color: var(--accent); margin-bottom: 0.5rem;">42+</h3>
                    <p style="color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">Countries Served</p>
                </div>
                <div>
                    <h3 style="font-size: 3rem; font-weight: 700; color: var(--accent); margin-bottom: 0.5rem;">127</h3>
                    <p style="color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">Crafting Steps</p>
                </div>
                <div>
                    <h3 style="font-size: 3rem; font-weight: 700; color: var(--accent); margin-bottom: 0.5rem;">98%</h3>
                    <p style="color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">Recycled Materials</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Animation for philosophy cards */
        .about-philosophy div[style*="background: var(--surface); padding: 2.5rem"]:hover {
            transform: translateY(-10px);
            border-color: var(--accent);
            box-shadow: var(--shadow);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .about-hero h1.section-title {
                font-size: 2.5rem;
            }
            
            .about-story,
            .about-philosophy,
            .about-craft,
            .about-values,
            .about-cta {
                padding: 4rem 0;
            }
            
            .about-cta .btn {
                width: 100%;
                max-width: 300px;
            }
            
            .about-craft div[style*="order: 1"] {
                order: 2 !important;
            }
            
            .about-craft div[style*="order: 2"] {
                order: 1 !important;
            }
        }
        
        @media (max-width: 480px) {
            .about-hero h1.section-title {
                font-size: 2rem;
            }
            
            .about-philosophy h2,
            .about-values h2,
            .about-craft h2,
            .about-story h2 {
                font-size: 2rem;
            }
            
            .about-stats h3 {
                font-size: 2.5rem;
            }
        }
    </style>
@endpush