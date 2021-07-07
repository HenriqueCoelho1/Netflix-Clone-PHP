const volumeToggle = (button) => {
    var muted = $(".previewVideo").prop("muted")
    $(".previewVideo").prop("muted", !muted)

    $(button).find("i").toggleClass("fa-volume-mute")
    $(button).find("i").toggleClass("fa-volume-up")
}

const previewEnded = () => {
    $(".previewVideo").toggle()
    $(".previewImage").toggle()
}

const goBack = () => {
    window.history.back()
}

const startHideTimer = () => {
    var timeout = null

    $(document).on("mousemove", function () {
        clearTimeout(timeout)
        $(".watchNav").fadeIn()

        timeout = setTimeout(function () {
            $(".watchNav").fadeOut()
        }, 2000)
    })
}

const initVideo = (videoId, username) => {
    startHideTimer()
    updateProgressTimer(videoId, username)
}

const updateProgressTimer = (videoId, username) => {
    addDuration(videoId, username)
}

const addDuration = (videoId, username) => {
    $.post("ajax/addDuration.php", { videoId, username }, function (data) {
        if (data !== null && data !== "") {
            alert(data)
        }
    })

}