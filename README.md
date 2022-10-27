## Setup Step

1)  Update correct database information at `.env`

    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=homecarehub_interview_assessment
    DB_USERNAME=root
    DB_PASSWORD=

2) Init Database and add simple data (make sure enable php pdo_mysql extension)

    php artisan migrate --seed

3) Create the symbolic link for public disk

    php artisan storage:link

4) Build frontend web page

    npm run build

5) Start the laravel server

    php artisan serve

6) The server should be running at http://localhost:8000
