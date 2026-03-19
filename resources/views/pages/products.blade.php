@extends('layouts.app')

@section('title', 'Collections | BUGGXIT Couture | Geometric Luxury Fashion Collections')

@section('content')
    <!-- Hero Section -->
    <section class="collections-hero" style="position: relative; padding: 8rem 0 4rem; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h1 class="section-title" style="font-size: 3.5rem; margin-bottom: 1rem;">
                    Geometric <span class="accent">Collections</span>
                </h1>
                <p style="font-size: 1.2rem; color: var(--text-light); line-height: 1.8; max-width: 700px; margin: 0 auto 2rem;">
                    Explore our curated geometric luxury collections. Each piece represents 
                    architectural precision, innovative craftsmanship, and timeless design.
                </p>
            </div>
        </div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(10,10,10,0.9) 0%, rgba(26,26,26,0.7) 100%); z-index: 1;"></div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; opacity: 0.3; z-index: 0;"></div>
    </section>

    <!-- Collections Navigation -->
    <section class="collections-nav" style="padding: 3rem 0; background: var(--surface); border-bottom: 1px solid var(--border);">
        <div class="container">
            <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem;">
                <a href="#all-collections" class="collection-nav-btn active" style="padding: 1rem 2rem; background: var(--accent); color: var(--bg); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; transition: all 0.3s;">
                    All Collections
                </a>
                <a href="#apparel" class="collection-nav-btn" style="padding: 1rem 2rem; background: transparent; border: 1px solid var(--border); color: var(--text); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; transition: all 0.3s;">
                    Apparel
                </a>
                <a href="#accessories" class="collection-nav-btn" style="padding: 1rem 2rem; background: transparent; border: 1px solid var(--border); color: var(--text); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; transition: all 0.3s;">
                    Accessories
                </a>
                <a href="#signature" class="collection-nav-btn" style="padding: 1rem 2rem; background: transparent; border: 1px solid var(--border); color: var(--text); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; transition: all 0.3s;">
                    Signature Series
                </a>
                <a href="#archival" class="collection-nav-btn" style="padding: 1rem 2rem; background: transparent; border: 1px solid var(--border); color: var(--text); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; transition: all 0.3s;">
                    Archival Collection
                </a>
            </div>
        </div>
    </section>

    <!-- Collections Grid -->
    <section class="collections-grid" style="padding: 4rem 0; background: var(--bg);">
        <div class="container">
            <!-- All Collections Section -->
            <div class="collection-section active" id="all-collections">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
                    <h2 class="section-title" style="margin: 0;">
                        All <span class="accent">Collections</span>
                    </h2>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <span style="color: var(--text-light); font-size: 0.9rem;">Showing 128 products</span>
                        <select id="sortAll" style="padding: 0.75rem; background: var(--surface); border: 1px solid var(--border); color: var(--text); font-size: 0.9rem; min-width: 180px;">
                            <option value="featured">Sort by: Featured</option>
                            <option value="newest">Newest First</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="name">Name A-Z</option>
                        </select>
                    </div>
                </div>
                
                <div class="products-grid">
                    <!-- Product 1 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1558769132-cb1f3f5d5c75?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Blazer" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Blazers</div>
                            <h3 class="product-name">Hexagonal Tailored Blazer</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Italian wool with angular structure</p>
                            <div class="product-price">$1,850</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Dress" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Dresses</div>
                            <h3 class="product-name">Trapezoid Evening Gown</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Silk satin with geometric drape</p>
                            <div class="product-price">$2,400</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="product-card">
                        <div class="product-badge">Best Seller</div>
                        <img src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Trousers" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Trousers</div>
                            <h3 class="product-name">Angular Wide-Leg Pants</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Technical wool with precision pleating</p>
                            <div class="product-price">$950</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Top" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Tops</div>
                            <h3 class="product-name">Asymmetric Silk Blouse</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Hand-painted geometric pattern</p>
                            <div class="product-price">$650</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Jacket" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Outerwear</div>
                            <h3 class="product-name">Architectural Leather Jacket</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Matte black lambskin</p>
                            <div class="product-price">$2,800</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 6 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Skirt" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Skirts</div>
                            <h3 class="product-name">Triangular Midi Skirt</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Wool crepe with angular seams</p>
                            <div class="product-price">$750</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 7 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Bag" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Accessories</div>
                            <h3 class="product-name">Pentagon Clutch Bag</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Crocodile leather with gold hardware</p>
                            <div class="product-price">$2,200</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 8 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Shirt" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Shirts</div>
                            <h3 class="product-name">Structural Cotton Shirt</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Precision cut with geometric collar</p>
                            <div class="product-price">$450</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 9 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Suit" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Suits</div>
                            <h3 class="product-name">Angular Tailored Suit</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Two-piece suit with geometric lines</p>
                            <div class="product-price">$3,500</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 10 -->
                    <div class="product-card">
                        <div class="product-badge">Limited</div>
                        <img src="https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Jewelry" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Jewelry</div>
                            <h3 class="product-name">Rhombus Cuff Bracelet</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">18K gold with diamond accents</p>
                            <div class="product-price">$1,850</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 11 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Eyewear" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Eyewear</div>
                            <h3 class="product-name">Hexagonal Sunglasses</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Polarized lenses, titanium frame</p>
                            <div class="product-price">$650</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 12 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Jumpsuit" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Jumpsuits</div>
                            <h3 class="product-name">Asymmetric Jumpsuit</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Technical jersey with geometric cut</p>
                            <div class="product-price">$1,250</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="text-align: center; margin-top: 4rem;">
                    <button class="btn" style="padding: 1rem 3rem; font-size: 1.1rem;" id="loadMoreProducts">
                        Load More Products
                    </button>
                </div>
            </div>

            <!-- Apparel Section -->
            <div class="collection-section" id="apparel" style="display: none;">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2 class="section-title">
                        Apparel <span class="accent">Collections</span>
                    </h2>
                    <p style="color: var(--text-light); max-width: 600px; margin: 1rem auto 0;">
                        Geometric precision in wearable form. Explore our apparel collections featuring 
                        structured silhouettes, innovative fabrics, and architectural design.
                    </p>
                </div>
                
                <div class="products-grid">
                    <!-- Apparel products would go here -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1558769132-cb1f3f5d5c75?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Blazer" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Blazers</div>
                            <h3 class="product-name">Hexagonal Tailored Blazer</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Italian wool with angular structure</p>
                            <div class="product-price">$1,850</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More apparel products... -->
                </div>
            </div>

            <!-- Accessories Section -->
            <div class="collection-section" id="accessories" style="display: none;">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2 class="section-title">
                        Accessories <span class="accent">Collections</span>
                    </h2>
                    <p style="color: var(--text-light); max-width: 600px; margin: 1rem auto 0;">
                        The perfect geometric accents. Discover accessories designed to complement 
                        our apparel with precision craftsmanship and architectural elegance.
                    </p>
                </div>
                
                <div class="products-grid">
                    <!-- Accessory products would go here -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Geometric Jewelry" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Jewelry</div>
                            <h3 class="product-name">Rhombus Cuff Bracelet</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">18K gold with diamond accents</p>
                            <div class="product-price">$1,850</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More accessory products... -->
                </div>
            </div>

            <!-- Signature Series Section -->
            <div class="collection-section" id="signature" style="display: none;">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <div style="background: var(--accent); color: var(--bg); padding: 0.5rem 2rem; display: inline-block; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 1.5rem; font-size: 0.8rem;">
                        Signature Series
                    </div>
                    <h2 class="section-title">
                        Iconic <span class="accent">Designs</span>
                    </h2>
                    <p style="color: var(--text-light); max-width: 600px; margin: 1rem auto 0;">
                        Our most celebrated geometric designs. Each piece in the Signature Series 
                        represents a milestone in architectural fashion and innovative craftsmanship.
                    </p>
                </div>
                
                <div class="products-grid">
                    <!-- Signature products would go here -->
                    <div class="product-card">
                        <div class="product-badge" style="background: var(--accent);">Signature</div>
                        <img src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Signature Jacket" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Outerwear</div>
                            <h3 class="product-name">Architectural Leather Jacket</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Signature Series - Limited Edition</p>
                            <div class="product-price">$3,200</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More signature products... -->
                </div>
            </div>

            <!-- Archival Collection Section -->
            <div class="collection-section" id="archival" style="display: none;">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <div style="background: var(--surface-light); color: var(--accent); padding: 0.5rem 2rem; display: inline-block; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 1.5rem; font-size: 0.8rem; border: 1px solid var(--accent);">
                        Archival Collection
                    </div>
                    <h2 class="section-title">
                        Design <span class="accent">Heritage</span>
                    </h2>
                    <p style="color: var(--text-light); max-width: 600px; margin: 1rem auto 0;">
                        Rediscover iconic pieces from our design archives. The Archival Collection 
                        features limited reissues of our most influential geometric designs.
                    </p>
                </div>
                
                <div class="products-grid">
                    <!-- Archival products would go here -->
                    <div class="product-card">
                        <div class="product-badge" style="background: #8B4513;">Archival</div>
                        <img src="https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Archival Suit" class="product-img">
                        <div class="product-info">
                            <div class="product-category">Suits</div>
                            <h3 class="product-name">2018 Angular Tailored Suit</h3>
                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">Archival reissue - Limited stock</p>
                            <div class="product-price">$4,200</div>
                            <div class="product-actions">
                                <button class="btn">Add to Cart</button>
                                <button class="btn btn-outline">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More archival products... -->
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Collections -->
    <section class="featured-collections" style="padding: 6rem 0; background: var(--surface); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 3rem;">
                Featured <span class="accent">Collections</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <a href="#" class="collection-card" style="display: block; text-decoration: none; position: relative; overflow: hidden;">
                    <div style="position: relative; height: 400px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1558769132-cb1f3f5d5c75?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Symmetry Series" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, transparent 0%, rgba(10,10,10,0.9) 100%);"></div>
                        <div style="position: absolute; bottom: 0; left: 0; padding: 2rem; z-index: 2;">
                            <div style="color: var(--accent); font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; margin-bottom: 0.5rem;">Spring/Summer 2024</div>
                            <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Symmetry Series</h3>
                            <p style="color: var(--text-light); margin-bottom: 1rem;">Advanced geometric precision</p>
                            <div style="color: var(--accent); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; display: inline-flex; align-items: center;">
                                Explore <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="collection-card" style="display: block; text-decoration: none; position: relative; overflow: hidden;">
                    <div style="position: relative; height: 400px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Architectural Lines" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, transparent 0%, rgba(10,10,10,0.9) 100%);"></div>
                        <div style="position: absolute; bottom: 0; left: 0; padding: 2rem; z-index: 2;">
                            <div style="color: var(--accent); font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; margin-bottom: 0.5rem;">Fall/Winter 2023</div>
                            <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Architectural Lines</h3>
                            <p style="color: var(--text-light); margin-bottom: 1rem;">Bold structured silhouettes</p>
                            <div style="color: var(--accent); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; display: inline-flex; align-items: center;">
                                Explore <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="collection-card" style="display: block; text-decoration: none; position: relative; overflow: hidden;">
                    <div style="position: relative; height: 400px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Geometric Minimalism" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, transparent 0%, rgba(10,10,10,0.9) 100%);"></div>
                        <div style="position: absolute; bottom: 0; left: 0; padding: 2rem; z-index: 2;">
                            <div style="color: var(--accent); font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; margin-bottom: 0.5rem;">Capsule Collection</div>
                            <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Geometric Minimalism</h3>
                            <p style="color: var(--text-light); margin-bottom: 1rem;">Clean lines, subtle geometry</p>
                            <div style="color: var(--accent); text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; display: inline-flex; align-items: center;">
                                Explore <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Collection Categories -->
    <section class="collection-categories" style="padding: 6rem 0; background: var(--bg);">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 3rem;">
                Shop by <span class="accent">Category</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <a href="#" class="category-card" style="display: block; text-decoration: none; background: var(--surface); border: 1px solid var(--border); padding: 2rem; text-align: center; transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Blazers</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Structured outerwear</p>
                </a>
                
                <a href="#" class="category-card" style="display: block; text-decoration: none; background: var(--surface); border: 1px solid var(--border); padding: 2rem; text-align: center; transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-female"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Dresses</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Geometric eveningwear</p>
                </a>
                
                <a href="#" class="category-card" style="display: block; text-decoration: none; background: var(--surface); border: 1px solid var(--border); padding: 2rem; text-align: center; transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-vest"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Trousers</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Angular legwear</p>
                </a>
                
                <a href="#" class="category-card" style="display: block; text-decoration: none; background: var(--surface); border: 1px solid var(--border); padding: 2rem; text-align: center; transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Accessories</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Jewelry & bags</p>
                </a>
                
                <a href="#" class="category-card" style="display: block; text-decoration: none; background: var(--surface); border: 1px solid var(--border); padding: 2rem; text-align: center; transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-shoe-prints"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Footwear</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Architectural shoes</p>
                </a>
                
                <a href="#" class="category-card" style="display: block; text-decoration: none; background: var(--surface); border: 1px solid var(--border); padding: 2rem; text-align: center; transition: all 0.3s;">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-glasses"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Eyewear</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Geometric frames</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="collections-newsletter" style="padding: 6rem 0; background: linear-gradient(135deg, var(--surface) 0%, var(--surface-light) 100%); border-top: 1px solid var(--border);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto;">
                <h2 style="font-family: 'Manrope', sans-serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                    Discover New <span class="accent">Geometric</span> Designs
                </h2>
                <p style="color: var(--text-light); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2.5rem;">
                    Be the first to know about new collections, exclusive releases, and special 
                    offers. Join our community of geometric fashion enthusiasts.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <div style="flex: 1; max-width: 400px;">
                        <input type="email" placeholder="Enter your email address" style="width: 100%; padding: 1rem 1.5rem; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-size: 1rem;">
                    </div>
                    <button class="btn" style="padding: 1rem 2.5rem; font-size: 1rem;">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="collections-cta" style="padding: 4rem 0; background: var(--bg);">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem; align-items: center;">
                <div>
                    <h2 style="font-family: 'Manrope', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">
                        Need Help Choosing?
                    </h2>
                    <p style="color: var(--text-light); line-height: 1.8; margin-bottom: 2rem;">
                        Our geometric fashion specialists are available to help you find the perfect 
                        pieces for your collection. Schedule a virtual consultation or visit our 
                        Milan atelier.
                    </p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="{{ route('contact') }}" class="btn" style="padding: 1rem 2.5rem; font-size: 1rem;">
                            Book Consultation
                        </a>
                        <a href="{{ route('sales') }}" class="btn btn-outline" style="padding: 1rem 2.5rem; font-size: 1rem;">
                            View Sale Items
                        </a>
                    </div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 8rem; color: var(--accent); opacity: 0.7;">
                        <i class="fas fa-shapes"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Collection navigation active state */
        .collection-nav-btn.active {
            background: var(--accent) !important;
            color: var(--bg) !important;
            border-color: var(--accent) !important;
        }
        
        .collection-nav-btn:hover:not(.active) {
            border-color: var(--accent);
            color: var(--accent);
        }
        
        /* Collection card hover */
        .collection-card:hover img {
            transform: scale(1.05);
        }
        
        /* Category card hover */
        .category-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent) !important;
            box-shadow: var(--shadow);
        }
        
        .category-card:hover i {
            transform: scale(1.2);
            transition: transform 0.3s;
        }
        
        /* Collection section transitions */
        .collection-section {
            transition: opacity 0.3s ease;
        }
        
        /* Featured collection hover animation */
        .featured-collections a:hover div[style*="color: var(--accent); text-decoration: none;"] {
            padding-left: 10px;
            transition: padding-left 0.3s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .collections-nav {
                overflow-x: auto;
                padding-bottom: 1.5rem;
            }
            
            .collections-nav div[style*="display: flex; justify-content: center;"] {
                justify-content: flex-start;
                flex-wrap: nowrap;
                padding-bottom: 0.5rem;
            }
            
            .collection-categories div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))"] {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .collections-hero h1.section-title {
                font-size: 2.5rem;
            }
            
            .collections-grid div[style*="display: flex; justify-content: space-between;"] {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }
            
            .featured-collections div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr))"] {
                grid-template-columns: 1fr;
            }
            
            .collection-categories div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))"] {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .collections-newsletter div[style*="display: flex; gap: 1rem; justify-content: center;"] {
                flex-direction: column;
                align-items: center;
            }
            
            .collections-newsletter div[style*="flex: 1; max-width: 400px;"] {
                max-width: 100% !important;
                width: 100%;
            }
            
            .collections-cta div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr))"] {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .collections-hero h1.section-title {
                font-size: 2rem;
            }
            
            .collection-nav-btn {
                padding: 0.75rem 1.5rem !important;
                font-size: 0.8rem !important;
            }
            
            .collection-categories div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))"] {
                grid-template-columns: 1fr;
            }
            
            .category-card {
                padding: 1.5rem !important;
            }
            
            .featured-collections div[style*="position: relative; height: 400px;"] {
                height: 300px !important;
            }
            
            .collections-cta .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Collection navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navButtons = document.querySelectorAll('.collection-nav-btn');
            const collectionSections = document.querySelectorAll('.collection-section');
            const loadMoreBtn = document.getElementById('loadMoreProducts');
            const sortSelect = document.getElementById('sortAll');
            
            // Navigation functionality
            navButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all buttons
                    navButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Get target section ID
                    const targetId = this.getAttribute('href').substring(1);
                    
                    // Hide all sections
                    collectionSections.forEach(section => {
                        section.style.display = 'none';
                    });
                    
                    // Show target section
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.style.display = 'block';
                        
                        // Smooth scroll to section
                        window.scrollTo({
                            top: targetSection.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Load more functionality
            loadMoreBtn.addEventListener('click', function() {
                const button = this;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                button.disabled = true;
                
                // Simulate loading delay
                setTimeout(function() {
                    // In a real implementation, this would load more products via AJAX
                    button.innerHTML = 'All Products Loaded';
                    button.style.opacity = '0.5';
                    button.style.cursor = 'not-allowed';
                    
                    // Show a message
                    const message = document.createElement('div');
                    message.style.textAlign = 'center';
                    message.style.marginTop = '1rem';
                    message.style.color = 'var(--text-light)';
                    message.innerHTML = 'You\'ve reached the end of our collections.';
                    button.parentNode.appendChild(message);
                }, 1500);
            });
            
            // Sort functionality
            sortSelect.addEventListener('change', function() {
                const sortValue = this.value;
                const activeSection = document.querySelector('.collection-section[style*="display: block"]');
                
                if (!activeSection) return;
                
                const container = activeSection.querySelector('.products-grid');
                const cards = Array.from(container.querySelectorAll('.product-card'));
                
                // Sort based on selected value
                cards.sort((a, b) => {
                    if (sortValue === 'featured') {
                        // Featured items might have badges
                        const aBadge = a.querySelector('.product-badge');
                        const bBadge = b.querySelector('.product-badge');
                        
                        if (aBadge && !bBadge) return -1;
                        if (!aBadge && bBadge) return 1;
                        return 0;
                    } else if (sortValue === 'newest') {
                        // In a real implementation, this would use actual date data
                        return 0;
                    } else if (sortValue === 'price-low') {
                        const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('$', '').replace(',', ''));
                        const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('$', '').replace(',', ''));
                        return priceA - priceB;
                    } else if (sortValue === 'price-high') {
                        const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('$', '').replace(',', ''));
                        const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('$', '').replace(',', ''));
                        return priceB - priceA;
                    } else if (sortValue === 'name') {
                        const nameA = a.querySelector('.product-name').textContent.toLowerCase();
                        const nameB = b.querySelector('.product-name').textContent.toLowerCase();
                        return nameA.localeCompare(nameB);
                    }
                    return 0;
                });
                
                // Reorder the DOM
                cards.forEach(card => {
                    container.appendChild(card);
                });
                
                // Show notification
                showNotification(`Sorted by: ${this.options[this.selectedIndex].text}`);
            });
            
            // Collection card hover effects
            const collectionCards = document.querySelectorAll('.collection-card');
            collectionCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const img = this.querySelector('img');
                    const arrow = this.querySelector('.fa-arrow-right');
                    
                    if (img) img.style.transform = 'scale(1.05)';
                    if (arrow) arrow.style.transform = 'translateX(5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    const img = this.querySelector('img');
                    const arrow = this.querySelector('.fa-arrow-right');
                    
                    if (img) img.style.transform = 'scale(1)';
                    if (arrow) arrow.style.transform = 'translateX(0)';
                });
            });
            
            // Category card hover effects
            const categoryCards = document.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.style.transform = 'scale(1.2)';
                    }
                });
                
                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.style.transform = 'scale(1)';
                    }
                });
            });
            
            // Newsletter subscription
            const newsletterInput = document.querySelector('.collections-newsletter input[type="email"]');
            const newsletterBtn = document.querySelector('.collections-newsletter .btn');
            
            newsletterBtn.addEventListener('click', function() {
                const email = newsletterInput.value.trim();
                
                if (!email || !isValidEmail(email)) {
                    newsletterInput.style.borderColor = '#ff4444';
                    newsletterInput.focus();
                    return;
                }
                
                // In a real implementation, this would submit to your backend
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-check"></i> Subscribed!';
                    this.style.background = '#4CAF50';
                    newsletterInput.value = '';
                    newsletterInput.style.borderColor = 'var(--border)';
                    
                    // Reset after 3 seconds
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                        this.style.background = '';
                    }, 3000);
                }, 1500);
            });
            
            // Helper functions
            function showNotification(message) {
                // Create notification
                const notification = document.createElement('div');
                notification.style.position = 'fixed';
                notification.style.top = '100px';
                notification.style.right = '20px';
                notification.style.background = 'var(--surface)';
                notification.style.border = '1px solid var(--accent)';
                notification.style.padding = '1rem 1.5rem';
                notification.style.borderRadius = '4px';
                notification.style.boxShadow = 'var(--shadow)';
                notification.style.zIndex = '9999';
                notification.style.transform = 'translateX(100%)';
                notification.style.transition = 'transform 0.3s';
                notification.innerHTML = message;
                
                document.body.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 10);
                
                // Remove after 3 seconds
                setTimeout(() => {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            }
            
            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            // Add to cart functionality
            const addToCartBtns = document.querySelectorAll('.product-card .btn:not(.btn-outline)');
            
            addToCartBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const productCard = this.closest('.product-card');
                    const productName = productCard.querySelector('.product-name').textContent;
                    const productPrice = productCard.querySelector('.product-price').textContent;
                    
                    // Update cart count
                    const cartCount = document.querySelector('.cart-count');
                    let currentCount = parseInt(cartCount.textContent);
                    cartCount.textContent = currentCount + 1;
                    
                    // Show success message
                    const message = `Added "${productName}" (${productPrice}) to cart`;
                    showNotification(message);
                    
                    // In a real implementation, you would make an AJAX request to add to cart
                });
            });
            
            // Wishlist functionality
            const wishlistBtns = document.querySelectorAll('.btn-outline .fa-heart');
            wishlistBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const productCard = this.closest('.product-card');
                    const productName = productCard.querySelector('.product-name').textContent;
                    
                    // Toggle heart icon
                    if (this.classList.contains('far')) {
                        this.classList.remove('far');
                        this.classList.add('fas');
                        this.style.color = 'var(--accent)';
                        showNotification(`Added "${productName}" to wishlist`);
                    } else {
                        this.classList.remove('fas');
                        this.classList.add('far');
                        this.style.color = '';
                        showNotification(`Removed "${productName}" from wishlist`);
                    }
                });
            });
        });
    </script>
@endpush