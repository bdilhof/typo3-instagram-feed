<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Bd.BdInstagram',
            'Instagramfeed',
            'Instagram Feed'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('bd_instagram', 'Configuration/TypoScript', 'Instagram');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bdinstagram_domain_model_media', 'EXT:bd_instagram/Resources/Private/Language/locallang_csh_tx_bdinstagram_domain_model_media.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bdinstagram_domain_model_media');

    }
);
