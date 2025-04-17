function loadLesson(id) {
    fetch("lesson.php?id=" + id)
        .then(res => res.text())
        .then(data => {
            document.getElementById("lesson").innerHTML = data;
        });
}
