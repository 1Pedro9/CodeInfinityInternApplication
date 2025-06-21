# requirements.md

# System & Environment Requirements

This project consists of two phases with different backend technologies and has specific configuration requirements to run successfully.

---

## General Requirements

- PHP ≥ 7.4
- Web server (e.g., Apache, Nginx)
- Enabled extensions:
  - mongodb
  - pdo_sqlite
- Operating system: Linux, macOS, or Windows with WAMP/XAMPP

---

## Required PHP Extensions

Make sure the following extensions are enabled in `php.ini`:

```ini
extension=pdo_sqlite
extension=mongodb
```

---

## php.ini Configuration

To support large file uploads and memory-heavy operations like CSV file generation and upload, adjust the following settings:

```ini
upload_max_filesize = 100M
post_max_size = 100M
max_file_uploads = 20
memory_limit = 256M
max_execution_time = 300
```

Also override these temporarily in PHP using `ini_set()` (as done in `generate_file.php` for example).

---

## MongoDB Requirements (Phase 1)

- MongoDB must be installed and running locally on:
  ```
  mongodb://localhost:27017
  ```
- Database: `CodeInfinityApply`
- Collection: `members`

---

## Directory Structure for Writable Paths

Make sure the following directories exist and are writable by the web server:

```
/output               # Stores the generated CSV files
/uploads              # Stores uploaded CSV files
/Resources/database   # Stores SQLite database file
```

On Linux, set writable permissions with:

```bash
chmod -R 755 output uploads Resources/database
```

---

## File-Specific Notes

| File                | Purpose                             |
|---------------------|-------------------------------------|
| generate_file.php   | Requires high memory and time limits |
| load_sqlite.php     | Handles large datasets in batches    |
| csv_database.sqlite | Auto-generated SQLite file           |
| member.php          | Validates and submits to MongoDB     |
| upload_file.php     | Accepts CSV uploads                  |

---

## Optional (for debugging)

Enable PHP error reporting during development:

```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```
