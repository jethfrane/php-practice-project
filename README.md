# Project Documentation

"php-practice-project" is a student management system showcasing PHP and MySQL skills. This project provides a comprehensive opportunity to learn and practice basic backend development with PHP, database management with MySQL, and frontend functionalities. It features user authentication, record management, search functionality, and notes updating.

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)

## Project Overview

The "php-practice-project" is designed as a practical learning platform to help you become familiar with key aspects of web development. By creating a student management system, this project demonstrates how PHP, MySQL, and frontend technologies can work together to build a functional web application.

## Features

- **User Authentication**: Users can log in with different access levels (administrator or user).

- **Record Management**: The application allows adding, viewing, editing, and deleting student records.

- **Search Functionality**: Users can search for students by first name or last name.

- **Notes Updating**: Users (both administrators and users) can update notes for individual students.

- **Download CSV**: Administrators can download student records as CSV files.

## Project Structure

The project follows a structured approach to separate different functionalities:

- **Database**: The project utilizes a MySQL database to store student records and user credentials.

- **Backend (PHP)**: PHP scripts handle user authentication, database interactions, and dynamic content generation.

- **Frontend (HTML/CSS/JavaScript)**: The frontend provides a user-friendly interface for interacting with the application.

## Getting Started

Follow these steps to set up and run the "php-practice-project" on your local machine:

1. **Prerequisites**: Make sure you have a web server (such as Apache), PHP, and MySQL installed.

2. **Clone or Download**: Clone this repository to your local machine or download the ZIP file.

3. **Database Setup**: Create a MySQL database named `student_system`. Import the provided SQL files (`student_list.sql` and `student_users.sql`) to set up the necessary tables and sample data.

4. **Configure Database Connection**: Open `connections/connection.php` and update the database connection credentials.

5. **Web Server Setup**: Place the project files in your web server's directory (e.g., `htdocs` for XAMPP/WAMP).

6. **Access the Application**: Open a web browser and enter the project's URL. You'll be directed to the login page.

7. **Login**: Log in using the provided credentials:
   - Administrator: Username: `admin`, Password: `admin1`
   - User: Username: `user`, Password: `user1`

8. **Explore the Project**: Navigate through the dashboard, search for students, view details, and update notes.

Continue reading the next section for more detailed instructions on setting up and running the project.

Enjoy learning and experimenting with PHP, MySQL, and frontend development in this practical project!

Welcome to the **php-practice-project**! This project serves as a practical platform to learn and practice PHP programming, MySQL database management, and basic frontend development. It features a student management system with user authentication, record management, search functionality, and notes updating.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation Steps](#installation-steps)
- [Exploring the Project](#exploring-the-project)
- [Conclusion](#conclusion)

## Prerequisites

1. **Web Server**: You'll need a web server to run PHP scripts. You can use Apache, Nginx, or XAMPP/WAMP for an all-in-one solution.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/xampp.png)

2. **PHP and MySQL**: Ensure that PHP and MySQL are installed on your system.

3. **Text Editor or IDE**: Choose a text editor or integrated development environment (IDE) to edit and manage the project files.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/vscode.png)

## Installation Steps

1. **Clone or Download the Repository**: Start by cloning this repository to your local machine or downloading the ZIP file and extracting it.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/clone-repository.png)

2. **Database Setup**:

   - Open a MySQL client (phpMyAdmin or MySQL command line).
   - Create a new database named `student_system`.
   - Import the provided SQL files (`student_list.sql` and `student_users.sql`) into the `student_system` database. These files contain the table structures and sample data.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/db-student_users.png)
![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/db-student_list.png)

3. **Configure Database Connection**:

   - Navigate to the `connections` directory and open the `connection.php` file.
   - Update the database connection credentials (hostname, username, password) based on your local MySQL setup.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/setup-connection-php.png)

4. **Web Server Setup**:

   - Place the project files in the appropriate directory of your web server (e.g., `htdocs` for XAMPP or WAMP).
   - Start your web server.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/xampp-htdocs.png)

5. **Access the Application**:

   - Open a web browser and enter the URL of the project's directory (e.g., `http://localhost/php-practice-project`).
   - You'll be redirected to the login page.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/localhost-login-page.png)

6. **Login**:

   - Log in using the provided credentials:
     - For administrators: Username: `admin`, Password: `admin1`
     - For users: Username: `user`, Password: `user1`

## Exploring the Project

Once logged in, you can explore the project and interact with its features:

- **Dashboard**: After logging in, you'll be taken to the dashboard where you can view the list of students and perform various actions.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/index-page.png)

- **Search**: Use the search bar to search for students based on their first name or last name.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/index-search.png)

- **View and Edit Student Details**: Click on the "View" button to see detailed information about a student. Administrators can also edit student details on this page.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/details-page-edited.png)
![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/edit-delete-page.png)

- **Update Notes**: On the student details page, administrators and users can update notes for the student.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/details-page-edit.png)

- **Add New Student**: Administrators can add new students by clicking the "Add New" button on the dashboard.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/add-student-page.png)

- **Download CSV**: Administrators can download the student records in CSV format by clicking the "Download as .csv" button.

![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/download-csv.png)
![Screenshot](https://github.com/jethfrane/php-practice-project/blob/main/img/save-csv.png)

## Conclusion

Congratulations! You've successfully set up and run the **php-practice-project** on your local machine. This project provides a practical opportunity to learn and practice PHP programming, MySQL database management, and basic frontend development. As you explore the different functionalities of the application, consider the areas for improvement mentioned in the documentation to enhance the project's security, usability, and overall functionality.

Feel free to experiment, make modifications, and further develop the project to solidify your skills and gain valuable hands-on experience in web development.

If you have any questions or need assistance, refer to the documentation or reach out to the project creators for guidance.

Happy learning and coding!
