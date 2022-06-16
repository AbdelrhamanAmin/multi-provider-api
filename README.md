# Multi data source provider

You can find Postman Collection here
## Postman collection
```https://www.getpostman.com/collections/a6c423a12f295308369b```

## Steps to Run with Docker
- clone the repo 
    ```git clone https://github.com/AbdelrhamanAmin/multi-provider-api.git ```
- Switch to the repo directory 
    ```cd multi-provider-api```
- Copy the example env file and make the required configuration changes in the .env file
    ```cp .env.exmple .env```
- run
    ```
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
    ```
    
- Start the app
    ```./vendor/bin/sail up -d```
    ```./vendor/bin/sail artisan key:generate```
- Run migrations 
    ```./vendor/bin/sail artisan migrate ```

## Add a new data source provider
- Add new json file  in application public directory.
- Add to import function in User controller the new data source file name to be imported into database.
- Add a new dataProvider class extending dataProvider base class and implementing dataProviderInterface.
- Map your new data provider json into User DTO.
