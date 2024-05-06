# Shop

## Features

- **Authentication:** 
Authentication is managed using Laravel UI, with a custom design applied.
- **Custom Layout Design:**
The project features a custom admin layout design with a sidebar, navigation, footer, and pagination for improved user experience. Custom layouts are applied to index, edit, and create pages for brands and categories. Additionally, Laravel UI components are customized to match the overall project design.

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

## Requirements
- PHP: Version 8.0 or higher.
- Laravel 10.10
- MySQL
- Node.js and NPM
- Composer
- Apache

## License
This project is licensed under the MIT License.
