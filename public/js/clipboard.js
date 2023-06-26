function copyCustomLinkToClipboard() {
    let copyText = document.getElementById("custom_link");
    let linkUrl = copyText.getAttribute("href");
    let tempInput = document.createElement("input");
    tempInput.setAttribute("value", linkUrl);
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
}
