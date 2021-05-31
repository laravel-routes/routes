# Route Group Options

---

- [Prefix](#route-prefixes)
- [Name](#route-name-prefixes)
- [separator](#route-name-separator)

<a name="route-prefixes"></a>
## Group options

All route classes is grouped by default, sometimes we create routes with separate url,names,prefix 

to disabled grouping of route you can use `group` methods:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

    public $group = false;
    ....
```