# Personal Task Manager

A simple and efficient web-based task management system built with Laravel and Supabase. This application allows users to organize daily tasks, monitor progress, and manage task completion through an intuitive interface.

## Project Information

**Project Code:** WST21-PM-2026-SF
**Developer:** John Francis C. Primor
**Course & Year:** Bachelor of Science in Information Technology (BSIT) – 2nd Year, Section IT 2-Sec05
**Database:** Supabase (PostgreSQL)

---

## Overview

The Personal Task Manager is designed to help users keep track of their tasks and improve productivity. It provides essential task management functionalities such as creating, updating, deleting, and tracking task statuses.

---

## Features

* Create new tasks
* View all existing tasks
* Edit task details
* Delete tasks
* Mark tasks as Pending or Completed
* Responsive and user-friendly interface
* PostgreSQL database integration through Supabase

---

## Technology Stack

### Backend

* Laravel 13
* PHP 8.5

### Database

* PostgreSQL
* Supabase

### Frontend

* Blade Templates
* HTML5
* CSS3

---

## Installation Guide

### 1. Clone the Repository

```bash
git clone <repository-url>
cd personal-task-manager
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Copy the example environment file:

```bash
cp .env.example .env
```

Update the database credentials in the `.env` file with your Supabase PostgreSQL connection details.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migrations

```bash
php artisan migrate
```

### 6. Start the Development Server

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## Project Objectives

* Apply CRUD (Create, Read, Update, Delete) operations using Laravel.
* Implement database integration with Supabase PostgreSQL.
* Practice MVC architecture and Blade templating.
* Develop a clean and maintainable web application.

---

## Future Enhancements

* Task categories and priorities
* Due dates and reminders
* Search and filtering functionality
* Dashboard with task statistics


---

## License

This project was developed for educational purposes as part of the Web Systems and Technologies course requirements.
