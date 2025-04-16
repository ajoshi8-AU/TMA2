function validateURL() {
    let urlField = document.getElementById("url");
    let urlPattern = /^(https?:\/\/)?(www\.)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\/?([a-zA-Z0-9#]+\/?)*$/;

    if (!urlPattern.test(urlField.value)) {
        alert("Please enter a valid URL.");
        return false;
    }
    return true;
}
