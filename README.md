# CodeInfinityInternApplication

**Overview**
This application is divided into two main phases:

Phase 1: Member management using MongoDB.

Phase 2: CSV file generation and import using arrays and SQLite.

**Phase 1 – Member Management (MongoDB)**
Phase 1 focuses on capturing and managing member data using MongoDB. It includes the following pages:

1. member.php
Allows users to submit new member applications.

Includes full validation for all input fields (e.g., name, surname, ID number, and date of birth).

ID numbers must be 13 digits and unique.

The date of birth is matched with the ID number.

A "Cancel" button allows users to clear and reset the form.

2. view.php
Displays all stored members in a tabular format by fetching data from MongoDB.

**Phase 2 – File Handling & Import (SQLite)**
Phase 2 demonstrates file generation, validation, and database import using arrays and SQLite. It includes two main operations:

Generation: Dynamically creates a CSV file with user-specified entry counts.

Import: Uploads a CSV file and loads its contents into the SQLite database.

SQLite is used to store the records, and a progress page is used to prevent timeout issues during long operations.

1. generate.php
Generates a output/output.csv file based on the number of records specified by the user.

Entries are randomly generated and validated to ensure uniqueness and format correctness.

2. import.php
Upload and import data from a CSV file.

Reads data from either the output/output.csv file or from user-uploaded files located in the uploads/ directory.

3. loading.php
Handles the incremental loading of data to prevent timeouts during bulk operations.

Used in both generation and import processes to break the operation into manageable batches.

4. database.php
Displays the contents of the SQLite database in a table format.

**Folder Structure Summary**
```text
/
├── member.php         # Member input form (MongoDB)
├── view.php           # View MongoDB-stored members
├── generate.php       # Generate CSV data
├── import.php         # Import CSV into SQLite
├── loading.php        # Background data loader
├── database.php       # View SQLite database entries
├── /output/output.csv # Output file for generated entries
├── /uploads/          # Folder to store uploaded CSVs
└── /Resources/        # Includes PHP scripts, CSS, database connection, etc.
```