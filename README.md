## Installation

1. Clone the repo and `cd` into it
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. Set your `TMDB_TOKEN` in your `.env` file. You can get an API key [here](https://www.themoviedb.org/documentation/api). Make sure to use the "API Read Access Token (v4 auth)" from the TMDb dashboard.
1. `php artisan key:generate`
1. `php artisan serve` or use Laravel Valet or Laravel Homestead
1. Visit `localhost:8000` in your browser

## Starting from a particular point

If you would like to follow along and start from a particular point, follow these instructions. You can choose any point by replacing the hash with [any particular commit](https://github.com/drehimself/laravel-movies-example/commits/master). The commits correspond to the different video parts (mostly).

1. Clone the repo and `cd` into it
1. `git checkout 22fa456`

