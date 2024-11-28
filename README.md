# Food Order Website

This project is a simple Food Ordering System designed for a restaurant, enabling users to browse food items, place orders, and manage categories and items through an admin panel. It is built using PHP and MySQL for backend processing, with a responsive user interface crafted using HTML and CSS.

## Features

### User Features:

- Browse Foods: Users can browse a variety of food items categorized by type.
- Order Food: Users can add food items to their orders and submit their requests. The order information is saved in a database for administrative processing.
- Responsive UI: The website adapts to different screen sizes, ensuring a smooth user experience on both mobile and desktop devices.

### Admin Features:

- Manage Categories: Admins can add, update, or delete food categories (e.g., Desserts, Main Dishes, Drinks).
- Manage Foods: Admins can add, update, or delete food items, complete with price and description.
- View Orders: Admins can view customer orders placed through the website and manage the status of the orders.

### Tech Stack

- Front-end: HTML5, CSS3, Bootstrap for styling and responsiveness.
- Back-end: PHP for server-side scripting.
- Database: MySQL for managing categories, food items, and customer orders.
- Local Development: XAMPP (Apache, MySQL, PHP, and Perl).

### Folder Structure:

- admin/: Contains all the admin-related pages for managing food, categories, and orders.
- css/: Stylesheets for the website.
- images/: Contains placeholder images for food categories and items.
- config/: Configuration files, including the database connection file.
- db/: Contains the SQL file for database setup.
- partials/: Header and footer templates for the website.

## Usage

### Adding a Category:

- Log into the admin panel (http://localhost/FoodOrder/admin/login.php).
- Navigate to the Manage Categories section.
- Use the "Add Category" button to create a new category by uploading an image and entering the category name.

### Adding a Food Item:

- In the admin panel, go to the Manage Foods section.
- Use the "Add Food" button to input the details (name, description, price) and assign the food to a category.

### Managing Orders:

- Orders placed by customers will appear in the Manage Orders section of the admin panel.
- Admins can update the order status (e.g., Delivered, Canceled).

## Screenshots

### Home Page:

### Admin Dashboard:
