# E-commerce Backend System

This repository contains the backend system for an e-commerce platform. Developed primarily in PHP, this project is designed to handle core functionalities and serve as the central data and logic hub for an e-commerce application, interacting with various frontend components (like the Flutter applications previously seen).

## Project Overview

The "ecommerce-backend" project provides the server-side logic and database interactions necessary for a complete e-commerce experience. It is structured to manage essential aspects of an online store, from user authentication to order processing.

## Technologies Used

  * **PHP**: The primary programming language used for developing the backend logic.
  * **SQL**: Used for database operations. While the specific database system is not explicitly stated, it is commonly used with **MySQL** in PHP projects.

## Key Features & Modules

The backend is structured into various modules to manage different aspects of the e-commerce platform:

  * **Authentication (`auth/`)**: Handles user registration, login, and session management.
  * **User Management (`address/`, `forgetpassword/`, `favorite/`)**: Manages user addresses, password recovery, and favorite items.
  * **Product Catalog (`categories/`, `items/`)**: Manages product categories and individual product listings.
  * **Shopping Cart (`cart/`)**: Manages items added to the user's shopping cart.
  * **Order Management (`orders/`)**: Processes and manages customer orders.
  * **Promotions (`coupon/`, `offers/`)**: Manages discount coupons and special offers.
  * **Delivery (`delivery/`)**: Likely handles delivery-related logic.
  * **Notifications (`notification.php`)**: For sending various system notifications.
  * **Admin Panel (`admin/`)**: Provides functionalities for administrative control over the e-commerce platform.
  * **Core Utilities**: Includes `connect.php` (database connection), `function.php` (common functions), and `home.php` (likely homepage data).

## Database Setup

This project uses SQL for database operations. You will need a relational database server, commonly **MySQL**, to run this backend.

1.  **Create a Database**: Set up an empty database on your MySQL server (or preferred SQL database).
2.  **Import Schema/Data**: The `view.sql` file might contain a database view definition. You will likely need to create tables and potentially import initial data. *Note: Full database schema (DDL) was not explicitly found; you may need to derive it from the PHP code or create it based on your application's needs.*
3.  **Configure Database Connection**: Update the database connection details in `connect.php` (or similar configuration file) with your database credentials (hostname, database name, username, password).

## Getting Started

To get this backend running, you'll need a web server with PHP support and a configured database.

### Prerequisites

  * **PHP**: Version 7.x or higher (ensure necessary extensions are enabled).
  * **Web Server**: Apache, Nginx, or similar.
  * **Database**: MySQL or compatible SQL database.

### Installation and Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/eslam281/ecommerce-backend.git
    cd ecommerce-backend
    ```
2.  **Configure Web Server**: Point your web server's document root to the project directory or set up a virtual host to serve the PHP files.
3.  **Database Configuration**: Follow the "Database Setup" steps above to set up and connect your database.

### Running the Application

Once your web server and database are configured, the PHP scripts will be accessible via your server's URL.

  * Access specific API endpoints (e.g., `http://your-server-ip/ecommerce-backend/auth/login.php`) through your web browser or API client.

## API Endpoints

The API endpoints are derived from the project's folder structure and PHP files. You will need to explore the `auth/`, `items/`, `orders/`, `cart/`, etc., directories and their respective PHP files to identify the exact endpoints and their required parameters.

## Contribution

We welcome contributions to this project. Please feel free to fork the repository, implement your changes, and submit a pull request.

## License

*(Please add the specific license under which this project is released, e.g., MIT, Apache 2.0. This information was not explicitly available from the repository's main page.)*
