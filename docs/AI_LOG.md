
# AI Usage Log - Ace Tennis Academy

## Milestone 1

### AI Tool Used

ChatGPT was used as a development assistant during Milestone 1.

### How AI Was Used

AI assistance was used for:

- Planning the project structure
- Explaining SPA navigation
- Creating initial HTML page templates
- Suggesting CSS layouts and responsive styles
- Implementing basic JavaScript interactions
- Designing the initial ERD
- Drafting project documentation
- Troubleshooting frontend errors

### Example 1 - CSS Layout Issue

**Problem:**
During frontend development, the initial CSS layout did not produce the intended page alignment and spacing.

**AI suggestion:**
AI suggested CSS layout rules for the page structure.

**Issue:**
The suggested styling required adjustments to work correctly with the existing header, main content, and footer.

**Resolution:**
The CSS was reviewed and updated to improve the layout and page alignment.

### Example 2 - Trainings Page Loading Error

**Problem:**
The Trainings page displayed the message "Unable to load trainings."

**AI suggestion:**
AI suggested checking the HTML file location, filename, fetch path, and browser console.

**Issue:**
The Trainings page was not loading correctly in the SPA.

**Resolution:**
The project files and navigation were checked, and the loading issue was corrected.

### Verification

All generated code was reviewed, integrated into the project, and tested manually using Visual Studio Code and Live Server.

### Limitations

The current application uses static demonstration data. Authentication, database operations, and real bookings are not yet implemented.



## Milestone 2 - Database and DAO Layer

### AI Tools Used
ChatGPT was used to assist with database design, PHP DAO implementation, debugging, and testing.

### AI-Assisted Development
- Created a MySQL database with five related tables.
- Implemented BaseDao using PHP PDO.
- Created DAO classes for users, coaches, courts, training sessions, and bookings.
- Used prepared statements for database operations.
- Created PHP test scripts to verify CRUD functionality.
- Updated project documentation.

### AI Mistake 1 - Duplicate Coach User ID

**Problem:**
The AI-generated CRUD test attempted to create a coach using user_id = 2.

However, this user was already associated with an existing coach record.

MySQL returned:
SQLSTATE[23000]: Integrity constraint violation:
1062 Duplicate entry '2' for key 'user_id'

**Fix:**
Changed the test to use user_id = 1, which was not associated with an existing coach.

**Result:**
CoachDao successfully passed all CRUD tests.

**Lesson Learned:**
Test data must respect database constraints, including UNIQUE and FOREIGN KEY constraints.

### AI Mistake 2 - Incorrect Decimal Comparison

**Problem:**
The AI-generated CRUD test compared database values using strict string comparison.

MySQL returned hourly_price as "40.00", while PHP converted the expected value to "40".

The test incorrectly reported:
CourtDao UPDATE failed: hourly_price

**Fix:**
Updated the test to compare numeric values numerically while keeping strict string comparison for nonnumeric values.

**Result:**
CourtDao successfully passed all CRUD tests.

**Lesson Learned:**
Database values may use different formatting, so tests must account for data types.

### Final Testing Results
All five DAO classes passed Create, Read, Update, and Delete tests.

- UserDao: Passed
- CoachDao: Passed
- CourtDao: Passed
- TrainingSessionDao: Passed
- BookingDao: Passed

### AI Verification
All AI-generated code was reviewed and tested locally using PHP, XAMPP, and MySQL.

The final CRUD tests completed successfully.
