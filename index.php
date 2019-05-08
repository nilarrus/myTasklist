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
    $task = $_GET['delete'];
    $query = $db->prepare("DELETE FROM mytasks WHERE id = ".$task.";");
    $query->execute();
 }
 if(isset($_GET['PorHacer'])){
  $query = $db->prepare("UPDATE mytasks SET hecho = 1 WHERE id = ".$_GET['PorHacer'].";");
  $query->execute();
 }
 if(isset($_GET['hecho'])){
  $query = $db->prepare("UPDATE mytasks SET hecho = 0 WHERE id = ".$_GET['hecho'].";");
  $query->execute();
}
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = $_POST['nom'];
    $query = $db->prepare("INSERT INTO mytasks (descripcio,hecho) VALUES ('".$nom."',0)");
    $query->execute();
  }
   //mostrar todo
    $result = $db->query("SELECT * FROM mytasks");
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
            echo "\t\t<td>Hecho <a href='index.php?PorHacer=".$row['id']."'>Cambiar</a></td>\n";
          }else{
            echo "\t\t<td>Por Hacer <a href='index.php?hecho=".$row['id']."'>Cambiar</a></td>\n";
          }         
          echo "\t</tr>\n";
      }
      echo "</table>\n";
   ?>
  </body>
