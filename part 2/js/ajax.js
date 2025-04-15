function toggleQuiz() {
    const quiz = document.getElementById("quizContainer");
    const btn = document.getElementById("toggleQuizBtn");
    if (quiz.style.display === "none") {
        quiz.style.display = "block";
        btn.textContent = "Hide Quiz";
    } else {
        quiz.style.display = "none";
        btn.textContent = "Take Quiz";
    }
}

function gradeQuiz() {
    const questions = document.querySelectorAll("form#quizForm div.question");
    let total = questions.length;
    let score = 0;

    questions.forEach((q, index) => {
        const selected = q.querySelector(`input[type="radio"]:checked`);
        if (selected && selected.value === "true") {
            score++;
        }
    });

    const percent = Math.round((score / total) * 100);
    document.getElementById("quizResult").innerHTML =
        `<strong>You scored ${score} out of ${total} (${percent}%)</strong>`;
}
