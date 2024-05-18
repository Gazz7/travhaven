<?php if (isset($_GET['post'])) :
    $post = getSinglePost($_GET['post'])[0];



?>


    <div id="tekst-contact">
        <form action="models/editPost.php" method="post" enctype="multipart/form-data">

            <label for="fname">Title</label>
            <input type="text" id="fname" name="title" value="<?= $post->title ?>">
            <textarea name="contentE"><?= $post->content ?></textarea>
            <img src="assets/images/<?= $post->images ?>" alt="">
            <input type="file" name="file">
            <input type="hidden" name="idEdit" value="<?= $post->blog_ID ?>">

            <input type="submit" value="Submit" id='provera'>
        </form>



    </div>
<?php else : echo "<h1>Please select post</h1>" ?>
<?php endif ?>