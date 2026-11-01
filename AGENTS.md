
# AI Agent Instructions - Ace Tennis Academy

## Project Overview

Ace Tennis Academy is a Tennis Academy Management System developed for the IT 2001 Web Programming course.

## Technology Stack

- Frontend: HTML, CSS, JavaScript
- Backend: PHP with FlightPHP
- Database: MySQL using PDO
- Authentication: JWT (planned)
- External API: Weather API (planned)

## Project Architecture

The project separates frontend and backend code.

Frontend:
- `frontend/index.html` is the main SPA entry point.
- `frontend/js/app.js` handles navigation and frontend interactions.
- `frontend/css/style.css` contains application styles.
- `frontend/views/` contains individual page templates.

Backend:
- `backend/routes/` for API endpoints.
- `backend/services/` for business logic.
- `backend/dao/` for database access.
- `backend/middleware/` for authentication and authorization.
- `backend/config/` for configuration.

## Development Rules

1. Keep frontend and backend code separated.
2. Use clear and readable code.
3. Use JavaScript for SPA navigation.
4. Maintain responsive design.
5. Validate user input.
6. Never commit passwords, API keys, or database credentials.
7. Use prepared statements for future database queries.
8. Keep documentation updated after each milestone.
9. Document AI assistance in `docs/AI_LOG.md`.

## Milestone 1

Current focus:
- Static frontend
- Navigation
- Responsive design
- Initial ERD
- Documentation

Backend integration will be implemented in future milestones.


## Milestone 2 - Database and DAO Layer

### Database
The project uses MySQL with a database named `ace_tennis_academy`.

The database contains five tables:
- users
- coaches
- courts
- training_sessions
- bookings

Primary keys and foreign keys are used to maintain relationships between tables.

The database schema and sample data are exported in `ace_tennis_academy.sql`.

### Backend Architecture
The backend is developed using PHP and PDO.

The `backend/dao` directory contains:
- BaseDao.php
- UserDao.php
- CoachDao.php
- CourtDao.php
- TrainingSessionDao.php
- BookingDao.php

BaseDao provides reusable database connection, getAll, getById, and delete methods.

Each entity DAO extends BaseDao and implements its own create and update methods using prepared statements.

### Configuration
Database connection settings are stored in `backend/config/config.php`.

The configuration file is excluded from Git using `.gitignore`.

The `backend/config/config.example.php` file provides an example configuration.

### Testing
All five DAO classes were tested successfully.

Create, Read, Update, and Delete operations were verified for each entity using PHP and MySQL.

### Current Project Scope
Milestone 2 implements the relational database and DAO layer.

Business logic, API endpoints, and frontend-backend integration will be implemented in later milestones.

