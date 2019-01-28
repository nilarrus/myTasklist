<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>My Task List XD</title>
  </head>
 <?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo $_POST['nom'];
    $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
    or die('No se ha podido conectar: '.pg_last_error());
    $nom = $_POST['nom'];
    $result = pg_prepare($dbconn,"my_query",'INSERT INTO mytasks(descripcio,hecho) VALUES ($1,$2);');
    $result = pg_execute($dbconn,"my_query",array($nom,0));
  }

    //  $db = parse_url(getenv("DATABASE_URL"));
    $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
    or die('No se ha podido conectar: '.pg_last_error());
    $result = pg_prepare($dbconn,"my_query",'SELECT * FROM mytasks');
    $result = pg_execute($dbconn,"my_query");
  ?>
  <body>
    <h1>PLUS ULTRA!! TASKAS EDITYON</h1>
    <?php
    echo "
    <div>
    <form action='' method='post'>
        Nova tasca:
        <input type='text' name='nom'>
        <input type='submit' value='nova tasca'>
    </form>";
    echo "</div>";
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
   ?>
  </body>
