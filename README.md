<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Todo List API

This project is a simple yet powerful Todo List API built with Laravel. It allows authenticated users to manage their tasks, providing full CRUD functionality for creating, updating, viewing, and deleting todos. This API leverages **Laravel Sanctum** for secure token-based authentication, **role-based authorization** for task access control, and **Docker** for consistent and scalable deployment.

## Features

- **User Authentication**: Secure login and registration with token-based authentication via Laravel Sanctum.
- **Authorization**: Only authenticated users can create, view, edit, or delete their own tasks, ensuring privacy.
- **Task Management**: Users can create todos with customizable properties, including title, description, status, and priority.
- **Dockerized Setup**: The application is containerized using Docker and Docker Compose for a seamless development and deployment process.

## Technologies and Tools

- **Laravel 11**: Backend framework used for building RESTful API routes, handling authentication, and authorization.
- **Laravel Sanctum**: Provides token-based authentication for secure access.
- **Docker & Docker Compose**: Ensures consistency across environments by containerizing the entire application.
- **MySQL**: Database to store user and task data, managed within Docker containers.

## Installation

### Prerequisites
- Docker
- Docker Compose
- Composer
- PHP 8.2

### Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/mohamedmagdy841/todo-list-api.git
   cd todo-list-api
   ```

2. **Copy `.env` file**:
   Configure environment variables (e.g., database settings, Laravel Sanctum config) by copying the example file:
   ```bash
   cp .env.example .env
   ```

3. **Build and start Docker containers**:
   Run the Docker containers for Laravel, MySQL, and any other necessary services:
   ```bash
   docker-compose up --build
   ```

4. **Run migrations**:
   Once the containers are running, migrate the database to set up tables for users, tasks, etc.:
   ```bash
   docker-compose exec app php artisan migrate
   ```

5. **Access the application**:
   The API can be accessed at [http://localhost:8000](http://localhost:8000).

## API Endpoints
<p align="center"><a href="https://www.postman.com" target="_blank"><img src="https://github.com/user-attachments/assets/ca8bf5d1-9091-4ea9-bf51-e1ea46428d87" width="300" alt="Postman Logo"></a></p>

### Postman Documentation [here](https://documenter.getpostman.com/view/38857071/2sAY4sjQUC)
- **Register**: `POST /api/register` — Register a new user.
- **Login**: `POST /api/login` — Login and receive a Sanctum token.
- **Logout**: `POST /api/logout` — Revoke the user's current token.
- **CRUD Operations**:
  - `GET /api/todos` — Get a list of all todos for the authenticated user.
  - `POST /api/todos` — Create a new todo.
  - `PUT /api/todos/{id}` — Update an existing todo.
  - `DELETE /api/todos/{id}` — Delete a todo.

## Authentication & Authorization

This project uses **Laravel Sanctum** for token-based authentication, providing secure access to the API. Users must authenticate by logging in to obtain a token, which is required for all subsequent requests. Role-based access control ensures users can only manage their own tasks, enhancing privacy and security.

## Docker Setup
<p align="center"><a href="https://www.docker.com" target="_blank"><img src="https://github.com/user-attachments/assets/b6fcf59c-9532-477b-a030-8e54d939d456" width="300" alt="Docker Logo"></a></p>
The project is fully containerized using Docker, which includes:

- **App Container**: Runs the Laravel application.
- **MySQL Container**: Database container for storing user and task data.
