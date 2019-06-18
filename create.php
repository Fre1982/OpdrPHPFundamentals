<?php
include_once 'inc/header.php';
require_once 'inc/db.class.php';


  // kijken of de POST word uitgevoerd 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
    // Verwachte POST-vars gekend 
    if(isset($_POST['title']) && isset($_POST['body'])){
        // Data in variabelen steken, blanco's opvangen door default tekst
        
        $title = empty($_POST['title']) ? "no title" : $_POST['title'];
        $body = empty($_POST['body']) ? "no message" : $_POST['body'];
        

        // verbinding met tabel maken en nieuwe data inserten
        $db = new db();
        $db->createData('blogg', $title, $body);
    }
    header('Location: index.php');
}
?>

<body>
       <div class="container">
         <div class="row">
           <div class="col-8 offset-2">
             <h1 class="text-center mt-2 pt-5 pb-2">Nieuws</h1>
             <div class="row">
               <form action="create.php" method="POST" class="mb-3 pl-2 pr-2">
                 <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" placeholder="Vul een titel in">
                </div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <input type="text" class="form-control" id="body" name="body" placeholder="Vul bericht in">
                </div>
                <button type="submit" class="btn btn-succes" id="add" name="add">Toevoegen</button>
               </form>
             </div>
           </div>

          <?php
        
         ?>
       </div>
     </div>
   </body>

<?php
include_once 'inc/footer.php';