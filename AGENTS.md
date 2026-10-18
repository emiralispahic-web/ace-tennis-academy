
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
