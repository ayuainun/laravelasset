# laravelasset


## How to Use

1.  **Clone Repository or Download**

1. **Setup**

    # Install dependencies
    $ composer install
   
1. **.ENV**

    Rename or copy the `.env.example` file to `.env`
    ```bash
    # Generate app key
    $ php artisan key:generate
    ```

1. **Setup Database**

    Setup your database credentials in your `.env` file.

1. **Seed Database**
    ```bash
    $ php artisan migrate --seed
    ```
1. **Create Storage Link**

    ```bash
    $ php artisan storage:link
    ```
1. **Create Key Generate**

    ```bash
    php artisan key:generate

1. **Run Server**

    ```bash
    $ php artisan serve
    ```
1. **Login**

    Try login with username: `admin` and password: `password`
