<?php
declare(strict_types=1);

/**
 * Rodapé e encerramento do documento HTML
 * @var array $config
 */
?>
  <footer class="footer">
    <div class="wrap footer-inner">
      <span><?= e($config['app']['name']) ?> · <?= e($config['address']['short_location']) ?></span>

      <span>
        <a href="<?= e_url($config['links']['instagram']) ?>" target="_blank" rel="noopener">Instagram</a>
        ·
        <a href="<?= e_url($config['links']['linkme']) ?>" target="_blank" rel="noopener">Links oficiais</a>
      </span>

      <span class="concept-note">
        Site modelo conceitual e independente; sujeito à validação direta com o restaurante.
      </span>
    </div>
  </footer>

  <!-- Script leve para aprimoramento progressivo -->
  <script src="assets/js/main.js" defer></script>
</body>
</html>
