# MetaTag

[![Build Status](https://travis-ci.org/danmurf/MetaTag.svg?branch=master)](https://travis-ci.org/danmurf/MetaTag)

A library for aggregating and generating html head meta tags. Great for MVC apps; include your meta tags in your controllers and output the result in your views.

To get started, install the library with composer:

`composer require danmurf/metatag`

Start up the library:

```php
use danmurf\MetaTag;

class MyController
{
  public function index()
  {
    $metatag = new MetaTag();
    //...
  }
}
```

Add page keywords:

```php
$metatag->setKeywords(['awesome', 'weblog', 'writings']);
```

Add a page description:

```php
$metatag->setDescription("This weblog is about...");
```

Add an author tag:

```php
$metatag->setAuthor("Jessie Wongus");
```

Set the page's canonical URL
```php
$metatag->setCanonicalUrl("https://www.example.com/splendid");
```

If you'd rather hide the page from search engines:

```php
$metatag->setNoindex(true);
```

Then add the output to your view / template to render the meta tags:

```php
$metatag->render();
```

Final output:

```html
<meta name="keywords" content="awesome, weblog, writings">
<meta name="description" content="This weblog is about...">
<meta name="author" content="Jessie Wongus">
<link rel="canonical" href="https://www.example.com/splendid">
```

If you like to keep your output tidy, add an indent of 4 spaces to your meta tags:

```php
$metatag->render(4);
```

## License

The MetaTag library is released under the [MIT license](https://opensource.org/licenses/MIT).

## Contributions

Any contributions or suggestions welcome. Please submit pull requests to the 'develop' branch.
