# The Routing Component

4.1 version
edit this page

The Routing component maps an HTTP request to a set of configuration variables.
라우팅 컴포넌트는 HTTP 요청을 다른 구성값으로 설정하는 기능입니다. 

## 설치

```
composer require symfony/routing
```
Alternatively, you can clone the https://github.com/symfony/routing repository.

NOTE
If you install this component outside of a Symfony application, you must require the vendor/autoload.php file in your code to enable the class autoloading mechanism provided by Composer. Read this article for more details.

사용
This article explains how to use the Routing features as an independent component in any PHP application. Read the Routing article to learn about how to use it in Symfony applications.
In order to set up a basic routing system you need three parts:

A RouteCollection, which contains the route definitions (instances of the class Route)
A RequestContext, which has information about the request
A UrlMatcher, which performs the mapping of the request to a single route
Here is a quick example. Notice that this assumes that you've already configured your autoloader to load the Routing component:

```
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$route = new Route('/foo', array('_controller' => 'MyController'));
$routes = new RouteCollection();
$routes->add('route_name', $route);

$context = new RequestContext('/');

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');
// array('_controller' => 'MyController', '_route' => 'route_name')
```

NOTE
The RequestContext parameters can be populated with the values stored in $_SERVER, but it's easier to use the HttpFoundation component as explained below.

You can add as many routes as you like to a RouteCollection.

The RouteCollection::add() method takes two arguments. The first is the name of the route. The second is a Route object, which expects a URL path and some array of custom variables in its constructor. This array of custom variables can be anything that's significant to your application, and is returned when that route is matched.

The UrlMatcher::match() returns the variables you set on the route as well as the wildcard placeholders (see below). Your application can now use this information to continue processing the request. In addition to the configured variables, a _route key is added, which holds the name of the matched route.

If no matching route can be found, a ResourceNotFoundException will be thrown.

Defining Routes¶
A full route definition can contain up to seven parts:

The URL path route. This is matched against the URL passed to the RequestContext, and can contain named wildcard placeholders (e.g. {placeholders}) to match dynamic parts in the URL.
An array of default values. This contains an array of arbitrary values that will be returned when the request matches the route.
An array of requirements. These define constraints for the values of the placeholders as regular expressions.
An array of options. These contain internal settings for the route and are the least commonly needed.
A host. This is matched against the host of the request. See How to Match a Route Based on the Host for more details.
An array of schemes. These enforce a certain HTTP scheme (http, https).
An array of methods. These enforce a certain HTTP request method (HEAD, GET, POST, ...).
Take the following route, which combines several of these ideas:

 1
 2
 3
 4
 5
 6
 7
 8
 9
10
11
12
13
14
15
16
17
18
19
20
21
22
$route = new Route(
    '/archive/{month}', // path
    array('_controller' => 'showArchive'), // default values
    array('month' => '[0-9]{4}-[0-9]{2}', 'subdomain' => 'www|m'), // requirements
    array(), // options
    '{subdomain}.example.com', // host
    array(), // schemes
    array() // methods
);

// ...

$parameters = $matcher->match('/archive/2012-01');
// array(
//     '_controller' => 'showArchive',
//     'month' => '2012-01',
//     'subdomain' => 'www',
//     '_route' => ...
//  )

$parameters = $matcher->match('/archive/foo');
// throws ResourceNotFoundException
In this case, the route is matched by /archive/2012-01, because the {month} wildcard matches the regular expression wildcard given. However, /archive/foo does not match, because "foo" fails the month wildcard.

When using wildcards, these are returned in the array result when calling match. The part of the path that the wildcard matched (e.g. 2012-01) is used as value.

TIP
If you want to match all URLs which start with a certain path and end in an arbitrary suffix you can use the following route definition:

1
2
3
4
5
$route = new Route(
    '/start/{suffix}',
    array('suffix' => ''),
    array('suffix' => '.*')
);
Using Prefixes¶
You can add routes or other instances of RouteCollection to another collection. This way you can build a tree of routes. Additionally you can define a prefix and default values for the parameters, requirements, options, schemes and the host to all routes of a subtree using methods provided by the RouteCollection class:

 1
 2
 3
 4
 5
 6
 7
 8
 9
10
11
12
13
14
$rootCollection = new RouteCollection();

$subCollection = new RouteCollection();
$subCollection->add(...);
$subCollection->add(...);
$subCollection->addPrefix('/prefix');
$subCollection->addDefaults(array(...));
$subCollection->addRequirements(array(...));
$subCollection->addOptions(array(...));
$subCollection->setHost('admin.example.com');
$subCollection->setMethods(array('POST'));
$subCollection->setSchemes(array('https'));

$rootCollection->addCollection($subCollection);
Set the Request Parameters¶
The RequestContext provides information about the current request. You can define all parameters of an HTTP request with this class via its constructor:

 1
 2
 3
 4
 5
 6
 7
 8
 9
10
public function __construct(
    $baseUrl = '',
    $method = 'GET',
    $host = 'localhost',
    $scheme = 'http',
    $httpPort = 80,
    $httpsPort = 443,
    $path = '/',
    $queryString = ''
)
Normally you can pass the values from the $_SERVER variable to populate the RequestContext. But if you use the HttpFoundation component, you can use its Request class to feed the RequestContext in a shortcut:

use Symfony\Component\HttpFoundation\Request;

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());
Generate a URL¶
While the UrlMatcher tries to find a route that fits the given request you can also build a URL from a certain route:

 1
 2
 3
 4
 5
 6
 7
 8
 9
