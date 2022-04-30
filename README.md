You can view an operational deployment of this application at https://docupet.chriskeefer.dev

## Installation
1. Clone the repository to your local machine.
2. Copy `.env.example` to `.env`.
3. Update `.env` to the realities of your local environment.
4. Run `composer install`.
5. Run `npm install && npm run dev`.
6. Run migrations and seed the database with test data by typing `php artisan migrate --seed`.

## Technical Overview
This is a basic (and incomplete) CRUD application that mocks a real use-case of storing a beloved Pet's information (name, species, etc.) in a database. 

We've created a very simple service API that is being consumed by a somewhat crappy Vue user interface. My goal was to bootstrap an end-to-end solution and touch each piece of the stack without getting sucked into the extreme particulars of any particular component.

### Front-end
The front-end of the application is powered by Laravel Blade, Vue, Headless UI and Tailwind. The documentation for all four of these tools are extremely well written and worth reviewing.

To build the front-end type `npm run dev`

### Back-end
The back-end of the application is entirely Laravel based, and follows standard Laravel conventions. We are serving an API with an extremely small foot-print. Some of the endpoints of the API are built using Spatie's really great package, https://spatie.be/docs/laravel-query-builder 

One pattern that is not _inherent_ to Laravel is the use of Action classes to encapsulate domain critical functionality.

### Testing
This repository has a GitHub Actions Workflow that runs every time any `.php` files are changed. This action deploys an instance of the application, seeds a database with mock data and then runs PHPUnit powered test cases that data.

To run the test suite run the command `php artisan test`.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
