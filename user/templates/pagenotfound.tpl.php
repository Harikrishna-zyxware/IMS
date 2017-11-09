<?php ob_start()?>
    <div>
        <h1>Not Found</h1>
        <p>The requested URL was not found on this server.</p>
        
    </div>
<?php
    $content = ob_get_clean();
    include './user/templates/layout.tpl.php';
    ?>
