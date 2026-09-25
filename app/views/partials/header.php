<?php
declare(strict_types=1);

/**
 * Cabeçalho e abertura do documento HTML
 * @var array $config
 * @var array $cardapios
 */

// Dados estruturados Schema.org Restaurant estritamente baseados em informações confirmadas
$schemaRestaurant = [
    '@context' => 'https://schema.org',
    '@type' => 'Restaurant',
    'name' => $config['app']['name'],
    'description' => $config['seo']['description'],
    'servesCuisine' => 'Gastronomia contemporânea com referências regionais',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $config['address']['street'],
        'addressLocality' => $config['address']['city'],
        'addressRegion' => $config['address']['state'],
        'postalCode' => $config['address']['postal_code'],
        'addressCountry' => 'BR',
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => -9.4009619,
        'longitude' => -40.5026017,
    ],
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'],
            'opens' => '18:00',
            'closes' => '23:00',
        ],
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Friday', 'Saturday'],
            'opens' => '12:00',
            'closes' => '23:00',
        ],
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Sunday'],
            'opens' => '12:00',
            'closes' => '16:00',
        ],
    ],
    'hasMenu' => $cardapios['oficial']['url'] ?? '',
    'sameAs' => [
        $config['links']['instagram'],
        $config['links']['linkme'],
    ],
];
?>
<!doctype html>
<html class="no-js" lang="<?= e($config['seo']['lang']) ?>">
<head>
  <meta charset="utf-8">
  <script>document.documentElement.classList.replace('no-js', 'js');</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="<?= e($config['seo']['robots'] ?? 'noindex, nofollow') ?>">
  <title><?= e($config['seo']['title']) ?></title>
  <meta name="description" content="<?= e($config['seo']['description']) ?>">

  <!-- Favicon provisório usando o símbolo disponível -->
  <link rel="icon" type="image/png" href="assets/img/logo-linkme.png">

  <!-- Tipografia externa (Google Fonts) com conexões prévias otimizadas -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Libre+Caslon+Display&display=swap" rel="stylesheet">

  <!-- Folha de estilos própria -->
  <link rel="stylesheet" href="assets/css/style.css">

  <?php if (!empty($config['publishing']['approved']) && !empty($config['publishing']['enable_schema_restaurant'])): ?>
  <!-- Dados estruturados Restaurant (emitidos exclusivamente mediante aprovação explícita de publicação) -->
  <script type="application/ld+json">
<?= json_encode($schemaRestaurant, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
  </script>
  <?php endif; ?>
</head>
<body>
  <!-- Faixa de identificação do conceito -->
  <aside class="topline" aria-label="Aviso do site modelo">
    <?= e($config['app']['status_banner']) ?>
  </aside>

  <!-- Cabeçalho Principal -->
  <header class="header">
    <div class="wrap header-inner">
      <a class="brand" href="#inicio" aria-label="<?= e($config['app']['name']) ?>, voltar ao início">
        <img class="brand-mark" src="assets/img/logo-linkme.png" alt="Símbolo gráfico do Antonius Restô" width="35" height="35">
        <span class="brand-name">
          <?= e($config['app']['brand_title']) ?><small><?= e($config['app']['brand_subtitle']) ?></small>
        </span>
      </a>

      <!-- Navegação principal desktop e gaveta mobile -->
      <nav class="nav" id="menu-principal" aria-label="Navegação principal">
        <a href="#experiencia">A experiência</a>
        <a href="#cardapios">Cardápios</a>
        <a href="#visite">Horários e endereço</a>
      </nav>

      <!-- Grupo de ações à direita -->
      <div class="header-actions">
        <button type="button" class="nav-toggle" aria-expanded="false" aria-controls="menu-principal" aria-label="Alternar navegação do menu">
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
          <span class="sr-only">Menu</span>
        </button>

        <a class="button button-solid header-btn" href="<?= e_url($config['links']['instagram']) ?>" target="_blank" rel="noopener" aria-label="Abrir perfil oficial no Instagram em nova janela">
          Instagram ↗
        </a>
      </div>
    </div>
  </header>
