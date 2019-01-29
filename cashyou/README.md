## Local development instructions:

#### 1. Install 3d party vendors  

```
composer install
npm install
bower install
```

#### 2. Run local server

```
php bin/console server:start
```

#### 3 Build assets and start watcher

```
gulp
```

#### 4. Visit localhost:8000

## Other commands:

#### Stop server
```
php bin/console server:stop
```
#### Build assets for production
```
gulp done
```

#### Update translation files
```
sh bin/translate.sh
```

or manually: 
```
php bin/console translation:extract uk --config=app --output-format=yml
php bin/console translation:extract ru --config=app --output-format=yml
php bin/console cache:clear
```
