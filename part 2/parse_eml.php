<?php
function parseEML($eml, $includeQuiz = false) {
    // Remove root lesson tags
    $html = preg_replace('/<lesson>/', '', $eml);
    $html = preg_replace('/<\/lesson>/', '', $html);

    // Replace lesson title and content
    $html = preg_replace('/<title>(.*?)<\/title>/s', '<h2>$1</h2>', $html);
    $html = preg_replace('/<content>(.*?)<\/content>/s', '<p>$1</p>', $html);

    // Parse important tags
    $html = preg_replace('/<important>(.*?)<\/important>/s', '<strong class="important">$1</strong>', $html);

    // Parse unordered lists and list items
    $html = preg_replace('/<ul>/', '<ul>', $html);
    $html = preg_replace('/<\/ul>/', '</ul>', $html);
    $html = preg_replace('/<li>(.*?)<\/li>/', '<li>$1</li>', $html);

    // Parse code blocks
    $html = preg_replace('/<code>(.*?)<\/code>/s', '<pre><code>$1</code></pre>', $html);

    if ($includeQuiz) {
        // Extract all questions for controlled rendering
        $questions = [];
        preg_match_all('/<question>(.*?)<\/question>/s', $html, $matches);
        $questionIndex = 0;

        foreach ($matches[1] as $qBlock) {
            // Extract question text
            preg_match('/<text>(.*?)<\/text>/s', $qBlock, $textMatch);
            $questionText = $textMatch[1];

            // Extract options
            preg_match_all('/<option correct="(true|false)">(.*?)<\/option>/s', $qBlock, $optionsMatch);

            $questionHTML = '<div class="question">';
            $questionHTML .= '<p class="question-text">' . htmlspecialchars($questionText) . '</p>';

            foreach ($optionsMatch[2] as $i => $optionText) {
                $isCorrect = $optionsMatch[1][$i] === 'true' ? 'true' : 'false';
                $optionHTML = '<label><input type="radio" name="q' . $questionIndex . '" value="' . $isCorrect . '"> ' . htmlspecialchars($optionText) . '</label>';
                $questionHTML .= '<p>' . $optionHTML . '</p>';
            }

            $questionHTML .= '</div>';
            $questions[] = $questionHTML;
            $questionIndex++;
        }

        // Build final quiz form
        $html = '<form id="quizForm" method="post">';
        $html .= '<div class="quiz">';
        $html .= implode("\n", $questions);
        $html .= '<div id="quizResult" class="feedback"></div>';
        $html .= '<button type="button" onclick="gradeQuiz()">Submit Quiz</button>';
        $html .= '</div>';
        $html .= '</form>';
    } else {
        // Strip quiz section entirely
        $html = preg_replace('/<quiz>.*?<\/quiz>/s', '', $html);
    }

    return $html;
}
?>
