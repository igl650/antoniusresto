# Antonius Restô — Site Modelo Executável

Versão executável, responsiva e independente do site institucional do **Antonius Restô**, desenvolvida em PHP 8.2+, HTML5 semântico, CSS próprio e JavaScript leve para aprimoramento progressivo.

O projeto é baseado nas pesquisas de `plano-e-pesquisa.md` e na direção visual de `prototipo-visual.html`. Não utiliza frameworks CSS ou JavaScript (como Bootstrap, Tailwind, jQuery ou React), banco de dados, CMS ou sistemas externos de rastreamento/analytics.

> **Sobre o carregamento tipográfico externo:** A única requisição externa do projeto é o carregamento das famílias tipográficas **Google Fonts** (`DM Sans` e `Libre Caslon Display`) via tags `<link>` otimizadas no cabeçalho. Essa escolha foi mantida no modelo para assegurar fidelidade visual aos mockups aprovados sem sobrecarregar o repositório local com fontes binárias. A folha de estilos declara fallbacks nativos (`Georgia, serif` e `system-ui, Arial, sans-serif`) caso a conexão externa esteja indisponível. Para uma eventual publicação offline autônoma, as fontes WOFF2 podem ser baixadas e hospedadas diretamente em `public/assets/fonts/`.

---

## 1. Como Executar Localmente

### Pré-requisitos
- **PHP 8.2 ou superior** instalado (testado com PHP 8.3.33).

### Localização do Executável e Configuração do PATH (Windows / WinGet)
Nesta máquina, o PHP 8.3 foi instalado via WinGet. No Windows, novos pacotes WinGet registram variáveis de ambiente no registro do usuário, o que significa que terminais abertos anteriormente podem não reconhecer o comando `php` de imediato.

1. **Testar se o PHP já responde no terminal:**
   ```powershell
   php -v
   ```
2. **Se o comando `php` não for reconhecido**, execute o comando abaixo para recarregar o PATH na sessão atual do PowerShell:
   ```powershell
   $env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")
   ```
3. **Localização física do executável via WinGet (caso queira chamar diretamente):**
   ```powershell
   # Caminho padrão da versão instalada pelo WinGet
   & "$env:LOCALAPPDATA\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe" -v
   ```
4. **Adicionar permanentemente ao PATH do usuário (opcional):**
   ```powershell
   [Environment]::SetEnvironmentVariable("Path", [Environment]::GetEnvironmentVariable("Path","User") + ";$env:LOCALAPPDATA\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe", "User")
   ```

### Inicialização do Servidor Embutido
1. No terminal, navegue até a pasta `site`:
   ```powershell
   cd c:\Users\Miguel\Documents\antonius-resto-planejamento\site
   ```
2. Inicie o servidor PHP apontando a raiz para `public`:
   ```powershell
   php -S localhost:8000 -t public
   ```
   *(Ou invocando o executável diretamente, se o PATH não estiver atualizado:)*
   ```powershell
   & "$env:LOCALAPPDATA\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe" -S localhost:8000 -t public
   ```
3. Abra seu navegador em:
   ```text
   http://localhost:8000
   ```
*(Para encerrar o servidor no terminal, pressione `Ctrl + C`).*

---

## 2. Controle de Homologação, Proteção contra Indexação e Schema.org

Como este projeto é um **modelo independente** contendo fotografia e logotipo provisórios, ele possui travas de segurança ativas para evitar indexação acidental como site oficial nos motores de busca (Google, Bing):

1. **Meta Robots `noindex, nofollow`:**
   Declarada em `app/config/site.php` e renderizada na `<head>` do documento, instruindo os rastreadores a não indexarem nem seguirem os links da página.
2. **Dados Estruturados `Restaurant` Condicionados:**
   O schema JSON-LD com os dados confirmados de endereço, coordenadas geográficas, horários e culinária foi mantido integralmente em `app/views/partials/header.php`, porém sua impressão no HTML fica **inativa por padrão** (`'enable_schema_restaurant' => false`), impedindo que buscadores criem fichas institucionais automáticas sem validação da casa.

