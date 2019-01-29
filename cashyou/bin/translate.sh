php bin/console translation:extract uk --config=app --output-format=yml
php bin/console translation:extract ru --config=app --output-format=yml
php bin/console translation:extract en --config=app --output-format=yml
php bin/console cache:clear