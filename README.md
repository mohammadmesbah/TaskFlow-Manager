# TaskFlow Manager

A comprehensive task and project management system built with Laravel, designed to streamline team collaboration and project tracking.

## Overview

TaskFlow Manager is a modern web application that helps organizations manage their projects, tasks, and team members efficiently. It provides a centralized platform for project tracking, task assignment, and team collaboration.

## Key Features

- **Project Management**
  - Create and manage multiple projects
  - Assign projects to departments
  - Track project progress
  - Collaborative project management

- **Task Management**
  - Create and assign tasks
  - Set task priorities and deadlines
  - Track task completion status
  - Project-specific task organization

- **Department Management**
  - Organize team structure
  - Assign projects to departments
  - Department-wise task tracking

- **User Management**
  - Role-based access control
  - User authentication and authorization
  - Team member management

## Tech Stack

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates, Vite
- **Database**: MySQL
- **Authentication**: Laravel Breeze

## Installation

1. Clone the repository:
```bash
git clone https://github.com/mohammadmesbah/TaskFlow-Manager.git
cd TaskFlow-Manager
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy environment file and configure:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Build assets:
```bash
npm run build
```

8. Start the development server:
```bash
php artisan serve
```

## Usage

1. Access the application at `http://localhost:8000`
2. Register a new account or log in
3. Create departments to organize your team
4. Create projects and assign them to departments
5. Add tasks to projects and assign them to team members
6. Track project and task progress

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is created by Mohammad Mesbah.

