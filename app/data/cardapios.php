<?php
declare(strict_types=1);

/**
 * Antonius Restô — Dados, Links e Estados dos Cardápios
 *
 * Centraliza os destinos oficiais de cardápios (Google Drive oficial via Linkme.bio)
 * e o controle de ativação/desativação de noites temáticas e promoções.
 *
 * Diretrizes editoriais desta revisão:
 * - O cardápio oficial e a localização no mapa são os caminhos principais.
 * - Campanhas com vigência não confirmada (Segunda em etapas, Terça é Massa,
 *   Quarta Risoteando e Happy Hour) ficam DESATIVADAS por padrão ('ativo' => false).
 * - O Happy Hour tem divergência entre o PDF (16h–20h) e stories (sex/sáb 17h–21h),
 *   ficando desativado até confirmação formal da casa.
 * - Todos os links e estruturas são preservados neste arquivo para reativação imediata.
 */

return [
    // Caminho principal em destaque: cardápio completo da casa
    'oficial' => [
        'ativo' => true,
        'titulo' => 'Cardápio oficial',
        'subtitulo' => 'Pratos, sobremesas e vinhos',
        'descricao' => 'Criações contemporâneas, peixes, carnes nobres, massas artesanais, entradas e carta de vinhos selecionados.',
        'url' => 'https://drive.google.com/file/d/1vJUqIOI3K9jipKR2vPo8jun9JJNsMkV5/view?usp=sharing',
        'badge' => 'PDF oficial · 7 páginas',
        'cta' => 'Explorar o cardápio',
    ],

    // Cardápio do Happy Hour (desativado por padrão devido à divergência de horários)
    // PDF da casa: 16h–20h | Stories do Instagram: sexta e sábado das 17h às 21h
    'happy_hour' => [
        'ativo' => false,
        'titulo' => 'Happy Hour',
        'subtitulo' => 'Confira o cardápio da casa',
        'descricao' => 'Aperitivos e bebidas divulgados pela casa em arquivo digital.',
        'url' => 'https://drive.google.com/file/d/1CqWxmdErsRpE4E7i1Oi3yOtv2sH8b5mG/view?usp=drive_link',
        'cta' => 'Ver cardápio',
        'nota_pendencia' => 'Aguardando confirmação do horário oficial vigente com o restaurante.',
    ],

    // Destaques gastronômicos confirmados do cardápio oficial (PDF de 7 páginas da casa)
    'destaques_oficial' => [
        [
            'categoria' => 'ENTRADAS & COMPARTILHAR',
            'titulo' => 'Entradas da Casa',
            'descricao' => 'Preparações autorais e combinações aromáticas pensadas para despertar o paladar e abrir a refeição.',
            'itens' => [
                'Burrata Antonius',
                'Souvlaki de couve-flor',
                'Croquetas de fumeiro',
                'Saladas',
            ],
        ],
        [
            'categoria' => 'PRATOS PRINCIPAIS',
            'titulo' => 'Cortes, Peixes e Massas',
            'descricao' => 'O encontro da gastronomia contemporânea com referências regionais marcantes do São Francisco e do Sertão.',
            'itens' => [
                'Casa Sertão',
                'Surubim Peba',
                'Terra dos Impossíveis',
                'Lasanha Antonius',
            ],
        ],
        [
            'categoria' => 'SOBREMESAS & ADEGA',
            'titulo' => 'Sobremesas e Carta de Vinhos',
            'descricao' => 'Criações doces memoráveis e uma curadoria cuidadosa de rótulos para harmonizar cada momento.',
            'itens' => [
                'Torta basca',
                'Panacota de cumaru',
                'Cartola arretada',
                'Rótulos selecionados e drinks',
            ],
        ],
    ],

    // Campanhas temáticas e promoções (desativadas por padrão até validação de vigência)
    'campanhas' => [
        'segunda_etapas' => [
            'ativo' => false,
            'tipo' => 'cardapio_tematico',
            'dia' => 'SEGUNDA-FEIRA',
            'titulo' => 'Segunda em etapas',
            'resumo' => 'Um menu especial para começar a semana com calma.',
            'url' => 'https://drive.google.com/file/d/1mmd1VnmQwgQ8ssQDMKjT-NSSAoE3Ym8J/view?usp=sharing',
            'cta' => 'Ver cardápio ↗',
            'nota_pendencia' => 'Aguardando validação de vigência e condições atuais com o restaurante.',
        ],

        'terca_massa' => [
            'ativo' => false,
            'tipo' => 'cardapio_tematico',
            'dia' => 'TERÇA-FEIRA',
            'titulo' => 'Terça é Massa',
            'resumo' => 'Clássicos e receitas autorais de massas.',
            'url' => 'https://drive.google.com/file/d/1p-wMIjpnsgBDY35F1NMjYhuhLpCA6Q8u/view?usp=sharing',
            'cta' => 'Ver cardápio ↗',
            'nota_pendencia' => 'Aguardando validação de vigência, preços e pratos participantes.',
        ],

        'quarta_risoteando' => [
            'ativo' => false,
            'tipo' => 'cardapio_tematico',
            'dia' => 'QUARTA-FEIRA',
            'titulo' => 'Quarta Risoteando',
            'resumo' => 'Risotos e arrozes caldosos para escolher.',
            'url' => 'https://drive.google.com/file/d/1WCiGlHC8atbxJSSWSLykFaoV4qhQZ4dw/view?usp=sharing',
            'cta' => 'Ver cardápio ↗',
            'nota_pendencia' => 'Aguardando validação de vigência, preços e pratos participantes.',
        ],

        'quarta_taca_dobrada' => [
            'ativo' => false,
            'tipo' => 'promocao',
            'dia' => 'QUARTA-FEIRA',
            'titulo' => 'Taça Dobrada',
            'resumo' => 'Ação de taça de vinho em dobro mencionada em stories anteriores.',
            'url' => null,
            'cta' => 'Consultar a casa',
            'nota_pendencia' => 'Aguardando confirmação de vigência, valores e regras com a casa.',
        ],

        'quinta_rolha_free' => [
            'ativo' => false,
            'tipo' => 'promocao',
            'dia' => 'QUINTA-FEIRA',
            'titulo' => 'Rolha Free',
            'resumo' => 'Rolha livre para vinhos identificada em publicações anteriores.',
            'url' => null,
            'cta' => 'Consultar a casa',
            'nota_pendencia' => 'Aguardando confirmação de regras e vigência.',
        ],

        'happy_hour_fim_de_semana' => [
            'ativo' => false,
            'tipo' => 'promocao',
            'dia' => 'SEXTA E SÁBADO',
            'titulo' => 'Happy Hour de Fim de Semana',
            'resumo' => 'Publicações de stories mencionam horário das 17h às 21h em sextas e sábados.',
            'url' => null,
            'cta' => 'Consultar a casa',
            'nota_pendencia' => 'Divergência de horário (PDF 16h–20h vs. Story 17h–21h).',
        ],
    ],
];
