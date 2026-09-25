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
      <p>Cozinha contemporânea autoral, vinhos selecionados e encontros marcantes no casarão revitalizado da Petrolina Antiga.</p>

      <div class="actions">
        <a class="button button-light hero-cta" href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
          <?= e($cardapios['oficial']['cta']) ?> ↗
        </a>
        <a class="button button-outline hero-cta" href="<?= e_url($config['links']['google_maps']) ?>" target="_blank" rel="noopener">
          Como chegar no mapa ↗
        </a>
      </div>

      <!-- Indicação discreta de imagem conceitual -->
      <div class="hero-note" role="note">
        Imagem gastronômica ilustrativa para este protótipo · Aguarda acervo oficial do restaurante.
      </div>
    </div>
  </section>

  <!-- Barra de Acesso Rápido -->
  <section class="quick" aria-label="Acesso rápido aos cardápios e visita">
    <div class="wrap quick-grid">
      <a href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
        <div>
          <strong><?= e($cardapios['oficial']['titulo']) ?></strong>
          <span><?= e($cardapios['oficial']['subtitulo']) ?> (PDF 7 páginas)</span>
        </div>
        <b aria-hidden="true">↗</b>
      </a>

      <?php if (!empty($cardapios['happy_hour']['ativo'])): ?>
        <a href="<?= e_url($cardapios['happy_hour']['url']) ?>" target="_blank" rel="noopener">
          <div>
            <strong><?= e($cardapios['happy_hour']['titulo']) ?></strong>
            <span><?= e($cardapios['happy_hour']['subtitulo']) ?></span>
          </div>
          <b aria-hidden="true">↗</b>
        </a>
      <?php else: ?>
        <a href="#ambientes">
          <div>
            <strong>O Casarão & Espaços</strong>
            <span>Arquitetura e atmosfera intimista</span>
          </div>
          <b aria-hidden="true">↓</b>
        </a>
      <?php endif; ?>

      <a href="#visite">
        <div>
          <strong>Planeje a visita</strong>
          <span>Horários da semana e localização</span>
        </div>
        <b aria-hidden="true">↓</b>
      </a>
    </div>
  </section>

  <!-- A Casa & Experiência / Narrativa Histórica -->
  <section class="section" id="experiencia" aria-labelledby="titulo-experiencia">
    <div class="wrap intro">
      <div>
        <div class="eyebrow eyebrow-rust">A CASA & HISTÓRIA</div>
        <h2 id="titulo-experiencia">Uma mesa com<br>história e memória.</h2>

        <div class="intro-badges" aria-label="Diferenciais da experiência">
          <div class="intro-badge">
            <strong>Casarão revitalizado</strong>
            <span>Um endereço na Petrolina Antiga</span>
          </div>
          <div class="intro-badge">
            <strong>Cozinha contemporânea</strong>
            <span>Criações e referências regionais no cardápio</span>
          </div>
          <div class="intro-badge">
            <strong>Vinhos e encontros</strong>
            <span>Uma carta para acompanhar a experiência</span>
          </div>
        </div>
      </div>

      <div class="intro-copy">
        <p>
          Em um casarão revitalizado na Petrolina Antiga, o Antonius Restô reúne cozinha contemporânea,
          referências regionais e uma seleção de vinhos. O ambiente convida a desacelerar e aproveitar a mesa.
        </p>
        <p>
          Entre entradas para compartilhar, pratos principais e sobremesas, o cardápio oferece opções para
          diferentes momentos — de um jantar a dois a uma reunião entre amigos.
        </p>
        <p>
          Conheça os destaques abaixo e consulte o cardápio oficial para ver a oferta completa da casa.
        </p>
        <a class="text-link" href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
          Explorar o cardápio oficial completo (PDF 7 páginas) ↗
        </a>
      </div>
    </div>
  </section>

  <!-- Cardápios / Destaques da Cozinha Contemporânea -->
  <section class="section cards-section" id="cardapios" aria-labelledby="titulo-cardapios">
    <div class="wrap">
      <?php if (!empty($campanhasAtivas)): ?>
        <!-- Apresentação de Campanhas Ativas (quando validadas e ativadas na configuração) -->
        <div class="section-heading">
          <div>
            <div class="eyebrow eyebrow-rust">PROGRAMAÇÃO SEMANAL</div>
            <h2 class="section-title" id="titulo-cardapios">Sabores da semana.</h2>
          </div>
          <p>
            Cardápios temáticos publicados pela casa. Consulte condições e disponibilidade atualizadas antes da sua visita.
          </p>
        </div>

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
        <!-- Apresentação dos Destaques Gastronômicos Oficiais (Padrão quando campanhas estão inativas) -->
        <div class="section-heading">
          <div>
            <div class="eyebrow eyebrow-rust">CARDÁPIO OFICIAL DA CASA</div>
            <h2 class="section-title" id="titulo-cardapios">Destaques da Cozinha Contemporânea.</h2>
          </div>
          <p>
            Uma síntese das criações autorais da casa. Conheça as entradas para compartilhar, os pratos principais com assinatura regional e as sobremesas que completam a experiência.
          </p>
        </div>

        <!-- Grade de Destaques Gastronômicos (sem botões repetitivos por item) -->
        <div class="menu-showcase-grid">
          <?php foreach ($cardapios['destaques_oficial'] as $index => $item): ?>
            <article class="showcase-card" aria-labelledby="showcase-categoria-<?= e((string)$index) ?>">
              <div class="showcase-tag"><?= e($item['categoria']) ?></div>
              <h3 id="showcase-categoria-<?= e((string)$index) ?>" class="showcase-title"><?= e($item['titulo']) ?></h3>
              <p class="showcase-desc"><?= e($item['descricao']) ?></p>

              <div class="showcase-divider" aria-hidden="true"></div>

              <ul class="showcase-dishes" aria-label="Pratos em destaque nesta categoria">
                <?php foreach ($item['itens'] as $prato): ?>
                  <li>
                    <span class="bullet" aria-hidden="true">✦</span>
                    <span class="dish-name"><?= e($prato) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </article>
          <?php endforeach; ?>
        </div>

        <!-- Bloco de Ação Único e Proeminente para o Cardápio Oficial Completo -->
        <div class="menu-banner-cta">
          <div class="menu-banner-info">
            <span class="menu-banner-badge"><?= e($cardapios['oficial']['badge'] ?? 'PDF Oficial · 7 páginas') ?></span>
            <h3>Consulte o cardápio completo da casa</h3>
            <p>
              O arquivo oficial reúne todas as opções de entradas, pratos contemporâneos, cortes nobres, peixes do São Francisco, massas artesanais, opções vegetarianas, sobremesas, coquetéis autorais e carta de vinhos.
            </p>
          </div>
          <div class="menu-banner-action">
            <a class="button button-solid menu-unified-btn" href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
              Abrir Cardápio Oficial Completo ↗
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- O Casarão & Espaços (Estruturado para fotos oficiais com indicação conceitual) -->
  <section class="section spaces-section" id="ambientes" aria-labelledby="titulo-ambientes">
    <div class="wrap">
      <div class="section-heading">
        <div>
          <div class="eyebrow eyebrow-rust">ARQUITETURA & AMBIÊNCIA</div>
          <h2 class="section-title" id="titulo-ambientes">O Casarão e seus Ambientes.</h2>
        </div>
        <p>
          Conheça a fachada e alguns ambientes em registros publicados no Instagram do Antonius Restô.
        </p>
      </div>

      <div class="spaces-grid">
        <!-- Espaço 1: Fachada e Entrada -->
        <article class="space-card" aria-labelledby="espaco-fachada">
          <div class="space-visual-frame">
            <img class="space-photo" src="assets/img/fachada-instagram.png" alt="Fachada noturna do Antonius Restô, com letreiro iluminado e entrada aberta" width="540" height="906" loading="lazy" decoding="async">
            <div class="space-frame-inner" aria-hidden="true">
              <span class="space-icon">01</span>
              <span class="space-frame-label">A chegada</span>
              <span class="space-frame-sub">Fachada e entrada</span>
            </div>
          </div>
          <div class="space-content">
            <div class="space-tag">EXTERIOR & CHEGADA</div>
            <h3 id="espaco-fachada">O primeiro encontro com a casa</h3>
            <p>
              O endereço na Petrolina Antiga apresenta o casarão revitalizado onde funciona o Antonius Restô.
            </p>
            <div class="space-meta">
              <span>Petrolina Antiga</span>
              <span>Casarão revitalizado</span>
            </div>
          </div>
        </article>

        <!-- Espaço 2: Salão Principal -->
        <article class="space-card" aria-labelledby="espaco-salao">
          <div class="space-visual-frame">
            <img class="space-photo" src="assets/img/salao-instagram.png" alt="Vista interna de um salão do Antonius Restô, com mesas, janelas e detalhes do teto" width="535" height="908" loading="lazy" decoding="async">
            <div class="space-frame-inner" aria-hidden="true">
              <span class="space-icon">02</span>
              <span class="space-frame-label">O ambiente</span>
              <span class="space-frame-sub">Salão e convivência</span>
            </div>
          </div>
          <div class="space-content">
            <div class="space-tag">SALÃO PRINCIPAL</div>
            <h3 id="espaco-salao">Um lugar para estar</h3>
            <p>
              O registro mostra um dos ambientes da casa, com mesas, janelas e elementos decorativos.
            </p>
            <div class="space-meta">
              <span>Encontros à mesa</span>
              <span>Ambiente da casa</span>
            </div>
          </div>
        </article>

        <!-- Espaço 3: Convivência e Adega -->
        <article class="space-card" aria-labelledby="espaco-adega">
          <div class="space-visual-frame">
            <img class="space-photo" src="assets/img/ambiente-instagram.png" alt="Mesa posta e obra de arte em um dos ambientes do Antonius Restô" width="534" height="901" loading="lazy" decoding="async">
            <div class="space-frame-inner" aria-hidden="true">
              <span class="space-icon">03</span>
              <span class="space-frame-label">Os detalhes</span>
              <span class="space-frame-sub">Mesa, pratos e vinhos</span>
            </div>
          </div>
          <div class="space-content">
            <div class="space-tag">CONVIVÊNCIA & BRINDE</div>
            <h3 id="espaco-adega">O sabor de cada ocasião</h3>
            <p>
              Uma mesa posta e a arte na parede revelam parte da atmosfera registrada no restaurante.
            </p>
            <div class="space-meta">
              <span>Cardápio oficial</span>
              <span>Carta de vinhos</span>
            </div>
          </div>
        </article>
      </div>

      <p class="spaces-notice">
        Registros do <a href="<?= e_url($config['links']['instagram']) ?>" target="_blank" rel="noopener">Instagram @antoniusresto ↗</a>.
      </p>
    </div>
  </section>

  <!-- Visite: Endereço, Horários e Mapa -->
  <section class="visit" id="visite" aria-labelledby="titulo-visite">
    <div class="wrap visit-grid">
      <div class="visit-info">
        <div class="eyebrow">VENHA NOS VISITAR</div>
        <h2 id="titulo-visite">Seu próximo encontro começa aqui.</h2>

        <div class="visit-location-badge">
          <span>Casarão revitalizado · Petrolina Antiga</span>
        </div>

        <address class="visit-address">
          <strong><?= e($config['address']['street']) ?></strong><br>
          <?= e($config['address']['city']) ?>, <?= e($config['address']['state']) ?> · CEP <?= e($config['address']['postal_code']) ?>
        </address>

        <p class="visit-desc">
          Confira os horários publicados pela casa e abra a rota para planejar sua visita.
        </p>

        <div class="visit-actions">
          <a class="button button-light map-button" href="<?= e_url($config['links']['google_maps']) ?>" target="_blank" rel="noopener">
            Traçar rota no Google Maps ↗
          </a>
          <a class="button button-outline-light map-button" href="<?= e_url($config['links']['instagram']) ?>" target="_blank" rel="noopener">
            Acompanhar no Instagram ↗
          </a>
        </div>
      </div>

      <div class="visit-schedule">
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

        <div class="visit-contact-card">
          <h4>Canal de Atualizações</h4>
          <p>
            Informações sobre eventos especiais, programação musical ou novidades sazonais são compartilhadas em tempo real no canal oficial do restaurante.
          </p>
          <a class="visit-social-link" href="<?= e_url($config['links']['instagram']) ?>" target="_blank" rel="noopener">
            Seguir @antoniusresto no Instagram ↗
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../app/views/partials/footer.php'; ?>
