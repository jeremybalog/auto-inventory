<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?=!empty($title) ? "{$title} | {$company}" : $company; ?></title>

  <?=!empty($canonical) ? "<link rel=\"canonical\" href=\"{$baseUrl}{$canonical}\" />" : ''; ?>
  <?=!empty($metaDesc) ? "<meta name=\"description\" content=\"{$metaDesc}\">" : ''; ?>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/light.min.css" />
  <link rel="stylesheet" href="/css/grid.css" />
  <link rel="stylesheet" href="/css/theme.css" />

  <?=$head ?? '';?>
</head>
<body>
  <header>
    <a href="/">
      <img
        src="/img/logo.jpg"
        alt="<?=$company; ?>"
        title="<?=$company; ?> Logo"
        class="logo"
      />
    </a>
    <nav>
        <a href="/" title="Inventory Search">Inventory Search</a>
        <strong>|</strong>
        <a href="/login" title="Login">Login</a>
        <strong>|</strong>
        <a href="/error-page" title="Error Page">Error Page</a>
    </nav>
  </header>

  <main>
    <?=$main ?? '<h1>Page not found!</h1>';?>
  </main>

  <footer class="container">
    <div class="row">
    <?php
        $h3s = [
            "Inventory",
            "Finance",
            "Service & Parts",
            "Our Dealership"
        ];

        foreach($h3s as $h3) {
            echo "
              <div class='col-3'>
                <h3>{$h3}</h3>
                <a href='#'>Placeholder Link</a>
                <a href='#'>Placeholder Link</a>
                <a href='#'>Placeholder Link</a>
                <a href='#'>Placeholder Link</a>
              </div>
            ";
        }

    ?>
  </div>
  </footer>
</body>
</html>
