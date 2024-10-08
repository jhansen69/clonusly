document.addEventListener("DOMContentLoaded", function () {

    const testAlertButton = document.getElementById("testButton");
    testAlertButton.addEventListener("click", function () {
        Notiflix.Notify.success("It works!", () => {
            console.log("Callback")
        }, {
            position: 'right-bottom',
            clickToClose: true,
            closeButton: true
        });
    })

})