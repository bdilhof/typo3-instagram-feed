<?php
namespace Bd\BdInstagram\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class RefreshInstagramToken
 * @package Bd\BdInstagram\Task
 */
class RefreshInstagramToken extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

    /**
     * @return bool
     */
    public function execute()
    {
        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);
        $token = getenv('TYPO3_INSTAGRAM_TOKEN');
        $url = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . $token;
        $response = $requestFactory->request($url, 'GET', ['http_errors' => false]);
        return ($response->getStatusCode() === 200) ? true : false;
    }

}
