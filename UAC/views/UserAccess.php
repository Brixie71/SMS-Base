<?php

namespace PHPMaker2024\UAC;

// Page object
$UserAccess = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php include(dirname(__DIR__, 1) . "/app/pages/user-access.php"); ?>

<?= GetDebugMessage() ?>
