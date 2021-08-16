# Финальный проект

cd code/skillfactory/module_39 && docker-compose up -d


Running the composer/composer image is as simple as follows:

$ docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer/composer install

$ docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer/composer dump-autoload
