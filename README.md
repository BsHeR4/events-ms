
#  Event Management API

## Description


**Event Management API** is a robust and extensible backend system built with **Laravel 12**, designed to manage all aspects of event organization including **Events**, **Event Types**, **Locations**, and **User Reservations**.

The API follows **RESTful standards**, applying modern **design patterns** such as the **Service Layer**, **Polymorphic Relationships**, and **Clean Architecture** principles. It emphasizes scalability, maintainability, and security, making it suitable for both training and production-grade event management platforms.

###  Key Features

-  **CRUD Functionality** for Events, Locations, Event Types, and Reservations
-  **Role-Based Access Control (RBAC)** using Spatie Permissions (Admin / Organizer / User)
-  **Ownership Enforcement** for modifying/deleting events and reservations
-  **Polymorphic Image Upload** per entity with automatic handling
-  **Global Scopes** to filter outdated events (upcoming only)
-  **Custom Validation Rules** (prevent double booking, enforce max capacity)
-  **Base Abstract Services** to reduce repetition across services
-  **Model Pruning** for automatic cleanup of expired events
-  **Unified Exception Handling** using a centralized `CrudException`
-  **Mutators & Accessors** to format and sanitize model data
-  **Seeder & Factory Support** with proper role assignments and data integrity

###  Architectural Highlights

-  Service-driven structure with thin controllers and reusable service logic
-  Centralized error handling using the `handle()` wrapper method in abstract services
-  Route-level and controller-level middleware enforcement (e.g., ownership, roles)
-  Uses Laravel Resources to provide clean, consistent JSON responses

## Technologies Used

- **Laravel 12**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Postman Collection**: Contains all API requests for easy testing and interaction with 

## Installation

### Prerequisites

Make sure you have the following installed:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project
- **Postman**: Required for testing the requestes.

### Steps to Run the Project

1. Clone the Repository  
   ```bash
   git clone https://github.com/BsHeR4/events-ms
2. Navigate to the Project Directory
   ```bash
   cd events-ms
3. Install Dependencies
   ```bash
   composer install
4. Create Environment File
   ```bash
   cp .env.example .env
   Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Seed the Database
    ```bash
    php artisan db:seed
8. Run the Application
    ```bash
    php artisan serve
9. Interact with the API and test the various endpoints via Postman collection. Get the collection from [here](https://documenter.getpostman.com/view/33882685/2sB2qdeyvA).

### Admin Login for Testing

```bash
Email: admin@example.com
Password: password
```
---

© 2025 - Built for training and learning purposes.
