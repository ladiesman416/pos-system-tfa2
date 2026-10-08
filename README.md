# POS System (TFA2): From Arrays to a Real Database

A Point-of-Sale (POS) website built with CodeIgniter 4. This version replaces the static PHP arrays from TFA1 with a real MySQL database. Customer and user records are now retrieved through CodeIgniter Models using Query Builder.

## Course Information

- **Course:** IT0049 – Web System Technologies
- **Activity:** Technical Formative Assessment 2 – From Arrays to a Real Database
- **Student:** Kyle Rianne Andrei Dionio (individual submission)
- **Section:** TC33
- **Professor:** Von Erick Magbitang
- **GitHub:** [ladiesman416/pos-system-tfa2](https://github.com/ladiesman416/pos-system-tfa2)
- **Previous activity (TFA1):** [ladiesman416/pos-system-tfa1](https://github.com/ladiesman416/pos-system-tfa1)
- **Live Demo:** ADD-YOUR-LIVE-LINK-HERE

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Pages and Routes](#pages-and-routes)
- [Database](#database)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Setup and Run](#setup-and-run)
- [How It Works (MVC)](#how-it-works-mvc)

## Overview

This project extends the TFA1 POS application. The only thing that changed is where the data comes from: the Customer Accounts and User Accounts controllers now call a Model's `findAll()` method instead of building a static array, and the views display the results exactly as before.

## Features

- Four working pages with a shared navigation bar
- MySQL database with `customers` and `users` tables
- `CustomerModel` and `UserModel` built on CodeIgniter's `Model` class
- Records retrieved with Query Builder (`findAll()`), with no raw SQL in the application code
- Shared layout view (`layout.php`) reused by every page
- Output escaped with CodeIgniter's `esc()` helper
- Database export included in `database/pos_tfa2.sql`

## Pages and Routes

| URL          | Route Target       | Description                                |
|--------------|--------------------|--------------------------------------------|
| `/`          | `Pages::index`     | Landing page                               |
| `/about`     | `Pages::about`     | About page describing the project          |
| `/customers` | `Customers::index` | Customer Accounts: full name, email, phone |
| `/users`     | `Users::index`     | User Accounts: username, full name         |

## Database

Database name: `pos_tfa2`

**customers**

| Column       | Type         | Notes                       |
|--------------|--------------|-----------------------------|
| `id`         | INT          | Primary key, auto-increment |
| `full_name`  | VARCHAR(100) | Required                    |
| `email`      | VARCHAR(100) | Required                    |
| `phone`      | VARCHAR(20)  | Optional                    |
| `created_at` | DATETIME     | Required                    |

**users**

| Column       | Type         | Notes                       |
|--------------|--------------|-----------------------------|
| `id`         | INT          | Primary key, auto-increment |
| `username`   | VARCHAR(50)  | Required, unique            |
| `full_name`  | VARCHAR(100) | Required                    |
| `created_at` | DATETIME     | Required                    |

Each table contains 5 sample records. The full export is in [`database/pos_tfa2.sql`](database/pos_tfa2.sql).

## Tech Stack

- PHP 8.1 or higher
- CodeIgniter 4 (installed through Composer)
- MySQL (via XAMPP / phpMyAdmin)
- HTML / CSS for the views
- Composer for dependency management

## Project Structure

Only the files relevant to this activity are listed:

```text
pos-system-tfa2/
├── app/
│   ├── Config/
│   │   └── Routes.php          # Route definitions
│   ├── Controllers/
│   │   ├── Pages.php           # Landing and About pages
│   │   ├── Customers.php       # Retrieves customers via CustomerModel
│   │   └── Users.php           # Retrieves users via UserModel
│   ├── Models/
│   │   ├── CustomerModel.php   # Wraps the customers table
│   │   └── UserModel.php       # Wraps the users table
│   └── Views/
│       ├── layout.php          # Shared layout and navigation
│       ├── pages/
│       │   ├── home.php        # Landing page view
│       │   └── about.php       # About page view
│       ├── customers/
│       │   └── index.php       # Customer table view
│       └── users/
│           └── index.php       # User table view
├── database/
│   └── pos_tfa2.sql            # Database export (schema + sample data)
├── public/
│   ├── css/
│   │   └── style.css           # Styling
│   └── index.php               # Front controller
├── env                         # Environment template (copy to .env)
├── composer.json
└── README.md
```

## Setup and Run

1. Clone the repository and install dependencies:
   ```
   git clone https://github.com/ladiesman416/pos-system-tfa2.git
   cd pos-system-tfa2
   composer install
   ```
2. Copy the environment template: `copy env .env` (Windows) or `cp env .env` (macOS/Linux).
3. Start **Apache** and **MySQL** (for example in the XAMPP Control Panel).
4. Open phpMyAdmin (`http://localhost/phpmyadmin`), create a database named `pos_tfa2`, then use the **Import** tab to import `database/pos_tfa2.sql`.
5. In `.env`, set the database values (remove any `#` at the start of these lines):
   ```
   database.default.hostname = localhost
   database.default.database = pos_tfa2
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```
6. Run the development server:
   ```
   php spark serve --port 8081
   ```
7. Open `http://localhost:8081` and visit `/customers` and `/users`.

## How It Works (MVC)

1. The browser requests a URL such as `/customers`.
2. `app/Config/Routes.php` matches the URL to `Customers::index`.
3. The `Customers` controller creates a `CustomerModel` and calls `findAll()`.
4. The Model queries the `customers` table through Query Builder and returns the records.
5. The controller passes the records to the `customers/index` view with `view()`.
6. The view extends `layout.php`, loops through the records with `foreach`, and outputs a table row for each one.
7. The rendered HTML is returned to the browser.