LMS

using Kartik Practical-B project Template, Dektriun Yii User and mdm-soft admin (rbac)

clone the repository

open your command line and cd to the cloned repository

Run "composer install"

update your database on config/db.php

Then run - "php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations"

Then run - "php yii migrate --migrationPath=@yii/rbac/migrations"

before you begin open your config/web.php

update your "as access", uncomment the 'admin/' and 'user/' - comment again after you finish the guide.

then update the "enableRegistration" to "true" on the module section - to be able you can create your first user - return to false if you dont want to open the signup form

open your browser and signup your first user.

then go to the localhost/[your project name]/admin/route - add all the routes from left to right

then go to the localhost/[your project name]/admin/permision - add the permission (admin-permision) - then add /* routes from left to right (to view all route for admin users)

then go to the localhost/[your project name]/admin/role -add role (administrator) - then add the admin-permision from left to right

then go to localhost/[your project name]/admin/ -add the administrator role