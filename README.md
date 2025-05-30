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

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates, Vite
- **Database**: MySQL
- **Authentication**: Laravel UI v4.6
- **Authorization**: Laravel Policy

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
7. Get Notification if new task assigned to you.

## Notification Feature

TaskFlow Manager includes a robust notification system to keep users informed about important project and task updates:

- **Task Assignment Notifications:**  
  When a manager creates a new project or assigns a task to a user, the assigned user receives a notification in their account.

- **Notification Dropdown:**  
  Users can view all notifications (read and unread) from the notifications dropdown in the navigation bar. Unread notifications are highlighted and a badge displays the count of unread notifications.

- **Mark as Read:**  
  Clicking on a notification automatically marks it as read and updates the unread count in real time.

- **Database-Backed:**  
  All notifications are stored in the database, ensuring users can access their notification history at any time.

This feature helps users stay up-to-date with their assignments and project changes, improving team communication and workflow efficiency.

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is created by Mohammad Mesbah.
