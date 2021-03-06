<?php use_helper('a') ?>
<?php slot('body_class') ?>a-default<?php end_slot() ?>

<?php slot('a-subnav', '') ?>
<?php slot('a-breadcrumb', '') ?>

<h1>
<?php a_slot('title', 'aText') ?>
</h1>

<?php a_area('body', array(
	'allowed_types' => array(
		'aRichText',
		'aVideo',
		'aSlideshow',
		'aSmartSlideshow',
		'aFile',
		'aAudio',
		'aFeed',
		'aButton',
		'aBlog',
		'aEvent',
		'aText',
		'aRawHTML',
	),
  'type_options' => array(
		'aRichText' => array(
		  'tool' => 'Main',
			// 'allowed-tags' => array(),
			// 'allowed-attributes' => array('a' => array('href', 'name', 'target'),'img' => array('src')),
			// 'allowed-styles' => array('color','font-weight','font-style'),
		),
		'aVideo' => array(
			'width' => 480,
			'height' => false,
			'resizeType' => 's',
			'flexHeight' => true,
			'title' => false,
			'description' => false,
		),
		'aSlideshow' => array(
			'width' => 480,
			'height' => false,
			'resizeType' => 's',
			'flexHeight' => true,
			'constraints' => array('minimum-width' => 480),
			'arrows' => true,
			'interval' => false,
			'random' => false,
			'title' => false,
			'description' => false,
			'credit' => false,
			'position' => false,
			'itemTemplate' => 'slideshowItem',
		),
		'aSmartSlideshow' => array(
			'width' => 480,
			'height' => false,
			'resizeType' => 's',
			'flexHeight' => true,
			'constraints' => array('minimum-width' => 480),
			'arrows' => true,
			'interval' => false,
			'random' => false,
			'title' => false,
			'description' => false,
			'credit' => false,
			'position' => false,
			'itemTemplate' => 'slideshowItem',
		),
		'aFile' => array(
		),
		'aAudio' => array(
			'width' => 480,
			'title' => true,
			'description' => true,
			'download' => true,
			'playerTemplate' => 'default',
		),
		'aFeed' => array(
			'posts' => 5,
			'links' => true,
			'dateFormat' => false,
			'itemTemplate' => 'aFeedItem',
			// 'markup' => '<strong><em><p><br><ul><li><a>',
			// 'attributes' => false,
			// 'styles' => false,
		),
		'aButton' => array(
			'width' => 480,
			'flexHeight' => true,
			'resizeType' => 's',
			'constraints' => array('minimum-width' => 480),
			'rollover' => true,
			'title' => true,
			'description' => false
		),
		'aBlog' => array(
			'slideshowOptions' => array(
				'width' => 480,
				'height' => 320
			),
		),
		'aEvent' => array(
			'slideshowOptions' => array(
				'width' => 340,
				'height' => 220
			),
		),
    'aText' => array(
			'multiline' => true
		),
		'aRawHTML' => array(
		),
	))) ?>
