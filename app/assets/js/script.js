const volumeToggle = (button) => {
    var muted = $(".previewVideo").prop("muted");
    $(".previewVideo").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

const previewEnded = () => {
    $(".previewVideo").toggle()
    $(".previewImage").toggle()

}