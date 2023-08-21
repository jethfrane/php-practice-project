Student Management System Documentation
Introduction
The Student Management System is a web-based application developed as a practice project to familiarize me with web development using PHP, MySQL, HTML, CSS, JavaScript, and the Bootstrap front-end library. The system provides a platform to manage student information, allowing users to perform various actions such as adding, editing, viewing, and deleting student records. The project serves as an educational tool to understand the basics of web application development.
Features
User Authentication and Roles
The system implements user authentication to ensure secure access. Users are required to log in using their credentials. Two user roles are defined: 'administrator' and 'user'. The roles determine the level of access and functionalities available to each user.
CRUD Operations (Create, Read, Update, Delete)
The following CRUD operations are supported:
Create: Users with administrator roles can add new student records to the database. Required information includes first name, last name, gender, and optional notes.
Read: Users can view a list of student records in a paginated table format. The table provides options to view details, edit, and delete records.
Update: Users with administrator roles can edit existing student records, including first name, last name, and gender.
Delete: Users with administrator roles can delete student records from the database.
Pagination
To manage large sets of student records, pagination is implemented. The system displays a limited number of records per page, improving performance and user experience.
Search Functionality
The system includes a search feature that enables users to search for student records by entering a keyword (first name or last name). The search functionality updates the displayed records in real time based on the entered keyword.
Responsive User Interface
The user interface is designed using HTML, CSS, and the Bootstrap front-end library. The interface is responsive, ensuring optimal user experience on various devices, including desktops, tablets, and mobile phones.
Download CSV
Users can download the student records in CSV (Comma-Separated Values) format. This feature enables data extraction for analysis or reporting purposes.
How to Use
Installation: Upload the project files to a web server with PHP and MySQL support.
Database Setup: Import the provided SQL file to create the necessary database tables.
Configuration: Modify the database connection settings in the connections/connection.php file.
Access: Access the application through a web browser. Users will be prompted to log in.
User Roles: Use the provided administrator and user credentials to test different functionalities.
Navigation: Use the navigation menu to add, view, edit, and delete student records. Utilize the search and pagination features for efficient data management.
Conclusion
The Student Management System project serves as an entry-level exploration into web application development using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. It provides practical experience in implementing user authentication, CRUD operations, pagination, and responsive design. This project is intended for educational purposes and as a foundation for further learning and development.