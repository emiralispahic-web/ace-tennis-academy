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


## Milestone 2 - Database and DAO Layer

### Technologies
- PHP
- MySQL / MariaDB
- PDO (PHP Data Objects)
- XAMPP
- HTML, CSS, JavaScript

### Database

The project uses a relational database named
`ace_tennis_academy`.

It contains five tables:

1. users
2. coaches
3. courts
4. training_sessions
5. bookings

The tables are connected using primary keys
and foreign keys.

### Database Setup

1. Install and open XAMPP.
2. Start Apache and MySQL.
3. Open http://localhost/phpmyadmin
4. Create a database named `ace_tennis_academy`.
5. Select the database.
6. Click Import.
7. Import the `ace_tennis_academy.sql` file
   from the project root.

The SQL file contains the database tables
and sample records.

### PHP Configuration

1. Open the `backend/config` directory.
2. Copy `config.example.php`.
3. Rename the copy to `config.php`.
4. Update the database credentials if necessary.

Example configuration:

```php
<?php

return [
    'host' => 'localhost',
    'dbname' => 'ace_tennis_academy',
    'username' => 'root',
    'password' => ''
];
```

The `config.php` file is excluded from Git
to protect local database credentials.

### DAO Architecture

The `backend/dao` folder contains:

- BaseDao.php
- UserDao.php
- CoachDao.php
- CourtDao.php
- TrainingSessionDao.php
- BookingDao.php

BaseDao provides shared database functionality.

Each entity DAO extends BaseDao and supports
Create, Read, Update, and Delete operations.

All database operations use PDO prepared
statements for parameterized values.

### Testing

All five DAO classes were tested locally
using PHP and MySQL.

All CRUD operations passed successfully.

### Current Implementation

Milestone 1: Static frontend and ERD.

Milestone 2: MySQL database and PHP DAO layer.

Business logic, API endpoints, and integration
with the frontend will be added in later milestones.
