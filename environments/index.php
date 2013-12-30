<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return array(
 *     'environment name' => array(
 *         'path' => 'directory storing the local files',
 *         'writable' => array(
 *             // list of directories that should be set writable
 *         ),
 *     ),
 * );
 * ```
 */
return array(
	'dev' => array(
		'path' => 'dev',
		'writable' => array(
			// handled by composer.json already
		),
		'executable' => array(
			'yii',
		),
	),
	'production' => array(
		'path' => 'prod',
		'writable' => array(
			// handled by composer.json already
		),
		'executable' => array(
			'yii',
		),
	),
    'travis' => array(
        'path' => 'travis',
        'writable' => array(
            // handled by composer.json already
        ),
        'executable' => array(
            'yii',
        ),
    ),
);
