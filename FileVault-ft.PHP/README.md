# FileVault-ft.PHP Documentation

Generated on: 2025-04-26 10:58:42

## Overview

This documentation covers 7 files from the FileVault-ft.PHP codebase.

## Table of Contents

### Root

- [db.php](#db-php)
- [fileupload.php](#fileupload-php)
- [index.php](#index-php)
- [login.php](#login-php)
- [logout.php](#logout-php)
- [register.php](#register-php)
- [style.css](#style-css)

## File Documentation

### Root

<a id='db-php'></a>

#### db.php

*Path: db.php*

1.  **Purpose:** This file provides a central function for interacting with the MySQL database. It establishes a connection and executes queries.

2.  **Key Functionality:**

    -   `queryDB($userquery)`
        -   Parameters:
            -   `$userquery` (string): The SQL query to execute.
        -   Return Type: `mysqli_result | false` - Returns a MySQLi result object on success, or `false` on failure.
        -   Technical Explanation: Establishes a connection to the MySQL database using `mysqli`. Executes the provided `$userquery` using `$connection->query()`.  Error messages are echoed for connection and query execution failures. The result of the query or `false` is returned. Credentials for database connection are hardcoded in this function.
        -   Fallback Mechanisms: Echoes error messages if the connection or query fails. Returns `false` to indicate failure, allowing calling functions to handle the error.

3.  **Dependencies and Relationships:**

    -   Imports & Usage: Uses the `mysqli` extension for database interaction.
    -   Code Relationships: Used by `fileupload.php`, `login.php`, and `register.php` to interact with the database.

4.  **Usage Example:**

```php
include "db.php";
$query = "SELECT * FROM my_table";
$result = queryDB($query);

if ($result) {
    // Process the result set
} else {
    // Handle the error
}

```

5.  **Technical Notes:**

    -   Security: **Storing database credentials directly in the code is a major security risk.**  These should be stored securely, such as environment variables, and retrieved within the script.
    -   Error Handling: While the function provides basic error output, more robust error handling (e.g., logging, exceptions) would be beneficial in a production environment.
    -   Connection Management: The function establishes a new connection for each query.  Consider implementing persistent connections or a connection pool for better performance.

---

<a id='fileupload-php'></a>

#### fileupload.php

*Path: fileupload.php*

1.  **Purpose:** This file handles file uploads, displaying uploaded images, and managing user-specific file storage. It integrates with the database to store file paths.

2.  **Key Functionality:**

    -   File Upload Handling: Processes file uploads via POST request. Validates file type, size, and uploads to a user-specific directory.
    -   Image Display: Displays uploaded images using `<img>` tags. Dynamically updates the displayed image using jQuery when a new image is selected.
    -   Database Integration: Uses `queryDB()` from `db.php` to store file paths associated with the logged-in user.

3.  **Dependencies and Relationships:**

    -   Imports & Usage: Includes `db.php` for database interaction. Uses jQuery for dynamic image preview.
    -   Code Relationships: Called from `index.php` when a user is logged in. Relies on `db.php` for database operations.

4.  **Usage Example:** Accessed through the `index.php` file when a user is logged in. The user interacts with the file upload form on the main page.

5.  **Technical Notes:**

    -   Security: The file type validation is essential but could be bypassed.  Server-side MIME type validation should be added.  Input sanitization is minimal and insufficient for production.
    -   Directory Creation: Creates user-specific upload directories.  Error handling for directory creation should be improved.
    -   File Path Storage: Stores the full server-side file path in the database.  This approach has security implications and might not be portable.  Consider storing only the filenames and constructing paths dynamically. The double dollar sign `$$targetPath` in the query is unusual and might lead to unexpected behavior. It's likely meant to escape the dollar sign, but using prepared statements would be a better approach.

---

<a id='index-php'></a>

#### index.php

*Path: index.php*

1.  **Purpose:** This file serves as the main entry point of the application. It displays different content based on user authentication status.

2.  **Key Functionality:**

    -   Session Management: Starts a session to manage user login status.
    -   Conditional Content: Includes `fileupload.php` if a user is logged in, or `login.php` if not.
    -   Logout Functionality: Provides a logout button that redirects to `logout.php`.

3.  **Dependencies and Relationships:**

    -   Imports & Usage: Includes `fileupload.php` or `login.php` based on session status.  Uses `logout.php` for logout functionality.
    -   Code Relationships: Central hub controlling user flow.  Interacts with `fileupload.php`, `login.php`, and `logout.php`.

4.  **Usage Example:** The first page a user accesses.  Controls the flow to either login/registration or file upload functionality.

5.  **Technical Notes:**  Renders different content based on user authentication status.  Simple and straightforward structure.

---

<a id='login-php'></a>

#### login.php

*Path: login.php*

1.  **Purpose:** This file handles user login. It verifies credentials against the database and establishes a session upon successful login.

2.  **Key Functionality:**

    -   Login Form: Presents a form for username and password input.
    -   Authentication: Queries the database using `queryDB()` from `db.php` to verify user credentials.
    -   Session Management: Sets a session variable upon successful login.

3.  **Dependencies and Relationships:**

    -   Imports & Usage: Includes `db.php` for database interaction.
    -   Code Relationships: Used by `index.php` when a user is not logged in. Relies on `db.php` for database operations.

4.  **Usage Example:** Accessed through `index.php` when a user is not logged in.

5.  **Technical Notes:**

    -   Security: **Directly embedding user-supplied data into SQL queries is extremely vulnerable to SQL injection attacks.** Prepared statements or parameterized queries are crucial for security.  Password storage is insecure.  Passwords should be hashed using a strong one-way hashing algorithm (e.g., bcrypt, Argon2).
    -   Error Handling: Basic error messages are displayed.  More robust error handling would be beneficial.

---

<a id='logout-php'></a>

#### logout.php

*Path: logout.php*

1.  **Purpose:** This file handles user logout by destroying the session.

2.  **Key Functionality:**

    -   Session Destruction: Destroys the current session, effectively logging the user out.
    -   Redirection: Redirects the user to `index.php` after logout.

3.  **Dependencies and Relationships:**

    -   Code Relationships: Used by `index.php` when the user clicks the logout button.

4.  **Usage Example:** Accessed via the logout button on `index.php`.

5.  **Technical Notes:** Standard session destruction and redirection.

---

<a id='register-php'></a>

#### register.php

*Path: register.php*

1.  **Purpose:** This file handles user registration. It adds new users to the database.

2.  **Key Functionality:**

    -   Registration Form: Presents a form for username and password input.
    -   User Creation: Inserts new user data into the database using `queryDB()` from `db.php`.
    -   Session Management: Starts a session for the newly registered user.

3.  **Dependencies and Relationships:**

    -   Imports & Usage: Includes `db.php` for database interaction.
    -   Code Relationships: Linked from `login.php`. Relies on `db.php` for database operations.

4.  **Usage Example:** Accessed via the registration link on `login.php`.

5.  **Technical Notes:**

    -   Security:  Same security concerns as `login.php` regarding SQL injection and password storage.  **Input sanitization is missing and crucial for security.**

---

<a id='style-css'></a>

#### style.css

*Path: style.css*

1.  **Purpose:** This file contains the CSS styles for the application.

2.  **Key Functionality:**

    -   Styling: Provides styling for various elements, including the navigation bar, forms, buttons, and images.

3.  **Dependencies and Relationships:**

    -   Code Relationships: Used by all HTML files (`index.php`, `fileupload.php`, `login.php`, and `register.php`) to style the user interface.

4.  **Usage Example:** Linked in the `<head>` section of the HTML files.

5.  **Technical Notes:** Standard CSS file providing basic styling.


**Overall System Architecture and Relationships:**

The application follows a simple client-server architecture. The PHP files act as the server-side logic, handling user interaction, file uploads, and database operations. The `index.php` file serves as the main entry point, controlling the flow based on user authentication.  The `db.php` file provides a central point for database interaction, used by multiple other files.  The `style.css` file provides consistent styling across the application.

**Key Dependencies and Interactions:**

-   `index.php` depends on `login.php`, `fileupload.php`, and `logout.php`.
-   `fileupload.php`, `login.php`, and `register.php` depend on `db.php`.
-   All HTML files depend on `style.css`.

**Critical Security Concerns:**

-   SQL Injection: The application is highly vulnerable to SQL injection due to the use of unsanitized user input in SQL queries.
-   Password Storage: Passwords are stored in plain text, which is extremely insecure.
-   Database Credentials: Storing database credentials directly in the code is a major security risk.

Addressing these security vulnerabilities is paramount before deploying this application to any production environment.  Using prepared statements or parameterized queries, hashing passwords, and storing database credentials securely are essential steps.  Further input validation and sanitization are also necessary.

---

