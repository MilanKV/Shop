# Shop  (In Progress)

## Features

- **Authentication:** 
Authentication is managed using Laravel UI, with a custom design applied.
- **Custom Layout Design:**
The project features a custom admin layout design with a sidebar, navigation, footer, and pagination for improved user experience. Custom layouts are applied to index, edit, and create pages for brands and categories. Additionally, Laravel UI components are customized to match the overall project design.
- **CRUD Operations:**
  - **Products:** Create, delete, edit, update, and soft delete products. Soft-deleted products can be restored or permanently deleted.
  - **Brands:** Create, delete, edit, update, and soft delete brands. Soft-deleted brands can be restored or permanently deleted.
  - **Categories:** Create, delete, edit, update, and soft delete categories. Soft-deleted categories can be restored or permanently deleted.
  - **Subcategories:** Create, delete, edit, update, and soft delete subcategories. Soft-deleted subcategories can be restored or permanently deleted.
  - **Users:** Create, delete, edit, update, and soft delete user accounts. Soft-deleted users can be restored or permanently deleted.


## Installation

1. **Clone the Repository:**
   ```bash
   https://github.com/MilanKV/Shop.git
2. **Navigate to the Project Directory** 
    ```bash
    cd shop
3. **Navigate to the Project Directory** 
    ```bash
    composer install
4. **Copy Environment Configuration** 
- cp .env.example .env
5. **Generate Application Key** 
    ```bash
    php artisan key:generate
6. **Create Storage Symlink**
    ```bash
    php artisan storage:link
7. **Run Migrations and Seeders**
    ```bash
    php artisan migrate --seed
8. **Install Node.js Dependencies and Compile Assets**
   ```bash
   npm install && npm run dev
9. **Access the Application**
-  Start the Development Server
   ```bash
   php artisan serve
- Open your web browser and go to
   ```bash
   http://127.0.0.1:8000/
- **Email:** sadmin@gmail.com
- **Password:** 1234

## Usage
1. **Login or Register** 
- Use the provided authentication system to log in or register for a new account.
2. **Manage Brands, Categories, and Products**
- **Brands**
    - Create, Read, Update, and Delete (CRUD) operations for managing brands.
- **Categories**
    - CRUD operations for managing categories and subcategories.
- **Products**
    - Index and Delete operations for managing products.
## Requirements
- PHP: Version 8.0 or higher.
- Laravel 10.10
- MySQL
- Node.js and NPM
- Composer
- Apache

## Technology Stack

- **Frontend:**
  - Vue.js 3
  - Vuex
  - Axios
  - jQuery (used with Blade in the admin panel)

- **Backend:**
  - Laravel
  - PHP
  - MySQL
  - Blade for admin panel views

- **Development Tools:**
  - Node.js and NPM
  - Composer
  - Apache

## License
This project is licensed under the MIT License.
