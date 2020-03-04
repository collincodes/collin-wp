startup() {
  cd /var/www/html &&
  rm -rf wp-content/themes/twenty* &&
  rm -rf wp-content/plugins/hello.php wp-content/plugins/akismet &&
  chmod -R 755 . &&
  cd wp-content/themes/$1;
}
