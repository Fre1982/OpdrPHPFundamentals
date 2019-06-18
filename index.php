<?php
require_once 'inc/header.php';
require_once 'inc/db.class.php';

$db = new db();
$result = $db->getAllData('posts');
$db->getDataById('posts', 1);

?>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $row) : ?>
                        <tr>
                            <th scope="row"><?php echo $row['post_id']; ?></th>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['body']; ?></td>
                            
                            <td><a href="update.php?id=<?php echo $row['post_id']; ?>" class="btn btn-success" type="button">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row['post_id']; ?>" class="btn btn-danger" type="button">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <a href="create.php">Voeg een nieuwe toe</a>
        </div>
    </div>
</div>


<?php
require_once 'inc/footer.php';