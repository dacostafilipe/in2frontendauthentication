<?php

declare(strict_types=1);

namespace In2code\In2frontendauthentication\Slot;

use In2code\In2frontendauthentication\Utility\ObjectUtility;
use In2code\In2frontendauthentication\Domain\Repository\FeGroupsRepository;

/**
 * Class AddCustomGroupsSlot
 */
class AddCustomGroupsSlot
{
    /**
     * @param array $customGroups
     * @return array
     */
    public function addCustomGroups(array $customGroups): array
    {
        $feGroupsRepository = ObjectUtility::getObjectManager()->get(FeGroupsRepository::class);
        $feGroups = $feGroupsRepository->findByCurrentIpAddress();
        foreach ($feGroups as $feGroup) {
            $customGroups[] = $feGroup['uid'];
        }
        return [$customGroups];
    }
}
