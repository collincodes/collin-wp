startup() {
  cd /var/www/html &&
  rm -rf wp-content/themes/twenty* &&
  rm -rf wp-content/plugins/hello.php wp-content/plugins/akismet &&
  chown -R www-data:www-data wp-content/ &&
  find wp-content/ -type d -exec chmod 755 {} + &&
  find wp-content/ -type f -exec chmod 644 {} + &&
  cd wp-content/themes/$1;
}

replace() {
  cd /var/www/html &&
  wp search-replace $1 'http://localhost:$2' --allow-root;
}
