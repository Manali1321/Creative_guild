Photographer's Portfolio Platform Documentation

Overview
The Photographer's Portfolio Platform is a web application that allows photographers to showcase their work through an online portfolio. Users can register, log in, view, and manage their profiles and galleries. The application is built using Laravel for the backend API and Vue.js for the frontend interface.

Table of Contents
1.	Setup Instructions
2.	API
3.	Frontend Development
4.	Backend Development
5.	Roadmap
6.	Challenges and Resolutions
7.	Time Tracking

Setup Instructions
Frontend Setup
•	Create vue.js app with TypeScript.
•	Navigate to the frontend directory.
•	Download node and Setup up path.
•	Install dependencies: npm install.
•	Start the development server: npm run serve.

Backend Setup
•	Navigate to the backend directory.
•	Create Laravel project following documentation.
•	Install dependencies: composer install.
•	Copy the .env.example file to .env and configure the database connection.
•	Generate application key: php artisan key:generate.
•	Migrate the database: php artisan migrate.
•	Start the Laravel server: php artisan serve OR MAMP setup

API Usage
Authentication
•	Register: POST /api/signup
•	Login: POST /api/login
•	Reset Password: POST /api/reset_password
•	Change Password: POST /api/change_password
Profile
•	Get Profile: GET /api/profile/{id}
Gallery
•	Get Galleries: GET /api/profile/{id}

Frontend Development
The frontend of the application is built using Vue.js and custom CSS styles. Components are organized in a modular structure and follow a single-page application (SPA) architecture.

Backend Development
The backend of the application is built using Laravel, a PHP web framework. The application follows RESTful API principles for routing and controller actions. Data is stored in a MySQL database, and Eloquent ORM is used for database operations.

Roadmap
•	Phase 1: Create frontend as similar as mockup.
•	Phase 2: Develop gallery management features.
•	Phase 3: Integrate storage with Amazon S3 for profile pictures and gallery images.
•	Phase 4: Implement email functionality for registration confirmation and password reset. [Not working through frontend; Using postman create data but not getting email]
•	Phase 5: Deploy frontend using Aws3 bucket
http://creativeguildfrontend.s3-website-us-east-1.amazonaws.com/
Try to create database using RDS; created too but unable to change privacy to public some reason not letting to update it; when creating new database with public access; not letting me to create another.

Challenges and Resolutions

Challenge: Integrating AWS S3 for storage.
Resolution: Used Laravel AWS SDK plugin for seamless integration. I had try to add image through Laravel which gives me issue so follow this resume and which help me to solve.
https://stackoverflow.com/questions/76447669/laravel-10-class-league-flysystem-awss3v3-portablevisibilityconverter-not-fou

Challenge: Implementing email functionality. [Still not working]
Description: When user add email and send; not getting email but in database it shows token generated.

Challenge: Authentication and authorization [Partially working]
Description: When user write credential at frontend. Data goes to backend with POST request. Check with database. Create token. Come to frontend. Stored in local storage but not letting me to go on middleware ‘auth’ path. So, for now I just remove ‘auth’.

Time Tracking
Total time taken to complete the project: ~10 Hours
Task	Time
Frontend and backend setup	30 min
Creating component for frontend	1 Hour
Back end: API developement	8 hours
Deplyment and documentation	30 min

