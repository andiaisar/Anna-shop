@extends('customer.layouts.layout')

@section('customer_page_title', 'Customer Page')
@section('styles')
<!-- Inline CSS -->
<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: auto;
    }

    .header {
        background: #4CAF50;
        color: white;
        padding: 10px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 1.5em;
    }

    .logo span {
        color: #FFD700;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
    }

    .navbar a:hover {
        text-decoration: underline;
    }

    .hero {
        background: url('/images/hero.jpg') no-repeat center center/cover;
        color: white;
        text-align: center;
        padding: 100px 20px;
    }

    .hero .btn {
        background: #FFD700;
        color: #333;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    .hero .btn:hover {
        background: #FFC107;
    }

    .categories, .products {
        padding: 50px 0;
    }

    .category-grid, .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
        padding: 10px;
    }

    .product-card img {
        width: 100%;
        border-bottom: 1px solid #ddd;
        margin-bottom: 10px;
    }

    .footer {
        background: #333;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 20px;
    }

    .footer .socials li {
        display: inline;
        margin: 0 10px;
    }

    .footer .socials a {
        color: #FFD700;
        text-decoration: none;
    }
</style>
@endsection
@section('customer-layout')
<div class="container">
    <h3>Customer Page</h3>

    <section class="categories" id="categories">
        <div class="container">
            <h2>Shop by Categories</h2>
            <div class="category-grid">
                <div class="category">
                    <img src="electronics.jpg" alt="Electronics">
                    <h3>Electronics</h3>
                </div>
                <div class="category">
                    <img src="fashion.jpg" alt="Fashion">
                    <h3>Fashion</h3>
                </div>
                <div class="category">
                    <img src="home.jpg" alt="Home & Living">
                    <h3>Home & Living</h3>
                </div>
                <div class="category">
                    <img src="sports.jpg" alt="Sports">
                    <h3>Sports</h3>
                </div>
            </div>
        </div>
    </section>


    <section class="products" id="products">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="product1.jpg" alt="Product 1">
                    <h3>Product Name</h3>
                    <p>$49.99</p>
                    <a href="#" class="btn">Add to Cart</a>
                </div>
                <div class="product-card">
                    <img src="product2.jpg" alt="Product 2">
                    <h3>Product Name</h3>
                    <p>$79.99</p>
                    <a href="#" class="btn">Add to Cart</a>
                </div>
                <div class="product-card">
                    <img src="product3.jpg" alt="Product 3">
                    <h3>Product Name</h3>
                    <p>$29.99</p>
                    <a href="#" class="btn">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
