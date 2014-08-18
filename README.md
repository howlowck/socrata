# Socrata
-
An easy API wrapper for Socrata API using Guzzle

## Feature
- Easily intergrates with Laravel
- Chicago Service provider

## "Install"
### add to composer.json
in `composer.json` add following in `require`:
```
"howlowck/socrata": "dev-master"
```

### set configuration file (optional)
- option 1: Set $_ENV value  
The package is set to automatically pull the `$_ENV` values of `socrata_secret_token`, `socrata_public_token`, `socrata_chicago_url` in the configuration

- option 2: Publish configuration file
run `php artisan configh:publish howlowck/socrata` then change the values according under `app/config/packages/howlowck/socrata/config.php`

### add service provider (optional)
In `app/config/app.php` add the following in Service Provider
```
"Howlowck\Socrata\SocrataChicagoServiceProvider"
```

That will load the Socrata Chicago Data Portal routes, and register the wrapper as a singleton.

## Usage
**Create a Request**
```php
$request  = App::make('socrata-chicago')->createRequest('7as2-ds3y');
```

**filter on tables**  
You can use [query keywards outlined on socrata's site](http://dev.socrata.com/docs/queries.html) as methods

```php
$request->where('number_of_potholes_filled_on_block>3');
$request->select('zip');
```

**simple filter**  
You can also run any simple filters as methods.  

```php
$request->status('Completed');
```

**get Response**  
Response will be return as [GuzzleHttp\Message\Response](http://api.guzzlephp.org/class-Guzzle.Http.Message.Response.html) which then can be turned into number of formats

To get JSON from response  
```php
$response = $req->get();
$jsonResponse = $response->json();
```


