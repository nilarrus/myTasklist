<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>My Task List</title>
  </head>
  <?php
  $db = parse_url(getenv("DATABASE_URL"));

$PDO = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
//$Query = $PDO -> ("SELECT * FROM mytask;");
 ?>
  <body>
    <h1>PLUS ULTRA!! TASKAS EDITYON</h1>
    <?php echo "
    <div>
    <form>
        Nova tasca:
        <input type='text' name='nom'>
        <input type='submit'>
    </form>
    </div>
    "; ?>
  </body>
