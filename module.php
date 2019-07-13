<?php

namespace mint\modules\rewardMultipliers;

// hook files
require_once __DIR__ . '/hooks.php';

// hooks
\mint\addHooksNamespace('mint\modules\rewardMultipliers\Hooks');

// init
const ITEM_REWARD_MULTIPLIERS = [
    'double-post-rewards' => [
        'rewardSources' => [
            'post',
        ],
        'multiplier' => 2,
    ],
];

\mint\registerItemTypesInteraction(
    array_keys(ITEM_REWARD_MULTIPLIERS),
    [
        'module' => basename(__DIR__),
    ]
);
