# File sharing [![Build Status](https://travis-ci.org/Bocmah/file-sharing.svg?branch=master)](https://travis-ci.org/Bocmah/file-sharing)

## Prerequisites

In order to run this project you must have the following installed:
* PHP 7.1
* Composer
* npm  

You should also setup a web server in order to host your local domain. For these purposes you can use Laravel Homestead or Valet.

## Installation

Сlone GitHub repository locally:

```sh
$ git clone https://github.com/Bocmah/file-sharing.git
```

cd into the project folder and install Composer dependencies by running:

```sh
$ composer install
```

Install npm dependencies:

```sh
$ npm install
```

Copy the contents of `.env.example` file to new `.env` file:

```sh
$ cp .env.example .env
```

Create an application encryption key:

```sh
$ php artisan key:generate
```

Create an empty database and fill in the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` fields in the `.env` file to match the credentials of your newly created database.

Run the migrations:

```sh
$ php artisan migrate
```

## Features

* AJAX file uploading (drag and drop support included)
* User registration
* Anonymous uploads as well as user uploads
* Showing files uploaded by user on the user page
* Viewing recently uploaded files
* Viewing specific file page
* Showing metadata for audio, video and image files (i.e. bit rate for audio file)
* Preview for image files, players for audio and video files
* AJAX comments and replies on the file page