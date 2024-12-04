# AnnaShop - Your Premium Shopping Destination

Welcome to AnnaShop, an e-commerce platform where quality meets affordability. This project is designed to provide a seamless shopping experience with features like product search, category browsing, discount management, and a user-friendly cart system.

## Features

- **Responsive Design**: Optimized for all devices with a mobile-first approach.
- **Product Search**: Easily search for products using the search bar.
- **Category Browsing**: Browse products by categories.
- **Discount Management**: Display discounts and calculate savings.
- **Cart System**: Add, remove, and update product quantities in the cart.
- **User Authentication**: Secure login and registration system.
- **Seller Dashboard**: Manage products and view sales data.
- **Customer Reviews**: Leave and view reviews for products.

## Technologies Used

- **Frontend**: HTML, Tailwind CSS, Blade Templates
- **Backend**: Laravel Framework
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Font Awesome

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/andiaisar/Anna-shop.git
    cd e-commerce-final
    ```

2. **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3. **Set up environment variables**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure the `.env` file** with your database and other credentials.

5. **Run migrations and seed the database**:
    ```bash
    php artisan migrate --seed
    ```

6. **Build the frontend assets**:
    ```bash
    npm run dev
    ```

7. **Start the development server**:
    ```bash
    php artisan serve
    ```

## Usage

- **Homepage**: View featured products and browse categories.
- **Product Detail**: View detailed information about a product, including images, price, and reviews.
- **Cart**: Add products to the cart, update quantities, and proceed to checkout.
- **User Authentication**: Register and log in to access the dashboard and manage orders.
- **Seller Dashboard**: Manage products, view sales data, and handle orders.

## Contributing

We welcome contributions to improve AnnaShop. Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m 'Add new feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or feedback, please contact us at support@annashop.com.

---

Thank you for using AnnaShop! We hope you have a great shopping experience.