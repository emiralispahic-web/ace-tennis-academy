# ace-tennis-academy
Web Programming Project - Tennis Academy Management System


## Project Description

Ace Tennis Academy is a Tennis Academy Managment System developed for the IT 2001 Web Programming course.

The application is designed to help players and administrators manage tennis training sessions, coaches, courts and bookings.

## Technologies

- HTML5
- CSS3
- javaScript
- PHP (planned backend)
- FlightPHP (planned REST API)
- MySQL (planned Database)

## User Roles

### Player
- Register and log in
- View tennis coaches
- Browse available training sessions
- View tennis courts
- Book training sessions
- Manage bookings
- Update personal profile

### Administrator
- Manage players
- Manage coaches
- Manage courts
- Manage training sessions
- View and manage bookings

## Milestone 1 - Static Frontend

The first milestone includes:

- Initial project structure
- Single Page Application (SPA) navigation
- Responsive frontend design
- Login and registration forms
- Dashboard
- Coaches page
- Trainings page
- Courts page
- Bookings page
- Profile page
- Admin panel
- Initial ERD diagram

The frontend currently uses demonstration data. Database integration, authentication, and REST API functionality will be implemented in future milestones.

## Project Structure

```text
ace-tennis-academy/
├── backend/
│   ├── config/
│   ├── dao/
│   ├── logs/
│   ├── middleware/
│   ├── routes/
│   └── services/
├── frontend/
│   ├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   ├── views/
│   └── index.html
├── docs/
│   ├── erd.png
│   └── AI_LOG.md
├── AGENTS.md
├── .gitignore
└── README.md
```

## How to Run

1. Clone the GitHub repository.
2. Open the project folder in Visual Studio Code.
3. Install the Live Server extension.
4. Open `frontend/index.html`.
5. Right-click and select "Open with Live Server".
6. Navigate through the application using the menu.

## Database Design

The initial ERD contains five entities:

1. Users
2. Coaches
3. Courts
4. Training Sessions
5. Bookings

The ERD diagram is available at `docs/erd.png`.

## Planned External API

A weather API is planned to display weather conditions and help users decide whether outdoor tennis training is suitable.

## Development Status

Milestone 1: Static frontend and initial database design.