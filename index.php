<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>My Task List</title>
  </head>
  <?php
//  $db = parse_url(getenv("DATABASE_URL"));
$dbconn = pg_connect("host=ec2-54-243-150-10.compute-1.amazonaws.com dbname=ddufqhqeeesvcb user=nkbozhglxeacba password=44f66b71869d41bf6b911906f1d0820ff112e8f1a1f431cd325b07ee234c2316")
or die('No se ha podido conectar: '.pg_last_error());
$result = pg_exec('SELECT * FROM mytask');
 ?>
  <body>
    <h1>PLUS ULTRA!! TASKAS EDITYON</h1>
    <?php
    // Imprimiendo los resultados en HTML
      echo "<table>\n";
      while ($row = pg_fetch_array($result)) {
          echo "\t<tr>\n";
          echo "\t\t<td>".$row['descripcio']."</td>\n";
          echo "\t</tr>\n";
      }
      echo "</table>\n";

      // Liberando el conjunto de resultados
      pg_free_result($result);

      // Cerrando la conexión
      pg_close($dbconn);

    echo "
    <div>
    <form>
        Nova tasca:
        <input type='text' name='nom'>
        <input type='submit'>
    </form>";
    echo "</div>";
   ?>
  </body>
