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
    $db["ec2-54-243-150-10.compute-1.amazonaws.com"],
    $db["5432"],
    $db["nkbozhglxeacba"],
    $db["44f66b71869d41bf6b911906f1d0820ff112e8f1a1f431cd325b07ee234c2316"],
    ltrim($db["ddufqhqeeesvcb"], "/")
));
$Query = $PDO -> ("SELECT * FROM mytask;");
$Query ->execute();
$resu = $Query ->rowCount();

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
    echo $resu;
    "; ?>
  </body>
