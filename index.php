<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>My Task List XD</title>
  </head>
 <?php
 echo "GET: ".var_dump($_GET);
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      echo "Dins el if";
    $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
    or die('No se ha podido conectar: '.pg_last_error());
    $nom = $_POST['nom'];
    $result = pg_prepare($dbconn,"my_query",'INSERT INTO mytasks(descripcio,hecho) VALUES ($1,$2);');
    $result = pg_execute($dbconn,"my_query",array($nom,0));
  }

    //  $db = parse_url(getenv("DATABASE_URL"));
    $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
    or die('No se ha podido conectar: '.pg_last_error());
    $result = pg_exec($dbconn,'SELECT * FROM mytasks');
    //echo "Resultat: ".var_dump($result);
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
          if($row['hecho']!=0){
            echo "\t\t<td>Hecho</td>\n";
            echo "\t\t<td>".$row['descripcio']."
            <a href='#?delete=".$row['id']."'>Eliminar</a></td>\n";
          }else{
            echo "\t\t<td>----</td>\n";
            echo "\t\t<td>".$row['descripcio']."
            <a href='index.php?delete=".$row['id']."'>Eliminar</a></td>\n";
          }
          echo "\t</tr>\n";
      }
      echo "</table>\n";
      // Liberando el conjunto de resultados
      pg_free_result($result);

      // Cerrando la conexión
      pg_close($dbconn);
   ?>
  </body>
