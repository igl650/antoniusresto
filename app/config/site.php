<?php
declare(strict_types=1);

/**
 * Antonius Restô — Configurações Gerais da Aplicação
 *
 * Centraliza os dados estáveis de marca, localização, horários e canais oficiais.
 * Nenhuma informação não confirmada (como WhatsApp ou reservas sem canal oficial)
 * deve ser adicionada aqui sem validação prévia com o restaurante.
 */

// Funções de escape seguras para uso nas views
if (!function_exists('e')) {
    function e(?string $value): string {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('e_url')) {
    function e_url(?string $url): string {
        $url = trim($url ?? '');
        // Permite URLs web absolutas ou âncoras locais
        if (preg_match('/^(https?:\/\/|#)/i', $url)) {
            return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        }
        return '#';
    }
}

return [
    'app' => [
        'name' => 'Antonius Restô',
        'brand_title' => 'ANTONIUS',
        'brand_subtitle' => 'RESTÔ',
        'tagline' => 'Alta gastronomia contemporânea, vinhos selecionados e hospitalidade',
        'location_badge' => 'PETROLINA ANTIGA · GASTRONOMIA CONTEMPORÂNEA',
        'status_banner' => 'CONCEITO VISUAL · SITE MODELO · PETROLINA, PE',
    ],

    'seo' => [
        'title' => 'Antonius Restô — Cozinha Contemporânea em Petrolina, PE',
        'description' => 'Site modelo do Antonius Restô. Gastronomia contemporânea em casarão histórico revitalizado na Petrolina Antiga. Consulte horários, endereço e cardápios oficiais.',
        'lang' => 'pt-BR',
        // Proteção contra indexação acidental: mantém o modelo fora dos motores de busca até aprovação
        'robots' => 'noindex, nofollow',
    ],

    // Controle de homologação para publicação oficial
    'publishing' => [
        // Manter como false enquanto o site for um modelo independente com recursos e textos provisórios.
        // Altere para true somente após aprovação formal e alinhamento com o Antonius Restô.
        'approved' => false,
        // Emissão de dados estruturados Schema.org (Restaurant).
        // Por padrão false: evita que motores de busca interpretem o modelo como restaurante oficial antes da validação.
        'enable_schema_restaurant' => false,
    ],

    // Endereço verificado. O bairro não foi incluído intencionalmente devido à divergência entre fontes (Antiga vs. Centro)
    'address' => [
        'street' => 'Rua José Rabelo Padilha, 847',
        'city' => 'Petrolina',
        'state' => 'PE',
        'postal_code' => '56302-090',
        'country' => 'Brasil',
        'formatted' => 'Rua José Rabelo Padilha, 847 — Petrolina, PE · CEP 56302-090',
        'short_location' => 'Petrolina, PE',
        'note' => 'Bairro não incluído no endereço postal por divergência entre cadastros (Antiga vs. Centro).',
    ],

    // Horários gerais estáveis verificados no Instagram e no PDF oficial
    'hours' => [
        [
            'days' => 'Segunda a quinta-feira',
            'time' => '18h às 23h',
        ],
        [
            'days' => 'Sexta-feira e sábado',
            'time' => '12h às 23h',
        ],
        [
            'days' => 'Domingo',
            'time' => '12h às 16h',
        ],
    ],
    'hours_note' => 'Feriados e datas comemorativas podem alterar a programação. Confirme a disponibilidade antes da sua visita.',

    // Links e canais oficiais confirmados
    'links' => [
        'instagram' => 'https://www.instagram.com/antoniusresto/',
        'linkme' => 'https://linkme.bio/antoniusresto',
        'google_maps' => 'https://maps.app.goo.gl/GDKDFWeac8dtLiCz5',
    ],

    // Registros e dados pendentes de validação direta com o restaurante
    'pending_validation' => [
        'whatsapp' => 'Canal oficial de atendimento por WhatsApp e reservas ainda não informado',
        'logo_vetorial' => 'Arquivo vetorial em alta resolução da marca para substituição do ícone provisório',
        'fotos_reais' => 'Fotografias originais autorizadas da fachada, salão e pratos para substituir imagem conceitual',
        'happy_hour_horario' => 'Confirmação entre 16h–20h (PDF) ou sexta/sábado 17h–21h (story recente)',
        'campanhas_vigencia' => 'Confirmação de dias, valores e pratos participantes dos menus temáticos',
        'bairro_postal' => 'Definição do bairro preferido para correspondência (Petrolina Antiga ou Centro)',
    ],
];
