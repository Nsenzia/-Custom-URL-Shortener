# Custom URL Shortener

A simple PHP and MySQL-based URL shortener that allows users to generate short links and redirect to the original URLs.

## Features
- Shorten long URLs into short, shareable links.
- Store shortened URLs in a MySQL database.
- Redirect users when they access a short URL.
- Prevent duplicate URL entries.

## Requirements
- PHP 7.4+
- MySQL Database
- Apache Server (or any server that supports PHP)

## Installation
### 1. Clone the Repository
```sh
 git clone https://github.com/yourusername/url-shortener.git
 cd url-shortener
```

### 2. Setup Database
Create a MySQL database and run the following SQL script:
```sql
CREATE DATABASE url_shortener;
USE url_shortener;
CREATE TABLE urls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    long_url TEXT NOT NULL,
    short_code VARCHAR(10) NOT NULL UNIQUE
);
```

### 3. Configure Database Connection
Edit `index.php` and update the database credentials:
```php
$host = "localhost";
$user = "root";
$pass = "";
$db = "url_shortener";
```

### 4. Run the Project
Place the files in your web server directory (e.g., `htdocs` for XAMPP) and start Apache & MySQL.

Visit: `http://localhost/url-shortener/`

## Usage
1. Enter a long URL in the input field.
2. Click the "Shorten" button.
3. Copy and use the generated short link.

## License


## Author
Ngungu Nsenzia Sichembe
