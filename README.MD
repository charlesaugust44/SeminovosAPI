# SeminovosAPI
An API feeded by a web crawler

## Endpoints

### `\vehicle\` 

Returns all vehicles paginated on 10 itens per page, this page also can be filtered using on the parameters the array filter:

Ex:
```
\vehicle?filter[brand]=Chevrolet
\vehicle?filter[model]=Corsa%20Hatch
\vehicle?filter[yearFrom]=2008
\vehicle?filter[yearTo]=2019
\vehicle?filter[priceFrom]=12000
\vehicle?filter[priceTo]=45000
\vehicle?filter[mileageFrom]=0
\vehicle?filter[mileageTo]=20000
```

They can be used together on this endpoint in any combination.

### `\vehicle\2397865`

Returns a specific vehicle using the ´id´ property.

## Web Crawler

The web crawler was implemented using Lumen's scheluder, which means that to function properly a entry on the crontab server is necessary.

Put this line on your crontab file to configure th scheduler
```
* * * * * php [path-to-the-project]/seminovos/artisan schedule:run >> /dev/null 2>&1
```
Then restart the crontab service. The crawler will run once a day getting all the vehicles to the database.

