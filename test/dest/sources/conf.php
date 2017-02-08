<?php
defined('TYPO3_MODE') or die();
// Load XCLASSing of db_new
// USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\Controller\\NewRecordController'] = array(
	'className' => 'Documentation\\Examples\\Xclass\\SomethingController'
);
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Documentation']['Examples']['Controller']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG] = $GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG];
// Add example configuration for the logging API
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Documentation']['Examples']['Controller']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING] = array(
	// configuration for WARNING severity, including all
	// levels with higher severity (ERROR, CRITICAL, EMERGENCY)
	// add a SyslogWriter
	'TYPO3\\CMS\\Core\\Log\\Writer\\SyslogWriter' => array(),
);
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Documentation']['Examples']['Controller']['processorConfiguration'] = array(
	// configuration for ERROR level log entries
	\TYPO3\CMS\Core\Log\LogLevel::ERROR => array(
		// add a MemoryUsageProcessor
		'TYPO3\\CMS\\Core\\Log\\Processor\\MemoryUsageProcessor' => array(
			'formatSize' => TRUE
		)
	)
);
	// Register ExtDirect method
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerExtDirectComponent(
	'TYPO3.Examples.ExtDirect',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Classes/ExtDirect/Server.php:Tx_Examples_ExtDirect_Server')
);
/*
	// Register a class for manipulating the page rendering process
	// (used in TYPO3 Viewport manipulation demonstration)
	// NOTE: even though the code itself works, it breaks the TYPO3 backend
	// This code should be revisited at some point, but this requires solid ExtJS knowledge
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] =
  'EXT:' . $_EXTKEY . '/Classes/Utilities/Viewport.php:Tx_Examples_Utilities_Viewport->renderPreProcess';
*/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43(
	$_EXTKEY,
	'pierror/class.tx_examples_pierror.php',
	'_pierror',
	'list_type',
	1
);


// Register the collections plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Documentation.' . $_EXTKEY,
	'Collections',
	array(
		'Collection' => 'index',
	)
);

// Register custom RTE transformation
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_parsehtml_proc.php']['transformation']['tx_examples_transformation'] = 'Documentation\Examples\Service\RteTransformation';
