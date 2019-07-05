# iBus Job Scraper
Job scraper assignemnt for iBus Media

## Installation:

* Download missing dependencies using composer. Use:
```composer install```

## Scraping commands:

* To run the job scraping script form root directory use:
```php bin/console scrapeIbus```

* To run the JSON validation script from root directory use:
```php bin/console validateJson```

## Api endpoint:

* Start the default Symfony server by running:
php bin/console server:run

* Access data by visiting ```localhost:8000/jobs```



