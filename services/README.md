We have a RESTful API service which is developed in Symfony MVC framework, to get parsed xml/json feeds data:

XML: http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=10
JSON: http://pf.tradetracker.net/?aid=1&type=json&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=10

Currently, I have pushed vendor folder in repo for your ease. You only need to copy services folder on php project directory to run.

API CALL: [GET]
http://localhost/feeds/services/web/app_dev.php/feeds?feed_url=<ENCODED_FEED_URL>

Example Use:
http://localhost/feeds/services/web/app_dev.php/feeds?feed_url=http%3A%2F%2Fpf.tradetracker.net%2F%3Faid%3D1%26type%3Djson%26encoding%3Dutf-8%26fid%3D251713%26categoryType%3D2%26additionalType%3D2%26limit%3D10

NOTE:
If API Service is not responding properly, then please check write permissions on cache and logs directory:

/var/www/html/feeds/services/app/cache

/var/www/html/feeds/services/app/logs


