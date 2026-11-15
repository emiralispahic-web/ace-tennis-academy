
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



## Milestone 3 – Service Layer, REST API and OpenAPI

### Project Architecture

The backend follows a layered architecture:

Routes -> Services -> DAOs -> MySQL Database

- Routes handle HTTP requests and JSON responses.
- Services implement business logic and validation.
- DAOs handle database operations using PDO.
- Routes must not communicate directly with DAOs.
- External API communication is handled by a dedicated service.

### Backend Technologies

- PHP 8.5
- MySQL
- PDO
- Composer
- FlightPHP
- swagger-php
- OpenAPI 3.0
- OpenWeatherMap API

### Service Layer

The following services are implemented:

- BaseService.php
- UserService.php
- CoachService.php
- CourtService.php
- TrainingSessionService.php
- BookingService.php
- WeatherService.php

Services must validate incoming data before performing
database operations.

### Business Rules

- User emails must be valid and unique.
- Passwords must be hashed before database storage.
- Password hashes must not appear in API responses.
- Coach profiles must belong to users with the coach role.
- Court prices must be positive.
- Training sessions must have valid dates and times.
- Courts and coaches cannot have overlapping sessions.
- Only users with the student role can be assigned bookings.
- Duplicate bookings are not allowed.
- Pending and confirmed bookings count toward session capacity.
- Cancelled bookings do not occupy session capacity.
- Session capacity cannot be reduced below active bookings.

### REST API Guidelines

- Use FlightPHP for routing.
- Return JSON responses.
- Use GET for retrieving resources.
- Use POST for creating resources.
- Use PUT for updating resources.
- Use DELETE for deleting resources.
- Use appropriate HTTP status codes.
- Return consistent error messages.
- Keep route logic separate from business logic.

### OpenAPI Documentation

- Document all business API endpoints using swagger-php.
- Keep documentation consistent with actual API behavior.
- Define request and response schemas.
- Document required parameters and validation errors.
- Update OpenAPI documentation whenever an endpoint changes.

Swagger UI: /docs
OpenAPI JSON: /openapi.json

### External API Guidelines

The application uses OpenWeatherMap to retrieve current
weather conditions for Sarajevo.

- External API requests must be handled by WeatherService.
- API keys must be stored in private configuration files.
- Never commit real API keys or database credentials.
- Use connection and request timeouts.
- Validate external API responses.
- Log external API failures.
- Return friendly error messages when the API is unavailable.
- External API failures must not prevent other endpoints
  from functioning.

Weather endpoint: GET /weather

### Security and Configuration

- backend/config/config.php must remain ignored by Git.
- backend/config/config.example.php contains placeholders only.
- backend/vendor/ must not be committed.
- Runtime log files must not be committed.
- Use prepared statements for database operations.
- Authentication, JWT and role-based authorization are
  planned for Milestone 4.

### Testing Guidelines

- Check PHP syntax before testing.
- Test service CRUD operations.
- Test invalid inputs and business rules.
- Test REST endpoints using curl, PowerShell or Swagger UI.
- Test both successful and failed external API requests.
- Remove temporary test data after testing.
- Verify existing functionality after code changes.

### Milestone 3 Git Workflow

- Work on the milestone3 branch.
- Review all changes before committing.
- Do not commit credentials, vendor files or runtime logs.
- Update README.md, AGENTS.md and docs/AI_LOG.md.
- Push the milestone3 branch to GitHub.
- Create a pull request into main.
- Request a review from the course instructor.
- Do not merge the pull request yourself.
