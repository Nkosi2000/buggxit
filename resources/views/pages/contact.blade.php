@extends('layouts.app')

@section('title', 'Contact Us | BUGGXIT Couture | Geometric Luxury Fashion')

@section('content')
    <!-- Hero Section -->
    <section class="contact-hero" style="position: relative; padding: 8rem 0 4rem; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h1 class="section-title" style="font-size: 3.5rem; margin-bottom: 1rem;">
                    Connect with <span class="accent">Precision</span>
                </h1>
                <p style="font-size: 1.2rem; color: var(--text-light); line-height: 1.8; max-width: 700px; margin: 0 auto 2rem;">
                    Our geometric approach extends to customer service. Reach out for inquiries, 
                    consultations, or collaborations. We respond with the same precision we design with.
                </p>
            </div>
        </div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(10,10,10,0.9) 0%, rgba(26,26,26,0.7) 100%); z-index: 1;"></div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; opacity: 0.3; z-index: 0;"></div>
    </section>

    <!-- Contact Grid -->
    <section class="contact-grid" style="padding: 6rem 0; background: var(--bg);">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                <!-- Contact Form -->
                <div>
                    <h2 style="font-family: 'Manrope', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 2rem;">
                        Send a <span class="accent">Message</span>
                    </h2>
                    
                    <form id="contactForm" style="background: var(--surface); padding: 2.5rem; border: 1px solid var(--border);">
                        @csrf
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 0.5rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                Name *
                            </label>
                            <input type="text" name="name" required style="width: 100%; padding: 1rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem; transition: all 0.3s;" placeholder="Your full name">
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 0.5rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                Email *
                            </label>
                            <input type="email" name="email" required style="width: 100%; padding: 1rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem; transition: all 0.3s;" placeholder="your.email@example.com">
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 0.5rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                Subject *
                            </label>
                            <select name="subject" required style="width: 100%; padding: 1rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem; transition: all 0.3s; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23b0b0b0' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px;">
                                <option value="" disabled selected>Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Support</option>
                                <option value="returns">Returns & Exchanges</option>
                                <option value="custom">Custom Design Inquiry</option>
                                <option value="wholesale">Wholesale & Partnerships</option>
                                <option value="press">Press & Media</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 2rem;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 0.5rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                Message *
                            </label>
                            <textarea name="message" required rows="6" style="width: 100%; padding: 1rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem; resize: vertical; transition: all 0.3s;" placeholder="Your message..."></textarea>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: flex; align-items: flex-start; color: var(--text-light); font-size: 0.9rem;">
                                <input type="checkbox" name="newsletter" style="margin-right: 0.75rem; margin-top: 0.25rem; accent-color: var(--accent);">
                                Subscribe to our newsletter for updates on new collections, exclusive offers, and geometric design insights.
                            </label>
                        </div>
                        
                        <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
                
                <!-- Contact Information -->
                <div>
                    <h2 style="font-family: 'Manrope', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 2rem;">
                        Contact <span class="accent">Information</span>
                    </h2>
                    
                    <div style="background: var(--surface); padding: 2.5rem; border: 1px solid var(--border); margin-bottom: 2rem;">
                        <div style="margin-bottom: 2rem;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div style="width: 50px; height: 50px; background: rgba(212, 175, 55, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-map-marker-alt" style="font-size: 1.2rem; color: var(--accent);"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem;">Atelier & Showroom</h3>
                                    <p style="color: var(--text-light); line-height: 1.6;">
                                        Via Monte Napoleone, 23<br>
                                        20121 Milano MI, Italy
                                    </p>
                                </div>
                            </div>
                            
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div style="width: 50px; height: 50px; background: rgba(212, 175, 55, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-phone" style="font-size: 1.2rem; color: var(--accent);"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem;">Phone & WhatsApp</h3>
                                    <p style="color: var(--text-light); line-height: 1.6;">
                                        +39 02 1234 5678<br>
                                        <span style="font-size: 0.9rem;">Mon-Fri: 9AM-6PM CET</span>
                                    </p>
                                </div>
                            </div>
                            
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div style="width: 50px; height: 50px; background: rgba(212, 175, 55, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-envelope" style="font-size: 1.2rem; color: var(--accent);"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem;">Email</h3>
                                    <p style="color: var(--text-light); line-height: 1.6;">
                                        info@buggxit.com<br>
                                        clientservices@buggxit.com
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem; color: var(--accent);">Response Time</h3>
                            <div style="background: var(--bg); padding: 1.5rem; border: 1px solid var(--border);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                    <span style="color: var(--text-light);">General Inquiries</span>
                                    <span style="font-weight: 600; color: var(--accent);">24-48 hours</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                    <span style="color: var(--text-light);">Order Support</span>
                                    <span style="font-weight: 600; color: var(--accent);">12-24 hours</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: var(--text-light);">Custom Design</span>
                                    <span style="font-weight: 600; color: var(--accent);">3-5 business days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div>
                        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1.5rem;">Connect Socially</h3>
                        <div style="display: flex; gap: 1rem;">
                            <a href="#" style="width: 50px; height: 50px; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                                <i class="fab fa-instagram" style="font-size: 1.2rem; color: var(--text);"></i>
                            </a>
                            <a href="#" style="width: 50px; height: 50px; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                                <i class="fab fa-facebook-f" style="font-size: 1.2rem; color: var(--text);"></i>
                            </a>
                            <a href="#" style="width: 50px; height: 50px; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                                <i class="fab fa-twitter" style="font-size: 1.2rem; color: var(--text);"></i>
                            </a>
                            <a href="#" style="width: 50px; height: 50px; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                                <i class="fab fa-linkedin-in" style="font-size: 1.2rem; color: var(--text);"></i>
                            </a>
                            <a href="#" style="width: 50px; height: 50px; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.borderColor='var(--accent)'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)';">
                                <i class="fab fa-pinterest" style="font-size: 1.2rem; color: var(--text);"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="contact-faq" style="padding: 6rem 0; background: var(--surface); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 3rem;">
                Frequently Asked <span class="accent">Questions</span>
            </h2>
            
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="faq-item" style="border-bottom: 1px solid var(--border); margin-bottom: 1rem;">
                    <button class="faq-question" style="width: 100%; text-align: left; background: none; border: none; padding: 1.5rem 0; color: var(--text); font-size: 1.1rem; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>What is your return and exchange policy?</span>
                        <i class="fas fa-chevron-down faq-icon" style="color: var(--accent); transition: transform 0.3s;"></i>
                    </button>
                    <div class="faq-answer" style="display: none; padding: 0 0 1.5rem 0; color: var(--text-light); line-height: 1.8;">
                        <p>We accept returns within 30 days of delivery for full-price items in their original condition with tags attached. Sale items are final sale. Exchanges are available for size or color within 14 days. All returns are processed within 5-7 business days after we receive your item.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border); margin-bottom: 1rem;">
                    <button class="faq-question" style="width: 100%; text-align: left; background: none; border: none; padding: 1.5rem 0; color: var(--text); font-size: 1.1rem; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>Do you offer custom sizing or alterations?</span>
                        <i class="fas fa-chevron-down faq-icon" style="color: var(--accent); transition: transform 0.3s;"></i>
                    </button>
                    <div class="faq-answer" style="display: none; padding: 0 0 1.5rem 0; color: var(--text-light); line-height: 1.8;">
                        <p>Yes, we offer complimentary basic alterations on all full-price items. For custom sizing beyond our standard range, we provide made-to-measure services starting at $500. Please contact our custom design team for a consultation.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border); margin-bottom: 1rem;">
                    <button class="faq-question" style="width: 100%; text-align: left; background: none; border: none; padding: 1.5rem 0; color: var(--text); font-size: 1.1rem; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>How can I track my order?</span>
                        <i class="fas fa-chevron-down faq-icon" style="color: var(--accent); transition: transform 0.3s;"></i>
                    </button>
                    <div class="faq-answer" style="display: none; padding: 0 0 1.5rem 0; color: var(--text-light); line-height: 1.8;">
                        <p>Once your order ships, you'll receive a tracking number via email. You can also track your order by logging into your account on our website and visiting the "Order History" section. For international orders, tracking updates may take 24-48 hours to appear.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border); margin-bottom: 1rem;">
                    <button class="faq-question" style="width: 100%; text-align: left; background: none; border: none; padding: 1.5rem 0; color: var(--text); font-size: 1.1rem; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>What shipping methods do you offer?</span>
                        <i class="fas fa-chevron-down faq-icon" style="color: var(--accent); transition: transform 0.3s;"></i>
                    </button>
                    <div class="faq-answer" style="display: none; padding: 0 0 1.5rem 0; color: var(--text-light); line-height: 1.8;">
                        <p>We offer express worldwide shipping via DHL and FedEx. Standard shipping (5-7 business days) is free on orders over $500. Express shipping (2-3 business days) is available for $35. For Milan residents, we offer same-day delivery within the city center.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border); margin-bottom: 1rem;">
                    <button class="faq-question" style="width: 100%; text-align: left; background: none; border: none; padding: 1.5rem 0; color: var(--text); font-size: 1.1rem; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>Do you have physical stores?</span>
                        <i class="fas fa-chevron-down faq-icon" style="color: var(--accent); transition: transform 0.3s;"></i>
                    </button>
                    <div class="faq-answer" style="display: none; padding: 0 0 1.5rem 0; color: var(--text-light); line-height: 1.8;">
                        <p>Our flagship atelier and showroom is located in Milan at Via Monte Napoleone, 23. We also have seasonal pop-up stores in major fashion capitals including Paris, New York, Tokyo, and Dubai. Check our Instagram for current pop-up locations and dates.</p>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <a href="{{ route('faqs') }}" class="btn btn-outline" style="padding: 1rem 2.5rem; font-size: 1rem;">
                    View All FAQs
                </a>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="contact-map" style="padding: 0; background: var(--bg);">
        <div style="height: 500px; width: 100%; position: relative;">
            <!-- This would be a Google Maps embed in production -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: var(--surface); display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 1rem;">
                <div style="font-size: 4rem; color: var(--accent);">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 600; text-align: center;">Via Monte Napoleone, 23<br>20121 Milano MI, Italy</h3>
                <p style="color: var(--text-light); text-align: center; max-width: 500px;">Our Milan atelier is open by appointment only. Please contact us to schedule a private viewing of our collections.</p>
                <button class="btn" style="padding: 1rem 2rem; margin-top: 1rem;" id="getDirections">
                    <i class="fas fa-directions"></i> Get Directions
                </button>
            </div>
            
            <!-- Map overlay with pattern -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url(\"data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23d4af37' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E\"); opacity: 0.5; pointer-events: none;"></div>
        </div>
    </section>

    <!-- Departments Section -->
    <section class="contact-departments" style="padding: 6rem 0; background: var(--surface);">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 3rem;">
                Contact by <span class="accent">Department</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div style="text-align: center; padding: 2rem; background: var(--bg); border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 0.75rem;">Customer Service</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem; line-height: 1.6;">
                        Orders, returns, exchanges, and general inquiries
                    </p>
                    <a href="mailto:customerservice@buggxit.com" style="color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                        customerservice@buggxit.com
                    </a>
                </div>
                
                <div style="text-align: center; padding: 2rem; background: var(--bg); border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-pencil-ruler"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 0.75rem;">Custom Design</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem; line-height: 1.6;">
                        Made-to-measure, bespoke commissions, and alterations
                    </p>
                    <a href="mailto:custom@buggxit.com" style="color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                        custom@buggxit.com
                    </a>
                </div>
                
                <div style="text-align: center; padding: 2rem; background: var(--bg); border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 0.75rem;">Wholesale & Partnerships</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem; line-height: 1.6;">
                        Retail partnerships, collaborations, and bulk orders
                    </p>
                    <a href="mailto:wholesale@buggxit.com" style="color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                        wholesale@buggxit.com
                    </a>
                </div>
                
                <div style="text-align: center; padding: 2rem; background: var(--bg); border: 1px solid var(--border); transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1.5rem;">
                        <i class="fas fa-microphone"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 0.75rem;">Press & Media</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem; line-height: 1.6;">
                        Editorial requests, press kits, and media inquiries
                    </p>
                    <a href="mailto:press@buggxit.com" style="color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                        press@buggxit.com
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="contact-cta" style="padding: 6rem 0; background: linear-gradient(135deg, var(--surface) 0%, var(--surface-light) 100%); border-top: 1px solid var(--border);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    Still Have <span class="accent">Questions</span>?
                </h2>
                <p style="color: var(--text-light); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2.5rem;">
                    Our geometric approach ensures precise and thoughtful responses. 
                    We're committed to providing exceptional service that matches the quality of our designs.
                </p>
                <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                    <a href="tel:+390212345678" class="btn" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        <i class="fas fa-phone" style="margin-right: 0.75rem;"></i> Call Us
                    </a>
                    <a href="{{ route('faqs') }}" class="btn btn-outline" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        View FAQ
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Form input focus states */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }
        
        /* Department cards hover effect */
        .contact-departments div[style*="text-align: center; padding: 2rem;"]:hover {
            transform: translateY(-10px);
            border-color: var(--accent) !important;
            box-shadow: var(--shadow);
        }
        
        /* FAQ animation */
        .faq-item.active .faq-question {
            color: var(--accent);
        }
        
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Custom select styling */
        select {
            cursor: pointer;
        }
        
        /* Social media hover */
        .contact-grid a[href*="fa-"]:hover {
            background: var(--accent) !important;
        }
        
        .contact-grid a[href*="fa-"]:hover i {
            color: var(--bg) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .contact-grid {
                grid-template-columns: 1fr !important;
            }
            
            .contact-departments div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr))"] {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        
        @media (max-width: 768px) {
            .contact-hero h1.section-title {
                font-size: 2.5rem;
            }
            
            .contact-grid form,
            .contact-grid > div:last-child > div:first-child {
                padding: 2rem !important;
            }
            
            .contact-departments div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr))"] {
                grid-template-columns: 1fr !important;
            }
            
            .contact-cta .btn {
                width: 100%;
                max-width: 300px;
            }
        }
        
        @media (max-width: 480px) {
            .contact-hero h1.section-title {
                font-size: 2rem;
            }
            
            .contact-grid form,
            .contact-grid > div:last-child > div:first-child {
                padding: 1.5rem !important;
            }
            
            .contact-faq button[style*="width: 100%; text-align: left;"] {
                font-size: 1rem !important;
                padding: 1.25rem 0 !important;
            }
            
            .contact-map div[style*="height: 500px;"] {
                height: 400px !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Form submission
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitButton.disabled = true;
            
            // In a real implementation, this would be an AJAX request
            setTimeout(function() {
                // Simulate successful submission
                submitButton.innerHTML = '<i class="fas fa-check"></i> Message Sent';
                submitButton.style.background = '#4CAF50';
                
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.style.background = 'rgba(76, 175, 80, 0.1)';
                successMessage.style.border = '1px solid #4CAF50';
                successMessage.style.color = '#4CAF50';
                successMessage.style.padding = '1rem';
                successMessage.style.marginTop = '1.5rem';
                successMessage.style.borderRadius = '4px';
                successMessage.innerHTML = `
                    <strong>Thank you for your message!</strong>
                    <p style="margin-top: 0.5rem; margin-bottom: 0; font-size: 0.9rem;">
                        We've received your inquiry and will respond within 24-48 hours.
                    </p>
                `;
                
                form.appendChild(successMessage);
                
                // Reset form after 5 seconds
                setTimeout(function() {
                    form.reset();
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                    submitButton.style.background = '';
                    successMessage.remove();
                }, 5000);
            }, 2000);
        });
        
        // FAQ Accordion
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const faqItem = this.closest('.faq-item');
                    const answer = faqItem.querySelector('.faq-answer');
                    const icon = this.querySelector('.faq-icon');
                    
                    // Close other open FAQ items
                    document.querySelectorAll('.faq-item').forEach(item => {
                        if (item !== faqItem && item.classList.contains('active')) {
                            item.classList.remove('active');
                            item.querySelector('.faq-answer').style.display = 'none';
                            item.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                        }
                    });
                    
                    // Toggle current FAQ item
                    faqItem.classList.toggle('active');
                    
                    if (faqItem.classList.contains('active')) {
                        answer.style.display = 'block';
                        icon.style.transform = 'rotate(180deg)';
                    } else {
                        answer.style.display = 'none';
                        icon.style.transform = 'rotate(0deg)';
                    }
                });
            });
            
            // Open first FAQ by default
            if (faqQuestions.length > 0) {
                faqQuestions[0].click();
            }
            
            // Get Directions button
            document.getElementById('getDirections')?.addEventListener('click', function() {
                const address = encodeURIComponent('Via Monte Napoleone, 23, 20121 Milano MI, Italy');
                window.open(`https://www.google.com/maps/search/?api=1&query=${address}`, '_blank');
            });
            
            // Form validation on input
            const formInputs = document.querySelectorAll('#contactForm input, #contactForm select, #contactForm textarea');
            formInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '' && this.hasAttribute('required')) {
                        this.style.borderColor = '#ff4444';
                    } else {
                        this.style.borderColor = 'var(--border)';
                    }
                });
                
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = 'var(--border)';
                    }
                });
            });
            
            // Department cards hover animation
            const departmentCards = document.querySelectorAll('.contact-departments div[style*="text-align: center; padding: 2rem;"]');
            departmentCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.style.transform = 'scale(1.2)';
                        icon.style.transition = 'transform 0.3s';
                    }
                });
                
                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.style.transform = 'scale(1)';
                    }
                });
            });
        });
    </script>
@endpush