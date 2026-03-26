# SeminovosAPI

A **REST API for vehicle listings powered by a web crawler**.
The crawler periodically collects vehicle data from a marketplace and stores it in a database, allowing the API to serve fast filtered queries.

This project demonstrates backend concepts such as **web scraping, scheduled jobs, and REST API design**.

## Technologies

* **PHP**
* **Laravel Lumen** (micro-framework)
* **Eloquent ORM**
* **Goutte / Symfony DomCrawler** for web scraping
* **Cron scheduler** for automated crawling

---

# API Endpoints

## `/vehicle`

Returns all vehicles **paginated with 10 items per page**.

The endpoint supports filtering using the `filter` parameter.

### Examples

```
/vehicle?filter[brand]=Chevrolet
/vehicle?filter[model]=Corsa%20Hatch
/vehicle?filter[yearFrom]=2008
/vehicle?filter[yearTo]=2019
/vehicle?filter[priceFrom]=12000
/vehicle?filter[priceTo]=45000
/vehicle?filter[mileageFrom]=0
/vehicle?filter[mileageTo]=20000
```

Filters can be **combined in any combination**.

Example:

```
/vehicle?filter[brand]=Chevrolet&filter[priceTo]=30000
```

---

## `/vehicle/{id}`

Returns a **specific vehicle by its `id`**.

Example:

```
/vehicle/2397865
```

---

# Web Crawler

The web crawler is implemented using **Lumen's Scheduler**.

To enable scheduled execution, add the following entry to the server **crontab**:

```
* * * * * php [path-to-the-project]/seminovos/artisan schedule:run >> /dev/null 2>&1
```

After adding the entry, restart the cron service.

The crawler will run **once per day**, collecting vehicle listings and storing them in the database.

---

# Running the Crawler Manually

To run the crawler manually, execute the following command from the project directory:

```
php artisan schedule:run
```

---

# Project Purpose

This project was created to demonstrate:

* Web scraping with **Goutte**
* Scheduled background jobs using **Lumen Scheduler**
* REST API development with **Lumen**
* Database querying with **Eloquent ORM**
* API filtering and pagination

