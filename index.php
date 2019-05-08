<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>My Task List XD</title>
  </head>
 <?php
  //conexion en PDO
      $database = parse_url(getenv("DATABASE_URL"));
      $db = new PDO("pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $database["host"],
        $database["port"],
        $database["user"],
        $database["pass"],
        ltrim($database["path"], "/")
      ));


 //echo "GET: ".var_dump($_GET);
 if(isset( $_GET['delete'] )){
   echo "En el get";
   $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
   or die('No se ha podido conectar: '.pg_last_error());
   $id = $_GET['delete'];
   echo $id;
   $result = pg_prepare($dbconn,"my_query",'DELETE FROM mytasks WHERE id LIKE $1;');
   echo $result;
   $result = pg_execute($dbconn,"my_query",$id);
 }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      echo "En el post";
    $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
    or die('No se ha podido conectar: '.pg_last_error());
    $nom = $_POST['nom'];
    $result = pg_prepare($dbconn,"my_query",'INSERT INTO mytasks(descripcio,hecho) VALUES ($1,$2);');
    $result = pg_execute($dbconn,"my_query",array($nom,0));
  }

    
    $result = $db->query("SELECT * FROM mytasks");
    /*
    $dbconn = pg_connect("host=ec2-107-21-224-76.compute-1.amazonaws.com dbname=d9tf9mvi6tvf71 user=xrnnfbpijdpmin password=e2f25edc7569735ac66c311c993f760c258fbdbb19a97e7650d1d6524cf9da80")
    or die('No se ha podido conectar: '.pg_last_error());
    $result = pg_exec($dbconn,'SELECT * FROM mytasks');*/
    echo "Resultat: ".var_dump($result);
  ?>
  <body>
    <h1>TASKAS EDITYON</h1>
    
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
      foreach($result as $row){
        echo "\t<tr>\n";          
          echo "\t\t<td>--".$row['id']."--</td>\n";
          echo "\t\t<td>".$row['descripcio']." <a href='index.php?delete=".$row['id']."'>Eliminar</a></td>\n";
          if($row['hecho']!=0){
            echo "\t\t<td>Hecho</td>\n";
          }else{
            echo "\t\t<td>Por Hacer</td>\n";
          }         
          echo "\t</tr>\n";
      }
      /*
      while ($row = pg_fetch_array($result)) {
          echo "\t<tr>\n";          
          echo "\t\t<td>--".$row['id']."--</td>\n";
          echo "\t\t<td>".$row['descripcio']." <a href='index.php?delete=".$row['id']."'>Eliminar</a></td>\n";
          if($row['hecho']!=0){
            echo "\t\t<td>Hecho</td>\n";
          }else{
            echo "\t\t<td>Por Hacer</td>\n";
          }         
          echo "\t</tr>\n";
      }*/
      echo "</table>\n";
      // Liberando el conjunto de resultados
      pg_free_result($result);

      // Cerrando la conexión
      pg_close($dbconn);
   ?>
  </body>
