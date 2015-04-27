<?php
/**
 * List comments with optional add form
 *
 * @uses $vars['entity']        ElggEntity
 * @uses $vars['show_add_form'] Display add form or not
 * @uses $vars['id']            Optional id for the div
 * @uses $vars['class']         Optional additional class for the div
 */

$show_add_form = elgg_extract('show_add_form', $vars, true);

$id = '';
if (isset($vars['id'])) {
	$id = "id=\"{$vars['id']}\"";
}

$class = 'elgg-comments';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// work around for deprecation code in elgg_view()
unset($vars['internalid']);

echo "<div $id class=\"$class\">";

$options = array(
	'guid' => $vars['entity']->getGUID(),
	'annotation_name' => 'generic_comment'
);
$html = elgg_list_annotations($options);
if ($html) {
	echo '<h3>' . elgg_echo('comments') . '</h3>';
	echo $html;
}

if ($show_add_form) {
	echo elgg_view_form('comments/add', array(), $vars);
}

if (!elgg_is_logged_in()) {
	echo elgg_view_module("info", elgg_echo("theme_vab:comment:logged_out"),  elgg_echo("theme_vab:comment:logged_out:body", array("<a href='" . elgg_get_site_url() . "login'>", "</a>")), array("class" => "mtl"));
}

echo '</div>';
