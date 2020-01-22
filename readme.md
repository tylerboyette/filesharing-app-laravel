# File sharing [![Build Status](https://travis-ci.org/Bocmah/file-sharing.svg?branch=master)](https://travis-ci.org/Bocmah/file-sharing)

## Prerequisites

In order to run this project you must have the following installed:
* PHP 7.1
* Composer
* npm  

You should also setup a web server in order to host your local domain. For these purposes you can use Laravel Homestead or Valet.

## Installation

Сlone GitHub repository locally:


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

Create a symbolic link from `public/storage` to `storage/app/public`:

```sh
$ php artisan storage:link
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

## Screenshots
![image](https://user-images.githubusercontent.com/32432647/46261877-66329e80-c502-11e8-81a3-2d22a1a83816.png)
![image](https://user-images.githubusercontent.com/32432647/46261884-86625d80-c502-11e8-9982-8745a45eef27.png)
![image](https://user-images.githubusercontent.com/32432647/46261889-8bbfa800-c502-11e8-9f06-3281983c93da.png)
![image](https://user-images.githubusercontent.com/32432647/46261891-911cf280-c502-11e8-9039-29f3e25a2d7a.png)
![image](https://user-images.githubusercontent.com/32432647/46261895-9a0dc400-c502-11e8-8030-151a5ee102eb.png)
