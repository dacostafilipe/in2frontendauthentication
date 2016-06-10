<?php
namespace In2code\In2frontendauthentication\Domain\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use In2code\In2frontendauthentication\Domain\Repository\FeGroupsRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Sv\AuthenticationService as AuthenticationServiceCore;

/**
 * Class AuthenticationService
 * @package In2code\In2frontendauthentication\Domain\Service
 */
class AuthenticationService extends AuthenticationServiceCore
{
    /**
     * This method is called in fronted and should bypass the authentication for content elements and pages
     *
     * @param array $user
     * @param array $knownGroups
     * @return array
     */
    public function getGroups($user, $knownGroups)
    {
        $feGroupsRepository = GeneralUtility::makeInstance(ObjectManager::class)
            ->get(FeGroupsRepository::class);
        $feGroup = $feGroupsRepository->findByCurrentIpAddress();
        if (!empty($feGroup)) {
            return $feGroup;
        }
        return parent::getGroups($user, $knownGroups);
    }
}
