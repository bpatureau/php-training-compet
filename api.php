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
