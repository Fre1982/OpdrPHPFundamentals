<?php

include_once 'inc/header.php';
require_once 'inc/db.class.php';


  session_start();
  // oude variabelen leeg meegeven
  $opost_id = "";  
  $otitle = "";
  $obody = "";
  
  if(isset($_GET['post_id'])){
    // via GET het post ophalen
    $opost_id = $_GET['post_id'];
    // verbinding maken met tabel en data ophalen adhv post
    $post->getDataById('blogg', $opost_id);
    
    $otitle = $data['title'];
    $obody = $data['body'];
  }

  if($_SERVER['REQUEST_METHOD']="POST")
  {
    if(isset($_POST['post_id']) && isset($_POST['title']) && isset($_POST['body'])){
        $post_id = empty($_POST['post_id']) ? 0 : $_POST['post_id'];        
        $title = empty($_POST['title']) ? "" : $_POST['title'];
        $body = empty($_POST['body']) ? "" : $_POST['body'];
        
        $post = new db();
        $post->updateData('blogg', $post_id,  $title, $body);
    }
    header('Location: index.php');
}

?>

<body>
       <div class="container">
         <div class="row">
           <div class="col-8 offset-2">
             <h1 class="text-center mt-2 pt-5 pb-2">Updaten Blog</h1>
             <div class="row">
               <form action="update.php" method="POST" class="mb-3 pl-2 pr-2">
                 <div class="form-group">
                  <label for="title">Titel</label>
                  <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" value="<?php echo $otitle; ?>" placeholder="Vul een titel in">
                </div>
                <div class="form-group">
                  <label for="body">Bericht</label>
                  <input type="text" class="form-control" id="body" name="body" value="<?php echo $obody; ?>"placeholder="Vul bericht in">
                </div>
                <input value="<?php echo $opost_id; ?>" name="post_id" type="hidden">
                <button type="submit" class="btn btn-primary" id="add" name="add">Opslaan</button>
               </form>
             </div>
           </div>
       </div>
     </div>
   </body>
<?php 



include_once 'inc/footer.php';