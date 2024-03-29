# Famous Quote Quiz Application

## Overview

This is a web-based quiz application built using Laravel 9, Alpine.js, Tailwind CSS, and ES6. It allows users to create questionnaires, answer them, and view top scores. The application has two user roles: admin and guest users.

## Features

- **Admin Functionality:**
  - Create and manage questionnaires.
  - Create and manage individual quiz questions (quotes).
  - View top scores of all users.
  
- **Guest User Functionality:**
  - Answer questionnaires.
  - View top scores.

## Usage

### Admin Access

- Admins can access the following pages:
  - `/admin/questionnaires/create_one`: Create a new questionnaire.
  - `/quotes/create_one`: Create a new quiz question (quote).
  - `/guest_users/index_admin`: View top scores for admin users.

### Guest User Access

- Guest users can access the following pages:
  - `/`: Home page with top scores.
  - `/questionnaires`: View a list of available questionnaires.
  - `/questionnaires/{id}`: Answer a specific questionnaire.

After selecting a questionnaire from the list a modal is opened. User's names and email are recorded into the local storage for an hour. It will facilitate the user on submitting multiple questionnaires in a short time.

## Database

- The application uses a database with two tables: `questionnaires` and `quotes`.
- `questionnaires` and `quotes` are linked in a many-to-many relationship to allow flexible questionnaire creation.

## Future Improvements

- Enhance validation error messages on the "Add Questionnaire" page to display errors under each input field.
- Record `created_at` and `updated_at` timestamps in the `questionnaires_quotes` table.
- All API requests that need Admin authorisation should have one. They are with authorization at the moment.
- Better visualization of Questionnaires List.
- JS and CSS files could be refactored, so they are in more separate directory structure. We could add 'admin' folders.
- "\resources\js\questionnaires\questionnaires.js" - This file is too big and too complicated at the moment. It could be refactored.
- Also, we can add a message into "questionnaires.js" if the form is submitted successfully on the backend.
- There could have "App\Http\Controllers\Admin" namespace. So, we will know which code needs user login, privileges, etc..

## Local Server Installation

1. Clone the repository.
2. Run the following commands to install all needed resources:
   - `composer install`: Installs all needed php packages.
   - `npm install`: Installs all needed node.js packages.
3. Configure your database settings in the `.env` file.
4. You can generate an APP_KEY with: `php artisan key:generate` command.
5. Run the following commands to set up the database:
   - `php artisan migrate`: Run all migrations.
   - `php artisan db:seed --class=GuestUserSeeder`: Seed the database with seeder class `GuestUserSeeder`.
   - `php artisan db:seed --class=UserSeeder`: Seed the database with seeder class `UserSeeder`.
   - `php artisan db:seed --class=QuestionnaireSeeder`: Seed the database with seeder class `QuestionnaireSeeder`.
   - `php artisan db:seed --class=QuoteSeeder`: Seed the database with seeder class `QuoteSeeder`.
   - `php artisan db:seed --class=QuestionnaireQuoteSeeder`: Seed the database with seeder class `QuestionnaireQuoteSeeder`.
6. Run the following commands to start the local servers:
   - `php artisan serve`: Starts the php server.
   - Start a MySql server on your local machine.
   - `npm run dev`: It starts the Node.js server.

Please, keep the sequence of the seeds.

## Contributors

- Hristo Hristov

## License

This project is open-source and available under the [MIT License](https://opensource.org/license/mit/).