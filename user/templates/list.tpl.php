<?php ob_start() ?>
    <h2>List of Posts</h2>
    
    <!--TODO: loop through posts array and list the blog titles as an
    unordered list with link to the corresponding blog post.
    Eg. /boot-camp/show.php?id=123 -->
    <?php foreach($posts as $post):?>
        <ul>
            <li>
                <a href="index.php/show?id=<?= $post['id']?>"><?= $post['title']?></a>
                <br>
                <a href="index.php/delete=?<?= $post['id']?>" class="btn btn-danger">DELETE</a>
            </li>
        </ul>
    <?php endforeach;?>
<?php $content = ob_get_clean() ?>

<?php include 'templates/layout.tpl.php' ?>
