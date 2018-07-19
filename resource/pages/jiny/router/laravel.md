# 라라벨 라우팅

라라벨은 `app/routes.php`안에 정의되어 있습니다.

라라벨 라우느는 URI에 따는 골백 처리 함수로 제작이 됩니다.

입력된 HTTP 요청에 따라 동작을 달리 설정할 수 있습니다.

만일 GET으로 요청이 들어온 경우

```
Route::get('/',function()
{
    return "GET=Hello World";
})
```

와 같이 설정을 할 수 있습니다.

POST의 경우에는 get 매소드명 대신에 post 메소드를 사용하면 됩니다.

```
Route::post('/',function()
{
    return "POST=Hello World";
})
```

만일 두개 HTTP요청에 대해서 동시에 동작을 하고자 하는 경우에는 any 메소드 명을 사용하면 됩니다.

```
Route::any('/',function()
{
    return "Hello World";
})
```

https 접속을 구분하고자 하는 경우에는 
```
Route::get('foo', array('https', function()
{
    return 'Must be over HTTPS';
}));
```
로 작성을 하면 됩니다.

## 매개변수

```
Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});
```

선택적인 라우트 매개 변수

```
Route::get('user/{name?}', function($name = null)
{
    return $name;
});
```
기본값이 부여된 선택적인 라우트 매개 변수

```
Route::get('user/{name?}', function($name = 'John')
{
    return $name;
});
```

## 정규표현식

```
Route::get('user/{name}', function($name)
{
    //
})
->where('name', '[A-Za-z]+');

Route::get('user/{id}', function($id)
{
    //
})
->where('id', '[0-9]+');
```

물론, 필요하다면 여러개의 제약을 배열로 전달 할 수도 있습니다:
```
Route::get('user/{id}/{name}', function($id, $name)
{
    //
})
->where(array('id' => '[0-9]+', 'name' => '[a-z]+'))
```

## 필터
필터는 라우트를 처리하기 전에 접근제한을 설정하는데 매우 유용합니다.


라우트 필터는 주어진 라우트에 대해 액세스를 제한하는 편리한 방법을 제공하며, 이는 인증이 필요한 사이트의 영역을 만드는데 유용합니다. Laravel 은 auth 필터, auth.basec 필터, guest 필터, 그리고 csrf 필터를 포함하고 있습니다. 이 필터들은 app/filters.php 파일 안에 있습니다.

라우트 필터 정의

Route::filter('old', function()
{
    if (Input::get('age') < 200)
    {
        return Redirect::to('home');
    }
});
만약 필터에서 응답이 리턴되는 경우, 해당 응답은 요청에 의한 응답으로 간주되며 실제 라우트는 실행되지 않고, 그 라우트의 다음(나머지) 필터들 또한 취소 됩니다.

라우트에 필터를 부여

Route::get('user', array('before' => 'old', function()
{
    return 'You are over 200 years old!';
}));
라우트에 다수의 필터를 부여

Route::get('user', array('before' => 'auth|old', function()
{
    return 'You are authenticated and over 200 years old!';
}));
필터 매개 변수 지정

Route::filter('age', function($value, $request, $value)
{
    //
});

Route::get('user', array('before' => 'age:200', function()
{
    return 'Hello World';
}));
이후의 필터들은 필터의 세번째 인수를 $response로 전달 받습니다.:

Route::filter('log', function($route, $request, $response, $value)
{
    //
});
패턴 베이스 필터

또한 필터가 URI에 따라 해당 라우트 전체에 적용되도록 지정할 수 있습니다.

Route::filter('admin', function()
{
    //
});

Route::when('admin/*', 'admin');
위 예제에서 admin 필터는 admin/으로 시작하는 모든 라우트에 적용됩니다. 별표(*)는 와일드카드로 사용되며, 어떤한 문자조합과도 일치합니다.

또한, HTTP 동사에 의한 패턴 필터를 제한 할 수도 있습니다.:

Route::when('admin/*', 'admin', array('post'));
필터 클래스

클로저 대신 클래스를 사용하여 좀더 나은 필터링을 할수있습니다. 필터 클래스가 어플리케이션의 IoC 컨테이너 밖에서 해결되므로 높은 테스트성을 위해 이 필터에서 의존성 주입을 사용할 수 있습니다.

필터 클래스 정의

class FooFilter {

