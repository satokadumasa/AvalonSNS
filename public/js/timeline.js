function getUpdatedData() {
  $data = getData();
  $temp = $data;
  while ($temp === $data) {
    $temp = getData();
    sleep(1);
  }
  return $temp;
}