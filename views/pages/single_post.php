<?php

if (isset($_GET['post'])) :
    $post = getSinglePost($_GET['post']);
    $postovi = getUserPosts($post[0]->author_ID);

    // number of coumments
    $comment = getCommentsForBlog($_GET['post']);
    // comments content
    $commentData = getCommentContent($post[0]->blog_ID);
    $posts = numPost($postovi[0]->blog_ID);

?>

    <?php foreach ($postovi as $p) : ?>
        <div id="post-1">

            <!-- Post -->
            <article class="post postMax">
                <header>
                    <div class="title">
                        <h2><a href="#"><?= $p->title ?></a></h2>

                    </div>
                    <div class="meta">
                        <time class="published"><?= substr($p->created_at, 0, 10) ?></time>
                        <a href="#" class="author"><span class="name"><?= $post[0]->username ?></span><img src="assets/images/<?= $post[0]->image ?>" class="imgP" alt="<?= $p->title ?>" /></a>
                    </div>
                </header>
                <span class="image featured"><img src="assets/images/<?= $p->images ?>" alt="" /></span>
                <p><?= $p->content ?></p>
                <footer>
                    <ul class="stats">
                        <li><a class="icon solid fa-heart likesx" ss="<?= $p->blog_ID ?>" id="b<?= $p->blog_ID ?>"><?= getLikes($p->blog_ID)->Num ?></a></li>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <input type="hidden" id="like" value="<?= $_SESSION['user']->ID ?>">
                        <?php endif ?>
                        <li><a href="#" class="icon solid fa-comment"><?= getCommentsForBlog($p->blog_ID)[0]->Num ?></a></li>
                    </ul>
                </footer>
            </article>
            <?php if (isset($_SESSION['user'])) : ?>
                <form action="models/insert_comment.php" method="post" id="form-comment">
                    <input type="hidden" value="<?= $_SESSION['user']->ID ?>" name="user">
                    <input type="hidden" value="<?= $p->blog_ID ?>" name="post">
                    <label for="subject">Comment</label>
                    <textarea id="subject" name="comment" placeholder="Write something.." style="height:600px; border:none;"></textarea>
                    <input type="submit" value="Send comment">
                </form>

            <?php endif; ?>

            <div class="card">
                <!-- COMMENTS -->
                <div class="card-body">
                    <p>
                        <button class="recentCom" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                            View comments
                        </button>
                    </p>

                </div>

                <div class="comment-widgets m-b-20 res">
                    <div style="min-height: 120px;">
                        <div class="collapse collapse-horizontal" id="collapseWidthExample">
                            <div class="card card-body">
                                <?php
                                $comments = getCommentContent($p->blog_ID);
                                foreach ($comments as $comm) :
                                ?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="p-2"><span class="round"><img src="assets/images/<?= $comm->image ?>" alt="user" width="50" class="imgP"></span></div>
                                        <div class="comment-text w-100 tbColor">
                                            <h5><?= $comm->username ?></h5>
                                            <div class="comment-footer">
                                                <span class="date"><?= substr($comm->created_at, 0, 10) ?></span>

                                            </div>
                                            <p class="m-b-5 m-t-10 "><?= $comm->content ?></p>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    <?php endforeach; ?>


<?php endif;
if (!isset($_GET['post'])) {
    echo ('<h1>IZABERI POST<h1>');
}
?>