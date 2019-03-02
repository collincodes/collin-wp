startup() {
  rm -rf wp-content/themes/twenty* &&
  rm -rf wp-content/plugins/hello.php wp-content/plugins/akismet &&
  chmod -R 777 . &&
  cd wp-content/themes/$1 &&
  npm run install &&
  gulp;
}
