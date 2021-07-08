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
    setStartTime(videoId, username)
    updateProgressTimer(videoId, username)
}

const updateProgressTimer = (videoId, username) => {
    addDuration(videoId, username)

    let timer

    $("video").on("playing", function (event) {
        window.clearInterval(timer)
        timer = window.setInterval(function () {
            updateProgress(videoId, username, event.target.currentTime)
        }, 3000)
    })
        .on("ended", function () {
            setFinished(videoId, username)
            window.clearInterval(timer)
        })
}

const addDuration = (videoId, username) => {
    $.post("ajax/addDuration.php", { videoId, username }, function (data) {
        if (data !== null && data !== "") {
            alert(data)
        }
    })

}

const updateProgress = (videoId, username, progress) => {
    $.post("ajax/updateDuration.php", { videoId, username, progress }, function (data) {
        if (data !== null && data !== "") {
            alert(data)
        }
    })
}

const setFinished = (videoId, username) => {
    $.post("ajax/setFinished.php", { videoId, username }, function (data) {
        if (data !== null && data !== "") {
            alert(data)
        }
    })
}

const setStartTime = (videoId, username) => {
    $.post("ajax/getProgress.php", { videoId, username }, function (data) {
        if (isNaN(data)) {
            alert(data)
            return
        }

        $("video").on("canplay", function () {
            this.currentTime = data
            $("video").off("canplay")
        })
    })
}

const restartVideo = () => {
    $("video")[0].currentTime = 0
    $("video")[0].play()
    $(".upNext").fadeOut()
}

const watchVideo = (videoId) => {
    window.location.href = "watch.php?id=" + videoId
}

const showUpNext = () => {
    $(".upNext").fadeIn()
}