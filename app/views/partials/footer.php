<?php
declare(strict_types=1);

/**
 * Rodapé e encerramento do documento HTML
 * @var array $config
 * @var array $cardapios
 */
?>
  <footer class="footer" role="contentinfo">
    <div class="wrap footer-container">
      <div class="footer-grid">
        <!-- Coluna 1: Posicionamento da Marca -->
        <div class="footer-col footer-col-brand">
          <a class="footer-brand" href="#inicio" aria-label="<?= e($config['app']['name']) ?>, voltar ao topo">
            <img class="footer-logo" src="assets/img/logo-linkme.png" alt="Símbolo gráfico do Antonius Restô" width="32" height="32">
            <span class="footer-brand-title">
              <?= e($config['app']['brand_title']) ?><small><?= e($config['app']['brand_subtitle']) ?></small>
            </span>
          </a>
          <p class="footer-desc">
            Cozinha contemporânea, vinhos selecionados e encontros em um casarão revitalizado na Petrolina Antiga.
          </p>
          <address class="footer-address">
            <strong><?= e($config['address']['street']) ?></strong><br>
            <?= e($config['address']['city']) ?>, <?= e($config['address']['state']) ?> · CEP <?= e($config['address']['postal_code']) ?>
          </address>
        </div>

        <!-- Coluna 2: Navegação -->
        <div class="footer-col">
          <h3 class="footer-heading">Navegação</h3>
          <ul class="footer-links">
            <li><a href="#inicio">Início</a></li>
            <li><a href="#experiencia">A Casa & Experiência</a></li>
            <li><a href="#cardapios">Cardápio Oficial</a></li>
            <li><a href="#ambientes">O Casarão & Espaços</a></li>
            <li><a href="#visite">Horários & Localização</a></li>
          </ul>
        </div>

        <!-- Coluna 3: Canais e Links Oficiais -->
        <div class="footer-col">
          <h3 class="footer-heading">Canais Oficiais</h3>
          <ul class="footer-links">
            <li>
              <a href="<?= e_url($cardapios['oficial']['url']) ?>" target="_blank" rel="noopener">
                Cardápio Oficial (PDF 7 págs) ↗
              </a>
            </li>
            <li>
              <a href="<?= e_url($config['links']['google_maps']) ?>" target="_blank" rel="noopener">
                Traçar Rota no Google Maps ↗
              </a>
            </li>
            <li>
              <a href="<?= e_url($config['links']['instagram']) ?>" target="_blank" rel="noopener">
                Instagram @antoniusresto ↗
              </a>
            </li>
            <li>
              <a href="<?= e_url($config['links']['linkme']) ?>" target="_blank" rel="noopener">
                Central Linkme.bio Oficial ↗
              </a>
            </li>
          </ul>
        </div>

        <!-- Coluna 4: Horários da Casa -->
        <div class="footer-col">
          <h3 class="footer-heading">Horários da Casa</h3>
          <div class="footer-hours-list">
            <?php foreach ($config['hours'] as $entry): ?>
              <div class="footer-hour-item">
                <span><?= e($entry['days']) ?></span>
                <strong><?= e($entry['time']) ?></strong>
              </div>
            <?php endforeach; ?>
          </div>
          <p class="footer-hours-note">
            Programação sujeita a alterações em feriados e datas comemorativas.
          </p>
        </div>
      </div>

      <!-- Barra Inferior de Direitos e Isenção do Modelo -->
      <div class="footer-bottom">
        <div class="footer-bottom-info">
          <p class="footer-copy">
            <?= e($config['app']['name']) ?> · <?= e($config['address']['short_location']) ?>
          </p>
          <p class="footer-concept-note">
            Site modelo conceitual e independente, sujeito à validação direta com o restaurante.
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Script leve para aprimoramento progressivo -->
  <script src="assets/js/main.js" defer></script>
</body>
</html>