### Como Homologar para Publicação Oficial (Após Validação do Restaurante)
Quando o Antonius Restô aprovar o site e fornecer as imagens definitivas:
1. Abra `app/config/site.php`;
2. No bloco `'seo'`, altere `'robots'` para permitir a indexação:
   ```php
   'seo' => [
       ...
       'robots' => 'index, follow',
   ],
   ```
3. No bloco `'publishing'`, ative a homologação e os dados estruturados:
   ```php
   'publishing' => [
       'approved' => true,
       'enable_schema_restaurant' => true,
   ],
   ```

---

## 3. Organização dos Arquivos

```text
site/
├── .gitignore                # Arquivos ignorados pelo repositório Git local
├── .vercelignore             # Arquivos locais excluídos da implantação
├── vercel.json               # Runtime PHP e rotas de produção na Vercel
├── api/
│   └── index.php            # Entrada da função PHP na Vercel
├── app/
│   ├── config/
│   │   └── site.php          # Dados da marca, horários, endereço, links oficiais e homologação
│   ├── data/
│   │   └── cardapios.php     # Links oficiais e chaves de ativação dos menus e campanhas
│   └── views/
│       └── partials/
│           ├── header.php    # Marca, noindex, navegação acessível e Schema.org condicional
│           └── footer.php    # Rodapé institucional, links oficiais e aviso de conceito
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css     # CSS autoral responsivo (390px, 768px, 1440px) com variáveis nativas
│   │   ├── img/
│   │   │   ├── hero-conceitual.png # Imagem gastronômica ilustrativa provisória
│   │   │   ├── logo-linkme.png     # Símbolo provisório do Linkme.bio
│   │   │   ├── *-instagram.png     # Registros dos ambientes enviados pelo usuário
│   │   │   └── *-nao-oficial.webp # Estudos visuais não utilizados na página
│   │   └── js/
│   │       └── main.js       # Comportamento acessível do menu mobile (toggle, Escape, foco)
│   └── index.php             # Página inicial com renderização dinâmica e escape de saída
└── README.md                 # Documentação e instruções operacionais
```

---

## 4. Gestão e Ativação de Cardápios e Campanhas (`app/data/cardapios.php`)

Por diretriz editorial e rigor factual, **todas as campanhas temáticas e o Happy Hour iniciam DESATIVADOS por padrão (`'ativo' => false`)**, pois suas condições comerciais e horários atuais não foram confirmados pelo restaurante:
- **Cardápio oficial:** Mantido ativo em destaque (`'ativo' => true`), com link direto para o PDF oficial de 7 páginas.
- **Happy Hour:** Desativado por padrão (`'ativo' => false`) devido ao conflito documental entre o PDF oficial (16h–20h) e stories do Instagram (sexta e sábado das 17h às 21h).
- **Segunda em etapas, Terça é Massa e Quarta Risoteando:** Desativados por padrão (`'ativo' => false`) até confirmação de vigência, preços e pratos participantes.
- **Taça Dobrada, Rolha Free e Happy Hour Fim de Semana:** Desativados por padrão (`'ativo' => false`).

### Destaques da cozinha com campanhas desativadas
Com as campanhas inativas, a página apresenta três grupos de pratos citados no cardápio oficial e um único botão para abrir o PDF completo. A seção “Sabores da semana” aparece apenas quando alguma campanha validada estiver ativa. A área “O Casarão e seus Ambientes” usa recortes de capturas dos stories enviados pelo usuário (prints 09–11), publicados no Instagram da casa. Para a versão oficial, solicitar os arquivos fotográficos originais.

### Como Reativar uma Campanha Após Confirmação
Basta abrir `site/app/data/cardapios.php` e alterar o campo `'ativo'` para `true`:
```php
'segunda_etapas' => [
    'ativo' => true,
    ...
],
```

---

## 5. Instruções para Troca de Imagens, Marca e Links

