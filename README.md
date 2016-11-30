Yii 2 Toster Project
============================


INSTALLATION
------------

Edit the file `config/db.php` with db connection data:


### Install DB

~~~
php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations && yii migrate/up
~~~


Hit yes, yes.

then go to index, register user, login with username and have fun.

**NOTES:**
- You have to register user `admin` to play with administrative rights
- There's limitation on payment system return value
- For propper work of facebook login, place project sources under `local.toster` host

Please, consider donation.