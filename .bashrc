startup() {
  rm -rf /var/www/html/wp-content/themes/twenty* &&
  rm -rf /var/www/html/wp-content/plugins/hello.php &&
  cd /var/www/html/wp-content/themes/$1 &&
  npm run install &&
  gulp;
}