    public function filter()
    {
        // Filter logic...
    }

}
클래스 베이스 필터 등록

Route::filter('foo', 'FooFilter');

명칭이 붙여진 라우트
명칭이 붙여진 라우트는 리디렉트나 URL을 생성할때 좀더 편리하게 참조 될 수 있습니다. 이처럼 라우트에 대한 명칭을 지정할 수 있습니다.:

Route::get('user/profile', array('as' => 'profile', function()
{
    //
}));
또한 컨트롤러 액션에 라우트 명을 지정할 수도 있습니다.:

Route::get('user/profile', array('as' => 'profile', 'uses' => 'UserController@showProfile'));
이제, 라우트의 명칭을 사용하여 URL이나 리디렉트를 생성할 수 있습니다.:

$url = URL::route('profile');

$redirect = Redirect::route('profile');
currentRouteName 메소드를 통해 현재 실행 중인 라우트의 이름을 액세스 할 수 있습니다.:

$name = Route::currentRouteName();

라우트 그룹
가끔 필터를 라우트 무리에 적용해야 할때가 있을겁니다. 각각의 라우트에 필터를 지정하는 대신, 라우트 그룹을 사용하십시오.:

Route::group(array('before' => 'auth'), function()
{
    Route::get('/', function()
    {
        // Has Auth Filter
    });

    Route::get('user/profile', function()
    {
        // Has Auth Filter
    });
});

서브도메인 라우팅
Laravel 라우트는 와일드카드 서브도메인을 처리할 수 있으며, 도메인의 와일드카드 매개 변수를 넘겨 줍니다.:

서브도메인 라우트 등록

Route::group(array('domain' => '{account}.myapp.com'), function()
{

    Route::get('user/{id}', function($account, $id)
    {
        //
    });

});

라우트 접두사
group 메소드의 배열 속성에 prefix 옵션을 사용하여 그룹화된 라우트들에 접두사를 추가 할 수 있습니다.:

그룹화된 라우트들에 접두사 부여

Route::group(array('prefix' => 'admin'), function()
{

    Route::get('user', function()
    {
        //
    });

});

라우트 모델 바인딩
모델 바인딩은 모델 인스턴스를 라우트에 삽입 시켜주는 편리한 방법을 제공합니다. 예를 들어, 사용자의 ID를 삽입하는것 대신, 주어진 ID와 일치하는 사용자 모델 인스턴스 전체를 라우트에 삽입시킬 수 있습니다. 먼저, Route::model 메소드를 사용하여 주어진 매개 변수에 사용될 모델을 명시 합니다.:

모델에 매개 변수를 바인딩

Route::model('user', 'User');
다음, {user} 매개 변수를 포함하고 있는 라우트를 정의 합니다.:

Route::get('profile/{user}', function(User $user)
{
    //
});
{user} 매개 변수를 'User모델에 바인딩 했으므로,User인스턴스가 라우트에 삽입 될겁니다. 예를 들면,profile/1로의 요청은 ID 1을 갖고 있는User` 인스턴스를 삽입 할 겁니다.

노트: 만약 데이터베이스에 일치하는 모델 인스턴스가 없다면, 404 에러가 표시됩니다.

만약 사용자 정의 "찾을수 없음"을 명시하려면, model 메소드의 세번째 인수에 클로저를 전달 하면 됩니다.:

Route::model('user', 'User', function()
{
    throw new NotFoundException;
});
때때로, 라우트 매개 변수에 당신만의 방법을 사용하길 원할수도 있습니다. 그럴땐, Route::bind 메소드를 사용하면 됩니다.:

Route::bind('user', function($value, $route)
{
    return User::where('name', $value)->first();
});

404 에러 날리기
라우트에서 수동으로 404 에러를 발생시키는 방법은 2가지가 있습니다. 첫번째는 App::abort 메소드를 사용하는 겁니다.:

App::abort(404);
두번째는 Symfony\Component\HttpKernel\Exception\NotFoundHttpException 인스턴스를 던지는 겁니다.

404 예외를 처리하고 이러한 오류에 대해 사용자 정의 응답을 사용하는 방법에 대한 자세한 내용은 매뉴얼의 에러 섹션에서 찾을 수 있습니다.


컨트롤러로 라우팅
라라벨은 클로저로의 라우팅 뿐만 아니라 컨트롤러 클래스와 리소스 컨트롤러를 생성 하는 라우팅도 허용합니다.



