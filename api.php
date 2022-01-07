<?php 
    require_once("config.php");
    //$_POST='{"nom":"pierre"}';

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
      if(isset($_GET['id_books'])) : 
        $sql = sprintf("SELECT * FROM books WHERE id = %d", $_GET['id_books']);
        $req = $connect->query($sql);
        //secho $connect->error;
        $arrayDatas['nbhits'] = $req->num_rows;
        
        while($record = $req->fetch_object()) {
            $results[] = $record;
        }
        $arrayDatas['records'] = (isset($results)) ? $results : "";
        header('Content-Type: application/json');
        echo json_encode($arrayDatas);
      else :
      $sql = "SELECT * FROM `books`";

      $req = $connect->query($sql);
      echo $connect->error;
      $arrayDatas['nbhits'] = $req->num_rows;
      
      while($record = $req->fetch_object()) {
          $results[] = $record;
      }
      $arrayDatas['records'] = $results;
      header('Content-Type: application/json');
      echo json_encode($arrayDatas);
    endif;
    
    endif;

    if($_SERVER['REQUEST_METHOD'] == 'POST') :
      $data = file_get_contents("php://input");

      $data = json_decode($data);
      //myPrint_r($data);
      $title = $data->items[0]->volumeInfo->title;
      $author = $data->items[0]->volumeInfo->authors[0];
      $publisher = $data->items[0]->volumeInfo->publisher;
      $description = $data->items[0]->volumeInfo->description;
      $pageCount = $data->items[0]->volumeInfo->pageCount;
      $isbn = $data->items[0]->volumeInfo->industryIdentifiers[0]->identifier;
    endif;

    if(isset($data)):
      echo $sql = sprintf("INSERT INTO `books` (`title`, `publisher`, `isbn_13`, `pageCount`, `authors`, `description`) VALUES ('%s', '%s', %d, %d, '%s', '%s');",

        addslashes($title),
        addslashes($publisher),
        $isbn,
        $pageCount,
        addslashes($author),
        addslashes($description)
            );
            $connect->query($sql);
            echo $connect->error;
    endif;

    exit;











    $sql = sprintf("SELECT planning, idPersonnel, idUsers FROM bp_visite WHERE idVisite='%d'",
    addslashes($_SESSION['idVisite'])
  );
  $rq = $connect->query($sql);
  echo $connect->error;
  if ($rq->num_rows > 0) {
    while($row = $rq->fetch_assoc()) {
      $_SESSION['idPersonnel'] = $row["idPersonnel"];
      $_SESSION['planning'] = $row["planning"];
      $_SESSION['idUsers'] = $row["idUsers"];
    }
  }
  $sql = sprintf("SELECT nom, prenom FROM bp_users WHERE idUsers='%d'",
  addslashes($_SESSION['idUsers'])
);
$request = $connect->query($sql);
echo $connect->error;
if ($rq->num_rows > 0) {
  while($row = $request->fetch_assoc()) {
    $_SESSION['nomUser'] = $row["nom"];
    $_SESSION['prenomUser'] = $row["prenom"];
  }
}
$time = date('Y-m-d H:i:s');
myPrint_r($time);
if(isset($_POST['sortie'])):
  myPrint_r($time);
  $sql = sprintf("UPDATE `bp_visite` SET `dateHeureDepart` = '%s'  WHERE `bp_visite`.`idVisite` = %d",
          $time,
          addslashes($_SESSION['idVisite'])
        );
        $connect->query($sql);
        echo $connect->error;
endif;
if(isset($_SESSION['idPersonnel']) && !empty($_SESSION['idPersonnel'])) :
  $url = $_SESSION['idPersonnel'];
  $json = file_get_contents("https://firestore.googleapis.com/v1/".$url);
  $data = json_decode($json);
    ?>
  <p>Personnel à rencontrer: <?php echo $data->fields->prenom->stringValue; ?> <?php echo $data->fields->nom->stringValue; ?></p>
  <p>Téléphone de <?php echo $data->fields->prenom->stringValue; ?>: <?php echo $data->fields->tel->stringValue; ?></p>
  <p>Salle: <?php echo $data->fields->salle->stringValue; ?></p>
    <?php endif;?>
    <?php if(isset($_SESSION['planning']) && !empty($_SESSION['planning'])) :
      $url = $_SESSION['planning'];
      $json = file_get_contents("https://firestore.googleapis.com/v1/".$url);
      $data = json_decode($json);
      $_SESSION['urlcours'] = $data->fields->cours->referenceValue;
      $url = $_SESSION['urlcours'];
      $json = file_get_contents("https://firestore.googleapis.com/v1/".$url);
      $datacours = json_decode($json);
?>

<h1>étiquette</h1>

<p>nom: <?php echo $_SESSION['nomUser'] ?></p>
<p>prenom: <?php echo $_SESSION['nomUser'] ?></p>
  <p>cours: <?php echo $datacours->fields->label->stringValue; ?></p>
  <p>Salle du cours: <?php echo $data->fields->salle->stringValue; ?></p>
    <?php endif;?>
    <script src="script/etiquette.js"></script>