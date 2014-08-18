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
run `php artisan configh:publish howlowck/socrata` then change the values according under `app/config/packages/howlowck/socrata/config.php`

### add service provider (optional)
In `app/config/app.php` add the following in Service Provider
```
"Howlowck\Socrata\SocrataChicagoServiceProvider"
```

That will load the Socrata Chicago Data Portal routes, and register the wrapper as a singleton.

## Usage
**Create a Socrata Instance**  
If you didn't use the service provider, you can easily create a Socrata instance like so:
```php
$soc = new Howlowck\Socrata\Socrata($baseUrl, $secret_token, $public_token);
```

**Create a Request**  
Without service provider (con't from above)
```php
$request = $soc->createRequest('7as2-ds3y');
```

Or with service provider loaded for Chicago

```php
$request  = App::make('socrata-chicago')->createRequest('7as2-ds3y');
```

**filter on Socrata datasource with SoQL query**  
You can use [query keywards outlined on socrata's site](http://dev.socrata.com/docs/queries.html) as methods

```php
$request->where('number_of_potholes_filled_on_block>3');
$request->select('zip');
```

**simple filter**  
You can also run any [simple filters](http://dev.socrata.com/docs/filtering.html) as methods.  

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


