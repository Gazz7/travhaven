<?php
$comments = getUserComments($_SESSION['user']->ID);
$posts = getUserPosts($_SESSION['user']->ID);
$user = getAll('users');

?>



<?php
if (isset($_SESSION['user'])) :

?>
    <div id="container">
        <h1>User Panel</h1>
        <div class="tabs-5">
            <ul class="tabs">
                <li><a href="#tab13">Create Post</a></li>
                <li><a href="#tab14">Edit and Delete Post</a></li>
                <li><a href="#tab16">Delete Comment</a></li>
                <li><a href="#tab17">User Profile</a></li>
                <li><a href="#tab18">Gallery</a></li>



            </ul>
            <section class="tab_content_wrapper">
                <article class="tab_content" id="tab13">
                    <form action="models/createPost.php" method="post" enctype="multipart/form-data">
                        <input type="title" name="title" placeholder="Post title...">
                        <textarea name="content" placeholder="Post Content"></textarea>
                        <input type="file" name="img">
                        <input type="hidden" name="ID" value="<?= $_SESSION['user']->ID ?>">
                        <input type="submit" name="post" value="Create Post">
                    </form>
                </article>
                <article class="tab_content" id="tab14">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">Blog ID</th>
                                    <th scope="col">Title </th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $b) : ?>
                                    <tr>
                                        <th scope="row"><?= $b->blog_ID ?></th>
                                        <td><?= $b->title ?></td>

                                        <td>
                                            <a href="index.php?page=edit&post=<?= $b->blog_ID ?>">
                                                <input type="button" value="Edit">

                                            </a>
                                        </td>
                                        <td>
                                            <form action="models/deletePost.php" method="post"><input type="submit" value="Delete">
                                                <input type="hidden" value="<?= $b->blog_ID ?> " name="ID">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </article>
                <article class="tab_content" id="tab15">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">Comment ID</th>
                                    <th scope="col"> Content</th>
                                    <th scope="col">Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $u) : ?>

                                    <tr>
                                        <th scope="row"><?= $u->comment_ID ?></th>
                                        <td><?= $u->content ?></td>
                                        <td>
                                            <form action="models/deleteComment.php" method="post">

                                                <input type="hidden" value="<?= $u->comment_ID ?>" name="ID">

                                                <input type="submit" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </article>
                <article class="tab_content" id="tab17">
                    <form action="models/editUser.php" method="post" enctype="multipart/form-data">

                        <label for="fname">Username</label>
                        <input type="text" id="fname" name="username" value="<?= $_SESSION['user']->username ?>">
                        <img src="assets/images/<?= $_SESSION['user']->image ?>" alt="">
                        </br>
                        <input type="file" name="fileImg">
                        <input type="hidden" name="idUser" value="<?= $_SESSION['user']->ID  ?>">
                        <input type="submit" value="Submit" id='proverax'>
                    </form>
                </article>
                <article class="tab_content" id="tab18">
                    <div class="row d-flex justify-content-around">
                        <?php foreach ($posts as $p) : ?>
                            <div class="col-6 d-flex justify-content-center">
                                <img href="" src="assets/images/<?= $p->images ?>">
                            </div>


                        <?php endforeach ?>
                    </div>
                </article>

            </section>
        </div>
    </div>
    <!-- jQueryTab.js -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="assets/js/jQueryTab.js"></script>

    <script type="text/javascript">
        // initializing jQueryTab plugin 
        $('.tabs-1').jQueryTab({
            initialTab: 2, // tab to open initially; start count at 1 not 0
            tabInTransition: 'fadeIn',
            tabOutTransition: 'scaleUpOut',
            cookieName: 'active-tab-1',
            tabPosition: 'bottom'
        });
        $('.tabs-2').jQueryTab({
            initialTab: 3,
            openOnhover: true,
            tabInTransition: 'flipIn',
            tabOutTransition: 'flipOut',
            cookieName: 'active-tab-2'

        });
        $('.tabs-3').jQueryTab({
            responsive: false,
            useCookie: false,
            initialTab: 1,
            tabInTransition: 'rotateIn',
            tabOutTransition: 'rotateOut',
            before: function() {
                console.log('Hello from before!');
            }, // function to call before tab is opened
            after: function() {
                console.log('Hello from after!')
            } // function to call after tab is opened

        });
        $('.tabs-4').jQueryTab({
            openOnhover: true,
            collapsible: false,
            initialTab: 4,
            tabInTransition: 'slideUpIn',
            tabOutTransition: 'slideUpOut',
            cookieName: 'active-tab-4'

        });
        $('.tabs-5').jQueryTab({
            initialTab: 3,
            tabInTransition: 'slideRightIn',
            tabOutTransition: 'slideRightOut',
            cookieName: 'active-tab-5'

        });
        $('.tabs-6').jQueryTab({
            initialTab: 4,
            tabInTransition: 'scaleDownIn',
            tabOutTransition: 'scaleDownOut',
            cookieName: 'active-tab-6'

        });
        $('.tabs-7').jQueryTab({
            initialTab: 2,
            tabInTransition: 'fadeIn',
            tabOutTransition: 'fadeOut',
            cookieName: 'active-tab-7'

        });
    </script>
<?php else :
    header("location:index.php?page=home") ?>

<?php endif ?>