<?php
namespace Bd\BdInstagram\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***
 *
 * This file is part of the "Instagram" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Bruno Dilhof <brunodilhof@gmail.com>, Sanatorium
 *
 ***/

/**
 * MediaController
 */
class MediaController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {

        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);
        $fields = 'caption,id,media_type,media_url,permalink,thumbnail_url,timestamp';
        $token = getenv('TYPO3_INSTAGRAM_TOKEN');
        $url = 'https://graph.instagram.com/me/media?fields=' . $fields . '&access_token=' . $token;
        $response = $requestFactory->request($url, 'GET', ['http_errors' => false]);

        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $content = $response->getBody()->getContents();
                $content = json_decode($content);
                $content = $content->data;
            }
        }

        $this->view->assign('media', $content);

    }
}
