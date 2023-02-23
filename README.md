### Parking lot (Microservices oriented)

#### Requirements

PHP >= 7.2 installed
Composer installed
MySQL >= 5.7 installed

##### Optional requirements

Docker >= 18.09 installed
Docker-compose >= 1.23 installed

#### Installation

For each microservice we need to do the following steps:

1. In every case, you need to install the dependencies with composer:

   composer install

2. Create a copy of .env.example with name .env and fill the variables with your data.

```bash
cp .env.example .env
```

3. In the case of Docker, you need to build the containers using sail:

```bash
    vendor/bin/sail up -d
```

Note: bear in mind if you want to emulate the communication between microservices, you need to run every microservice in a different port.

- It is recommeded to use docker-compose up and configure the forwarding ports for database and port of the microservice running
- Also it is important to configure the .env file with the microservice url using the port selected for each of them

#### environment variables auth-ms (following example)

APP_PORT=81
FORWARD_DB_PORT=3307

#### environment variables parking-lot-ms (following example)

APP_PORT=82
FORWARD_DB_PORT=3308
MS_AUTH_URL=http://host.docker.internal:81/api

#### environment variables payment-ms (following example)

APP_PORT=83
FORWARD_DB_PORT=3309
MS_AUTH_URL=http://host.docker.internal:81/api
MS_PARKING_URL=http://host.docker.internal:82/api

Note: the MS_AUTH_URL and MS_PARKING_URL are the url of the microservices auth-ms and parking-lot-ms respectively
Note: the FORWARD_DB_PORT is the port where the database is outside in the container
Note: the APP_PORT is the port where the microservice is running outside the container

4. Run the migrations:

```bash
    vendor/bin/sail artisan migrate
```

5. Run the seeders:

```bash
    vendor/bin/sail artisan db:seed
```

### Documentation

Follow the next link to see the documentation of the microservices: https://documenter.getpostman.com/view/9154195/2s93CLuESB
