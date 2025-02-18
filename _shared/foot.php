<?php include(dirname(__DIR__, 1) . "/_shared/system.php"); ?>
<?php include(dirname(__DIR__, 1) . "/_shared/notification.php"); ?>

<script type="text/html" class="ew-js-template" data-name="appSwitcherDropdown" data-method="appendTo" data-target="#ew-navbar-end">
<li class="nav-item dropdown">
  <a class="nav-link" data-bs-toggle="dropdown" href="#">
    <i class="fa-solid fa-th-large"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
    <span class="dropdown-item dropdown-header"><a href="/" class="dropdown-item"><img src="../_shared/images/philtower-logo.svg" alt="PHILTOWER - PRIME" class="mr-2 app-icon" style="height: 50px;"></a></span>
    <div class="dropdown-divider"></div>
    <?php foreach ($SYSTEM as $key => $value) { ?>
      <a href="/<?= $key ?>" class="dropdown-item">
        <img src="../_shared/images/<?= $value["IMAGE"] ?>" alt="<?= $value["TITLE"] ?>" class="mr-2 app-icon" style="width: 24px; height: 24px;">
        <?= $value["TITLE"] ?>
      </a>
    <?php } ?>
    

  </div>
</li>
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  function updateAppIcons() {
    const isDarkMode = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const appIcons = document.querySelectorAll('.app-icon');
    appIcons.forEach(icon => {
      const src = icon.getAttribute('src');
      if (isDarkMode) {
        icon.setAttribute('src', src.replace('.png', '.png'));
      } else {
        icon.setAttribute('src', src.replace('.png', '.png'));
      }
    });
  }

  // Initial update
  updateAppIcons();

  // Listen for theme changes
  const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.type === "attributes" && mutation.attributeName === "data-bs-theme") {
        updateAppIcons();
      }
    });
  });

  observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['data-bs-theme']
  });
});
</script>
