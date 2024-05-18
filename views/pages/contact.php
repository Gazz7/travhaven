<div class="row">
    <div class="col-12 d-flex justify-content-center">

        <div class="col-10 ">
            <form action="models/send_msg.php" method="post">

                <label for="subject">Subject</label>
                <input type="text" name="subject" placeholder="">
                <label for="content">Content</label>
                <textarea id="content" name="content" placeholder="Write something.." style="height:200px"></textarea>
                <span></span>

                <?php
                if (isset($_SESSION['user'])) :

                ?>
                    <input id="emailM" type="email" name="email" value="<?= $_SESSION['user']->email ?>" placeholder="your email">
                    <span></span>
                <?php endif ?>
                </br>
                <?php
                if (!isset($_SESSION['user'])) :

                ?>
                    <label for="email">Email</label>
                    <input id="emailM" type="email" name="email" placeholder="your email">
                    <span></span>
                    </br>
                <?php endif ?>
                <input type="submit" value="Send messages" id="btn" disabled>
            </form>


        </div>

    </div>