### A. Trocar a Imagem de Abertura (Hero)
A referência à imagem de abertura está centralizada em uma única variável CSS:
1. Salve a foto oficial em `site/public/assets/img/` (ex: `fachada-oficial.jpg`).
2. Em `site/public/assets/css/style.css`, altere apenas a variável `--hero-bg-image` em `:root`:
   ```css
   :root {
       ...
       --hero-bg-image: url('../img/fachada-oficial.jpg');
   }
   ```
   *(A mesma declaração abastece automaticamente as versões desktop e mobile).*
3. Em `site/public/index.php`, remova a div `<div class="hero-note" role="note">...</div>`.

### B. Trocar o Símbolo Provisório pelo Logotipo Vetorial Oficial
1. Salve o arquivo em `site/public/assets/img/` (ex: `logo-oficial.svg`).
2. Em `site/app/views/partials/header.php`, atualize a tag `<img>` da marca:
   ```html
   <img class="brand-mark" src="assets/img/logo-oficial.svg" alt="Logotipo Antonius Restô" width="36" height="36">
   ```

### C. Adicionar Canal Oficial de WhatsApp / Reservas (Quando Confirmado)
1. Em `site/app/config/site.php`, adicione a URL no array de links:
   ```php
   'links' => [
       ...
       'whatsapp' => 'https://wa.me/5587999999999',
   ],
   ```
2. Adicione o botão de reserva apontando para `<?= e_url($config['links']['whatsapp']) ?>`.

### D. Funcionamento da Navegação Mobile (Com e Sem JavaScript)
O cabeçalho foi construído com aprimoramento progressivo (*progressive enhancement*):
- **Com JavaScript:** Exibe botão hamburguer com toque confortável (mínimo de 44×44 px), atributos `aria-expanded` dinâmicos, fechamento via tecla `Escape` e fechamento ao clicar fora do menu.
- **Sem JavaScript:** A classe `.no-js` oculta o botão inoperante e exibe a lista de navegação diretamente no fluxo do cabeçalho em telas de até 900 px, garantindo acessibilidade e navegação completa sem quebras de layout.

---

## 6. Controle de Versão Local (Git)

O projeto está versionado em Git e publicado em [github.com/igl650/antoniusresto](https://github.com/igl650/antoniusresto). O repositório contém o código-fonte do site modelo; a publicação do código não equivale à aprovação do restaurante nem à implantação do site oficial.

- O arquivo `.gitignore` protege o histórico contra arquivos transitórios de sistema operacional (`Thumbs.db`, `.DS_Store`), configurações de IDEs (`.vscode/`, `.idea/`) e capturas de tela ou logs temporários.
- Para verificar o status do repositório local:
  ```powershell
  git status
  ```

### Hospedagem na Vercel

O site modelo está disponível em [antoniusresto.vercel.app](https://antoniusresto.vercel.app). A Vercel executa o PHP 8.3 pela função `api/index.php`, usando o runtime comunitário `vercel-php@0.7.4`; imagens, CSS e JavaScript da pasta `public/assets/` são servidos como arquivos estáticos. A configuração está em `vercel.json`.

O ambiente publicado continua com `noindex, nofollow` e avisos de site modelo. A hospedagem não representa aprovação do restaurante nem liberação para uso como site oficial. Para uma implantação manual da versão local, use `vercel deploy --prod` após autenticar a CLI na conta vinculada ao projeto.

---

## 7. Pendências Reais de Validação (Aguardam Confirmação do Antonius)

1. **Fotografias e Logotipo Oficiais:** Envio do logotipo vetorial em alta resolução (SVG) e fotografias autorizadas de fachada, ambiente e pratos para substituir os recursos conceituais.
2. **Canal Oficial de Atendimento/Reservas:** Confirmação do número de WhatsApp comercial ou sistema de reservas.
3. **Vigência das Ações Temáticas:** Confirmação de dias da semana, pratos participantes e preços de *Segunda em etapas*, *Terça é Massa*, *Quarta Risoteando*, *Taça Dobrada* e *Rolha Free*.
4. **Horário do Happy Hour:** Resolução do conflito entre o PDF oficial (16h–20h) e o story do Instagram (sexta e sábado das 17h às 21h).
5. **Definição de Bairro Postal:** Confirmação entre "Petrolina Antiga" e "Centro" para fins de correspondência postal formal.
