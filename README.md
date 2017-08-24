# Translator

This project aims at providing a website to translate and verify translations of
REDCap languages files.

## Docker deployement

This section describes the deployement with docker. A standard deployement is
possible but not presented here.

### Requirements

The procedure have been tested with the following tools:

- `docker >= 17`
- `docker-compose >= 1.15`

It may work with older version, but this is not guaranteed to work.

### First deployment

First build all the needed containers:

    docker-compose build
    
Then start the MariaDB database in background with:

    docker-compose up -d db

Wait a few seconds to let MariaDB time to start, then install laravel
dependencies with:

    docker-compose run install
    
Populate the database structure and data:

    docker-compose run migrate
    
And finally run the website:

    docker-compose up -d website
    
You can the access it on `http://localhost/`
