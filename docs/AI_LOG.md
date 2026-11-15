
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



## Milestone 3 – AI Assistance Log

Date: November 15, 2026

### AI Tool Used

ChatGPT

### Purpose of AI Assistance

AI was used to help understand the Milestone 3 requirements,
plan the implementation, develop the service layer, implement
REST API routes, generate OpenAPI documentation, integrate an
external weather API and troubleshoot implementation errors.

### Prompts and Tasks

1. Asked for step-by-step guidance to implement Milestone 3
   using the existing Ace Tennis Academy project.

2. Asked for help implementing services for users, coaches,
   courts, training sessions and bookings.

3. Asked for help implementing application-specific validation,
   including scheduling conflicts, duplicate bookings and
   training session capacity restrictions.

4. Asked for help creating FlightPHP CRUD endpoints and
   testing them using PowerShell and curl.

5. Asked for help documenting the API using swagger-php,
   OpenAPI schemas and Swagger UI.

6. Asked for help integrating OpenWeatherMap to provide
   current weather information for Sarajevo.

7. Asked for help troubleshooting the external API, including
   missing API key configuration and HTTP 401 responses.

8. Asked for help implementing friendly error responses,
   persistent error logging and final regression testing.

### AI Mistake 1 – Incorrect REST API Error Handling

Problem:

The initial implementation relied on a global FlightPHP error
handler to process exceptions thrown by the service layer.

During testing, requesting a user that did not exist returned
an empty response with HTTP 200 instead of HTTP 404.

How it was detected:

I tested the endpoint using curl and compared the actual HTTP
status code with the expected result.

Correction:

Explicit try-catch blocks were added to the route handlers,
using a shared handleApiError function to return consistent
JSON error responses.

Verification:

A request for a nonexistent user returned HTTP 404 with the
correct JSON error message. Existing users still returned
HTTP 200.

### AI Mistake 2 – Invalid JSON Caused by PHP Whitespace

Problem:

Some PHP files contained whitespace outside the PHP opening
and closing tags. This caused extra output in API responses
and resulted in truncated or invalid JSON.

How it was detected:

PowerShell could not correctly parse the API response using
ConvertFrom-Json. Inspection of the raw HTTP response showed
unexpected output before the JSON.

Correction:

Unnecessary whitespace outside PHP tags was removed from the
affected files. Closing PHP tags were removed from PHP-only
files where appropriate.

Verification:

The user endpoints returned complete JSON responses, and
PowerShell successfully parsed the returned user data.

### AI Mistake 3 – OpenAPI Documentation Classes Not Loaded

Problem:

The initial OpenAPI generation script attempted to scan the
documentation files without loading their classes.

swagger-php reported unknown classes and missing OpenAPI
information and path definitions.

How it was detected:

Running backend/test_openapi.php produced warnings and an
incomplete OpenAPI document.

Correction:

The documentation PHP files were explicitly loaded before
generating the OpenAPI document. A glob-based loop was later
used to load all documentation files automatically.

Verification:

The OpenAPI generator successfully produced documentation
containing 11 paths, 26 operations and 18 schemas.

Swagger UI displayed the documented endpoints correctly.

### AI Mistake 4 – Incorrect PowerShell Operation Counting

Problem:

The AI-generated PowerShell command for counting OpenAPI
operations used the Count property directly on a collection
of PowerShell properties.

This produced an op_Addition error instead of the total
number of operations.

How it was detected:

I ran the command and received a PowerShell runtime error.

Correction:

The properties were wrapped in an array using @(...) before
counting them.

Verification:

The corrected command returned 26 documented operations.
A separate schema count returned 18 schemas.

### External API Troubleshooting

The OpenWeatherMap integration initially failed because the
API key was missing from the private configuration file.

After the key was configured, OpenWeatherMap returned HTTP
401. The newly created key later became functional.

The weather endpoint was improved to return HTTP 503 with
a friendly message when the external API was unavailable.

Persistent logging was added to backend/logs/weather.log.

Testing included:

- A successful request using the real API key: HTTP 200.
- A request using an invalid test key: HTTP 503.
- Verification that the external API failure was logged.
- Restoring the real key and confirming HTTP 200 again.
- Confirming that GET /users continued to return HTTP 200
  while the weather API was unavailable.

### Student Verification

I implemented the changes in VS Code and tested the backend
using PHP CLI, PowerShell, curl and Swagger UI.

I verified that:

- All five entity services passed CRUD tests.
- All 25 entity CRUD endpoints were implemented and tested.
- Invalid inputs returned appropriate error responses.
- Court and coach scheduling conflicts were rejected.
- Duplicate bookings were rejected.
- Bookings were rejected when sessions were full.
- Session capacity could not be reduced below active bookings.
- Swagger UI displayed 26 documented operations and 18 schemas.
- The weather API returned live weather data.
- External API failures were handled and logged.
- Temporary CRUD test records were cleaned up.

### Final Outcome

Milestone 3 implements the service layer, REST API,
OpenAPI documentation and external API integration.

AI assistance was used for guidance, implementation support
and debugging. The implementation was reviewed and tested
throughout development.
