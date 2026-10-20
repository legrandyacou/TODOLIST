<?php
require_once "dbconnexion_todolist.php";
 if($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['add'])){
         $task = htmlspecialchars($_POST['task']?? '');
         if($task === ""){
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
         }else{
            $insertion = $dbtodolist->prepare("INSERT INTO note(task) VALUES(:task)");
         $insertion-> execute(
          [
            'task'=>$task,
          ]
    );
         }
         
       
         header("Location: ". $_SERVER['PHP_SELF']);
        exit;  
 }

   $callTask = $dbtodolist->query("SELECT * FROM note");
   $tasks =$callTask->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET["delete"])){
    $id = $_GET["delete"];
    $dbtodolist->query("DELETE FROM note WHERE id= '$id' ");
      header("Location: ". $_SERVER['PHP_SELF']);
    }
 if(isset($_GET["complete"])){
    $id = $_GET["complete"];
    $dbtodolist->query("UPDATE note SET status='completed'  WHERE id= '$id'");
     header("Location: ". $_SERVER['PHP_SELF']);
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="img/bloc-notes.png" type="image/x-icon">
</head>
<body>
<section class="conteneur">
    <h1>To do List</h1>
    <form action="index.php" method="POST">
        <input type="text" placeholder=" write .." name="task">
        <button name="add">add</button>
    </form>
    <?php if(empty($tasks)):?>
        <p>aucune note enregistré</p>
      <?php else:?>  
        <ul >
       <?php foreach($tasks as $tas):?>
        
           <li class="boxTask" data-id="<?= htmlspecialchars($tas['id'])?>">
            <strong><?= htmlspecialchars($tas['task']) ?></strong>
            <div class="action">
                <a href="index.php?complete=<?= $tas["id"]?>">Complete</a>
                <a href="index.php?delete=<?= $tas["id"]?>">Delete</a>
            </div>
           </li> 
      
       <?php endforeach;?>
        </ul>
     <?php endif ?>  
</section>
</body>
</html>