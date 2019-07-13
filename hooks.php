<?php

namespace mint\modules\rewardMultipliers\Hooks;

function mint_get_user_reward_multiplier(array $arguments): array
{
    $applicableMultipliers = array_filter(
        \mint\modules\rewardMultipliers\ITEM_REWARD_MULTIPLIERS,
        function (array $multiplier) use ($arguments) {
            return in_array($arguments['rewardSource']['name'], $multiplier['rewardSources'] ?? []);
        }
    );

    if ($applicableMultipliers) {
        $userItemTypeNames = array_column(
            \mint\getItemOwnershipsWithDetails($arguments['userId']),
            'item_type_name'
        );

        $userMultipliers = \mint\getArraySubset($applicableMultipliers, $userItemTypeNames);

        $arguments['userMultipliers'] = array_merge(
            $arguments['userMultipliers'],
            array_column($userMultipliers, 'multiplier')
        );
    }

    return $arguments;
}
