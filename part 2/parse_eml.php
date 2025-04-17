<?php
function parseEML($eml) {
    $html = $eml;
    $html = preg_replace('/<lesson>/', '', $html);
    $html = preg_replace('/<\/lesson>/', '', $html);
    $html = preg_replace('/<title>(.*?)<\/title>/', '<h2>$1</h2>', $html);
    $html = preg_replace('/<content>(.*?)<\/content>/', '<p>$1</p>', $html);
    $html = preg_replace('/<quiz>/', '<div class="quiz">', $html);
    $html = preg_replace('/<\/quiz>/', '</div>', $html);
    $html = preg_replace('/<question>/', '<div class="question">', $html);
    $html = preg_replace('/<\/question>/', '</div>', $html);
    $html = preg_replace('/<text>(.*?)<\/text>/', '<strong>$1</strong>', $html);
    $html = preg_replace('/<option correct="true">(.*?)<\/option>/', '<p><input type="radio" name="q" data-correct="true"> $1</p>', $html);
    $html = preg_replace('/<option correct="false">(.*?)<\/option>/', '<p><input type="radio" name="q" data-correct="false"> $1</p>', $html);
    return $html;
}
?>
