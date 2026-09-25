<?php
declare(strict_types=1);

/**
 * Antonius Restô — Página Inicial do Site Modelo
 *
 * Ponto de entrada do site modelo executável.
 * Carrega as configurações centrais e dados de cardápios, garantindo
 * escape de saída apropriado para HTML e URLs seguras.
 */

$config = require __DIR__ . '/../app/config/site.php';
$cardapios = require __DIR__ . '/../app/data/cardapios.php';

// Filtra as campanhas temáticas marcadas como ativas
$campanhasAtivas = array_filter(
    $cardapios['campanhas'] ?? [],
    static fn(array $item): bool => !empty($item['ativo'])
);

require __DIR__ . '/../app/views/partials/header.php';
?>

<main id="inicio">
  <!-- Apresentação Principal (Hero) -->
  <section class="hero" aria-label="Apresentação do Antonius Restô">
    <div class="wrap hero-content">
      <div class="eyebrow"><?= e($config['app']['location_badge']) ?></div>
      <h1>Sabores para<br>viver o momento.</h1>
      <p>Cozinha contemporânea, vinhos selecionados e encontros especiais no coração da Petrolina Antiga.</p>

      <div class="actions">
        <a class="button button-light hero-cta" href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
          <?= e($cardapios['oficial']['cta']) ?> ↗
        </a>
        <a class="button button-outline hero-cta" href="<?= e_url($config['links']['google_maps']) ?>" target="_blank" rel="noopener">
          Como chegar ↗
        </a>
      </div>

      <!-- Indicação discreta de imagem conceitual -->
      <div class="hero-note" role="note">
        Imagem gastronômica conceitual para este protótipo.
      </div>
    </div>
  </section>

  <!-- Barra de Acesso Rápido -->
  <section class="quick" aria-label="Acesso rápido aos cardápios e visita">
    <div class="wrap quick-grid">
      <a href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
        <div>
          <strong><?= e($cardapios['oficial']['titulo']) ?></strong>
          <span><?= e($cardapios['oficial']['subtitulo']) ?></span>
        </div>
        <b>↗</b>
      </a>

      <?php if (!empty($cardapios['happy_hour']['ativo'])): ?>
        <a href="<?= e_url($cardapios['happy_hour']['url']) ?>" target="_blank" rel="noopener">
          <div>
            <strong><?= e($cardapios['happy_hour']['titulo']) ?></strong>
            <span><?= e($cardapios['happy_hour']['subtitulo']) ?></span>
          </div>
          <b>↗</b>
        </a>
      <?php else: ?>
        <a href="#experiencia">
          <div>
            <strong>A Experiência</strong>
            <span>Casarão na Petrolina Antiga</span>
          </div>
          <b>↓</b>
        </a>
      <?php endif; ?>

      <a href="#visite">
        <div>
          <strong>Planeje a visita</strong>
          <span>Horários e localização</span>
        </div>
        <b>↓</b>
      </a>
    </div>
  </section>

  <!-- A Experiência / História breve da casa -->
  <section class="section" id="experiencia" aria-labelledby="titulo-experiencia">
    <div class="wrap intro">
      <div>
        <div class="eyebrow eyebrow-rust">A CASA</div>
        <h2 id="titulo-experiencia">Uma mesa com<br>história.</h2>
      </div>

      <div class="intro-copy">
        <p>
          O Antonius Restô ocupa um casarão revitalizado na Petrolina Antiga, onde arquitetura,
          convivência e gastronomia se encontram.
        </p>
        <p>
          O cardápio combina criações contemporâneas, referências regionais e uma seleção de vinhos
          para acompanhar cada ocasião.
        </p>
        <a class="text-link" href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
          Conhecer o cardápio ↗
        </a>
      </div>
    </div>
  </section>

  <!-- Cardápios e Sabores da Semana -->
  <section class="section cards-section" id="cardapios" aria-labelledby="titulo-cardapios">
    <div class="wrap">
      <div class="section-heading">
        <div>
          <div class="eyebrow eyebrow-rust">ALÉM DO CARDÁPIO OFICIAL</div>
          <h2 class="section-title" id="titulo-cardapios">Sabores da semana.</h2>
        </div>
        <p>
          Conheça a variedade da nossa cozinha contemporânea. Pratos principais, entradas, sobremesas e carta de vinhos estão reunidos no Cardápio Oficial da casa.
        </p>
      </div>

      <?php if (!empty($campanhasAtivas)): ?>
        <div class="cards">
          <?php foreach ($campanhasAtivas as $key => $item): ?>
            <article class="card" aria-labelledby="card-titulo-<?= e((string)$key) ?>">
              <div class="day"><?= e($item['dia'] ?? '') ?></div>
              <h3 id="card-titulo-<?= e((string)$key) ?>"><?= e($item['titulo'] ?? '') ?></h3>
              <p><?= e($item['resumo'] ?? '') ?></p>
              <?php if (!empty($item['url'])): ?>
                <a href="<?= e_url($item['url']) ?>" target="_blank" rel="noopener" aria-label="<?= e($item['titulo'] ?? '') ?>, abrir arquivo do cardápio em PDF">
                  <?= e($item['cta'] ?? 'Ver cardápio ↗') ?>
                </a>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="cards">
          <?php foreach ($cardapios['destaques_oficial'] as $index => $item): ?>
            <article class="card" aria-labelledby="card-destaque-<?= e((string)$index) ?>">
              <div class="day"><?= e($item['categoria']) ?></div>
              <h3 id="card-destaque-<?= e((string)$index) ?>"><?= e($item['titulo']) ?></h3>
              <p><?= e($item['resumo']) ?></p>
              <a href="<?= e_url($item['url']) ?>" target="_blank" rel="noopener" aria-label="<?= e($item['titulo']) ?>, consultar no cardápio oficial da casa em PDF">
                <?= e($item['cta']) ?>
              </a>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Visite: Endereço, Horários e Mapa -->
  <section class="visit" id="visite" aria-labelledby="titulo-visite">
    <div class="wrap visit-grid">
      <div>
        <div class="eyebrow">VENHA NOS VISITAR</div>
        <h2 id="titulo-visite">Seu próximo encontro começa aqui.</h2>

        <p class="visit-address">
          <?= e($config['address']['street']) ?><br>
          <?= e($config['address']['city']) ?>, <?= e($config['address']['state']) ?> · <?= e($config['address']['postal_code']) ?>
        </p>

        <a class="button button-light map-button" href="<?= e_url($config['links']['google_maps']) ?>" target="_blank" rel="noopener">
          Abrir rota no Google Maps ↗
        </a>
      </div>

      <div>
        <div class="eyebrow">HORÁRIOS PUBLICADOS PELA CASA</div>

        <div class="hours" role="table" aria-label="Horários de funcionamento do restaurante">
          <?php foreach ($config['hours'] as $entry): ?>
            <div role="row">
              <span role="rowheader"><?= e($entry['days']) ?></span>
              <strong role="cell"><?= e($entry['time']) ?></strong>
            </div>
          <?php endforeach; ?>
        </div>

        <p class="hours-note">
          <?= e($config['hours_note']) ?>
        </p>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../app/views/partials/footer.php'; ?>
