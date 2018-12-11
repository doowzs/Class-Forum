# JB Online

**Note:** The project has changed its name from "Class-Forum" 
to "JB Online". 

This is the public code repository for JB Online 
website, based on Laravel 5.6 and written in PHP 7+.

## Installation

Requirements:
- PHP 7.1+
  - with ``gd2``, ``path_info``, ``mbstring``, ``exif`` modules installed.
  - enabled ``proc_open`` and other functions in 
    ``php.ini`` config file.
- SQL 5.6+
- Apache (recommended) / Nginx

You can refer to the start guide and documentation 
of Laravel-boilerplate. But there are some difference.

1. First, install dependencies using composer and npm. Run 

   ```shell
   composer install
   npm install
   ```

2. Second, create database by copying a .env file 
   and run the following commands.

   ```shell
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   php artisan passport:install --force
   php artisan storage:link
   ```

   This would create an administrator whose
   student ID is 10000 and password is 'secret'. 
   You can login using this account.
   
   As a reminder, if you cloned the repository using Git,
   you have to pay special attention to the file privileges
   or you may suffer from finding the cause of HTTP 500 errors.

3. (optional) Build **minimized** stylesheets and scripts using

   ```shell
   npm run production
   ```

4. Don't forget to create scheduled tasks

   ```
   crontab -e
   
   ... (your tasks)
   * * * * * php /path/to/artisan schedule:run > /path/to/log_file
   ```

   Now you can enjoy the forum!
 
6. Caching
    ```
    php artisan config:cache
    php artisan route:cache
    ```
    helps to cache configure file and routes. To disable caching, use 'clear' instead.
 
## API Usage

### List of APIs

- `/api/login` - Sign in using credentials
- Through `auth:api` middleware:
  - `/api/logout` - Revoke user's current token
  - `/api/notice` - Fetch the current notice
  - `/api/assignments` - Fetch the current ongoing assignments
  - `/api/assignment/{$id}/finish` - Mark an assignment as finished
  - `/api/assignment/{$id}/reset` - Mark an assignment as unfinished
 
**Note: Assignment ID is specified by link address, not a request parameter**
  

You need to use "POST" verb for all APIs. API will return a JSON object on success, 
with status code 200. On auth failure, status code 401 will be returned.

Below is an example of HTTP headers for API visit (tested in PHPStorm):

````http request
Accept: "application/json"
Cache-Control: "no-cache"
````

### Sign in and go through ``auth`` guard

To visit all APIs behind ``auth`` guard, you need to sign in
using API and get the token of your account.

Make a POST request to ``/api/login`` with the following
**request parameters**:
````http request
student_id = yourID
password = yourPW
````

On success, server will return a JSON Object in the following format:
````json
{
  "status": "success",
  "message": "Successfully logged in as Admin.",
  "user_id": "10000",
  "user_name": "Admin",
  "token": "eyJ0eXAiO..."
}
````

You need to save the "token" field. And for all of your sequent requests, add the following **header** to your request:
````http request
Authorization: "Bearer eyJ0eXAiO... (yourToken)"
````

**The string "Bearer" is required** so that the server will know how to 
validate your identification using the token given.

### JSON Objects of Different APIs

- Auth Failure (401)
    ````json
    { "message":"Unauthenticated." }
    ````
- Login: described as above.
- Logout:
    ````json
    {
      "status": "success",
      "message": "Successfully logged out as Admin."
    }
    ````
- Get the otice:
    ````json
    {
      "data": {
        "content": "<p>Test<\/p>",
        "updated_at": "2018-12-04 23:03:44"
      }
    }
    ````
- Get assignments:
    ````json
    {
      "data": [
        {
          "id": 1,
          "course_id": 1,
          "name": "测试1",
          "content": "<p>test1<\/p>",
          "due_time": "2019-09-01 21:59:59",
          "issuer": 0,
          "finished": false
        }
      ]
    }
    ````
- Finish/reset assignment: assignments will also be returned so that 
you can also update the status of all assignments with one request. 
    ````json
    {
      "status": "success",
      "data": [ "..." ]
    }
    ````

## Laravel Kernel Commands

JB Online has 2 kernel commands described below:
- ``forum::updatefeeds`` caches feeds for 30 min intervals.
- ``forum::checkassignments`` checks assignments that will due 
soon (today and tomorrow) and send warning emails at 22:30.

## Contact

If you have any issues about safety or functions, you are welcome to open an issue to this repository.
Questions about how to install/modify codes are not welcomed.

## License and Credit

*   [Bootstrap 4](http://getbootstrap.com/) as layout framework.
*   [Carbon 2](https://carbon.nesbot.com/) and [laravel-carbon-2](https://github.com/kylekatarnls/laravel-carbon-2) for time localization and display.
*   [Elfinder](https://github.com/Studio-42/elFinder) and [laravel-elfinder](https://github.com/barryvdh/laravel-elfinder) for file storage.
*   [Glide](http://glide.thephpleague.com/) for image processing.
*   [Headroom.js](https://github.com/WickyNilliams/headroom.js) for hiding navigation bar.
*   [Highlight.JS](https://highlightjs.org/) for code formatting.
*   [jQuery](http://jquery.com/), [jQuery UI](https://jqueryui.com/) and [jQuery-Confirm v3](https://github.com/craftpip/jquery-confirm) for JS based utils.
*   [Laravel 5.6](https://laravel.com/) as PHP framework.
*   [Laravel Boilerplate](http://laravel-boilerplate.com/) as code basement.
*   [MathJax](https://www.mathjax.org/) for TeX and LaTeX display.
*   [TinyMCE 4](https://www.tiny.cloud/) as WYSIWYG editor.
*   All icons from [FlatIcon](https://www.flaticon.com/).