10
11
12
13
14
15
16
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('show_post', new Route('/show/{slug}'));

$context = new RequestContext('/');

$generator = new UrlGenerator($routes, $context);

$url = $generator->generate('show_post', array(
    'slug' => 'my-blog-post',
));
// /show/my-blog-post
NOTE
If you have defined a scheme, an absolute URL is generated if the scheme of the current RequestContext does not match the requirement.

Check if a Route Exists¶
In highly dynamic applications, it may be necessary to check whether a route exists before using it to generate a URL. In those cases, don't use the getRouteCollection() method because that regenerates the routing cache and slows down the application.

Instead, try to generate the URL and catch the RouteNotFoundException thrown when the route doesn't exist:

1
2
3
4
5
6
7
8
9
use Symfony\Component\Routing\Exception\RouteNotFoundException;

// ...

try {
    $url = $generator->generate($dynamicRouteName, $parameters);
} catch (RouteNotFoundException $e) {
    // the route is not defined...
}
Load Routes from a File¶
You've already seen how you can easily add routes to a collection right inside PHP. But you can also load routes from a number of different files.

The Routing component comes with a number of loader classes, each giving you the ability to load a collection of route definitions from an external file of some format. Each loader expects a FileLocator instance as the constructor argument. You can use the FileLocator to define an array of paths in which the loader will look for the requested files. If the file is found, the loader returns a RouteCollection.

If you're using the YamlFileLoader, then route definitions look like this:

1
2
3
4
5
6
7
8
# routes.yaml
route1:
    path:     /foo
    defaults: { _controller: 'MyController::fooAction' }

route2:
    path:     /foo/bar
    defaults: { _controller: 'MyController::foobarAction' }
To load this file, you can use the following code. This assumes that your routes.yaml file is in the same directory as the below code:

1
2
3
4
5
6
7
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

// looks inside *this* directory
$fileLocator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($fileLocator);
$routes = $loader->load('routes.yaml');
Besides YamlFileLoader there are two other loaders that work the same way:

XmlFileLoader
PhpFileLoader
If you use the PhpFileLoader you have to provide the name of a PHP file which returns a RouteCollection:

 1
 2
 3
 4
 5
 6
 7
 8
 9
10
11
12
// RouteProvider.php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add(
    'route_name',
    new Route('/foo', array('_controller' => 'ExampleController'))
);
// ...

return $routes;
Routes as Closures¶
There is also the ClosureLoader, which calls a closure and uses the result as a RouteCollection:

1
2
3
4
5
6
7
8
use Symfony\Component\Routing\Loader\ClosureLoader;

$closure = function () {
    return new RouteCollection();
};

$loader = new ClosureLoader();
$routes = $loader->load($closure);
Routes as Annotations¶
Last but not least there are AnnotationDirectoryLoader and AnnotationFileLoader to load route definitions from class annotations. The specific details are left out here.

NOTE
In order to use the annotation loader, you should have installed the doctrine/annotations and doctrine/cache packages with Composer.

TIP
Annotation classes aren't loaded automatically, so you must load them using a class loader like this:

1
2
3
4
5
6
7
8
9
use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/** @var ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
The all-in-one Router¶
The Router class is an all-in-one package to quickly use the Routing component. The constructor expects a loader instance, a path to the main route definition and some other settings:

1
2
3
4
5
6
7
public function __construct(
    LoaderInterface $loader,
    $resource,
    array $options = array(),
    RequestContext $context = null,
    LoggerInterface $logger = null
);
With the cache_dir option you can enable route caching (if you provide a path) or disable caching (if it's set to null). The caching is done automatically in the background if you want to use it. A basic example of the Router class would look like:

 1
 2
 3
 4
 5
 6
 7
 8
 9
10
$fileLocator = new FileLocator(array(__DIR__));
$requestContext = new RequestContext('/');

$router = new Router(
    new YamlFileLoader($fileLocator),
    'routes.yaml',
    array('cache_dir' => __DIR__.'/cache'),
    $requestContext
);
$router->match('/foo/bar');
NOTE
If you use caching, the Routing component will compile new classes which are saved in the cache_dir. This means your script must have write permissions for that location.

Unicode Routing Support¶
The Routing component supports UTF-8 characters in route paths and requirements. Thanks to the utf8 route option, you can make Symfony match and generate routes with UTF-8 characters:

Annotations
 1
 2
 3
 4
 5
 6
 7
 8
 9
10
11
12
13
14
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/category/{name}", name="route1", options={"utf8": true})
     */
    public function category()
    {
        // ...
    }
 
YAML
 
XML
 
PHP
In this route, the utf8 option set to true makes Symfony consider the . requirement to match any UTF-8 characters instead of just a single byte character. This means that so the following URLs would match: /category/日本語, /category/فارسی, /category/한국어, etc. In case you are wondering, this option also allows to include and match emojis in URLs.

You can also include UTF-8 strings as routing requirements:

Annotations
 1
 2
 3
 4
 5
 6
 7
 8
 9
10
11
12
13
14
15
16
17
18
19
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route(
     *     "/category/{name}",
     *     name="route2",
     *     requirements={"default"="한국어"},
     *     options={"utf8": true}
     * )
     */
    public function default()
    {
        // ...
    }
 
YAML
 
XML
 
PHP
TIP
In addition to UTF-8 characters, the Routing component also supports all the PCRE Unicode properties, which are escape sequences that match generic character types. For example, \p{Lu} matches any uppercase character in any language, \p{Greek} matches any Greek character, \P{Han} matches any character not included in the Chinese Han script.