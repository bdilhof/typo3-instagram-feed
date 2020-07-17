<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Bd.BdInstagram',
            'Instagramfeed',
            [
                'Media' => 'list'
            ],
            // non-cacheable actions
            [
                'Media' => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        instagramfeed {
                            iconIdentifier = bd_instagram-plugin-instagramfeed
                            title = LLL:EXT:bd_instagram/Resources/Private/Language/locallang_db.xlf:tx_bd_instagram_instagramfeed.name
                            description = LLL:EXT:bd_instagram/Resources/Private/Language/locallang_db.xlf:tx_bd_instagram_instagramfeed.description
                            tt_content_defValues {
                                CType = list
                                list_type = bdinstagram_instagramfeed
                            }
                        }
                    }
                    show = *
                }
           }'
        );

		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            'bd_instagram-plugin-instagramfeed',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:bd_instagram/Resources/Public/Icons/user_plugin_instagramfeed.svg']
        );

        // Add task for refreshing Instagram Graph API Token
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Bd\BdInstagram\Task\RefreshInstagramToken::class] = array(
            'extension' => 'bd_instagram',
            'title' => 'Refresh Instagram Token',
            'description' => 'TODO: To be filled later',
        );

    }
);
