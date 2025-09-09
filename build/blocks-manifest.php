<?php
// This file is generated. Do not modify it manually.
return array(
	'email-list' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'email-list/email-list',
		'version' => '0.0.1',
		'title' => 'Email List Plugin',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'A simple form that takes user data and saves it in the db.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => true,
				'button' => true,
				'link' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'align' => true,
			'typography' => array(
				'fontSize' => true,
				'textAlign' => true,
				'lineHeight' => true
			)
		),
		'attributes' => array(
			'style' => array(
				'type' => 'object'
			),
			'fontSize' => array(
				'type' => 'string'
			),
			'textAlign' => array(
				'type' => 'string'
			)
		),
		'textdomain' => 'email-list',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);
