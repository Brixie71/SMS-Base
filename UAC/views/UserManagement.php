<?php

namespace PHPMaker2024\UAC;

// Page object
$UserManagement = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php include(dirname(__DIR__, 1) . "/app/pages/security-management.php"); ?>

<?= GetDebugMessage() ?>
