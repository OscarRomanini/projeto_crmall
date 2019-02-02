<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
 * Date: 26/01/2019
 * Time: 10:00
 */

session_start();

if(isset($_SESSION['mensagem'])): ?>

<script>
    window.onload = function () {
        M.toast({html: '<?php echo $_SESSION['mensagem']; ?>'});
    };
</script>

<?php
endif;
session_unset();

?>