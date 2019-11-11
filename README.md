# Quote API

This small application was written as extendable HTTP REST API (though with only one action available) using latest Slim 4 with PSR-7 implementation.

The idea behind this API is to return quotes of people formatted as if they were shouted, meaning all the letters will be uppercased and whole sentence will be followed by an exclamation mark.

## Install the Application

To install this app it is required to first clone its from the repository
```bash
git clone git@github.com:kubabialy/quote-api.git quote-api
```

You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

To run the application in development, you can run these commands 

```bash
cd quote-api
composer start
```

After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

## How does it work?

The idea is simple, this API accepts only one action that is a GET request on `/quotes/shout` URL followed by author name lower cased and separated by hyphen. Ex:
`http://localhost:8080/quotes/shout/steve-jobs?limit=5`

As probably noted, query parameter `limit` is added to the URL to limit the amount of quotes returned. The `limit` is an int that needs cannot be higher than 10.

Below example of a request and response that you can expect:

REQUEST: 
```bash
curl -s http://localhost:8080/quotes/shout/steve-jobs\?limit\=2
```

RESPONSE:
```
YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!,
THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!
```

