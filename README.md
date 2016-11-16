# MetaTag

[![Build Status](https://travis-ci.org/danmurf/MetaTag.svg?branch=master)](https://travis-ci.org/danmurf/MetaTag)

A library for aggregating and generating html head meta tags. Great for MVC apps; include your meta tags in your controllers and output the result in your views.

To get started, install the library with composer:

`composer require danmurf/metatag`

Start up the library:

  use danmurf\MetaTag;

  class MyController
  {
    public function index()
    {
      $metatag = new MetaTag();
      //...
    }
  }

Add page keywords:

  $metatag->keywords(['awesome', 'weblog', 'writings']);

Add a page description:

  $metatag->description("This weblog is about...");

Add an author tag:

  $metatag->author("Jessie Wongus");

If you want to hide the page from search engines:

  $metatag->noindex(true);

Then add the output to your view / template to render the meta tags:

  $metatag->render();

Final output:

  <meta name="keywords" content="awesome, weblog, writings">
  <meta name="description" content="This weblog is about...">
  <meta name="author" content="Jessie Wongus">

If you like to keep your output tidy, add a indent of 4 spaces to your meta tags:

  $metatag->render(4);

## License

The MetaTag library is released under the [MIT license](https://opensource.org/licenses/MIT).

## Contributions

Any contributions or suggestions welcome. Please submit pull requests to the 'develop' branch.
