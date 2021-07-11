@include("Admin.layouts.header")

<style>
    /* The alert message box */
    .announcement-view {
        padding: 20px;
        font-size: 2.0416666666666667vw;
        /* margin-bottom: 15px; */
        justify-content: center;

    }

    .announcement-view>h1 {
        font-size: 2.833333333333335vw;
        /* justify-content: center; */
    }

    .announcement-view>h2 {
        font-size: 2.1625vw;
        /* justify-content: center; */
    }

    .announcement-view>h3 {
        font-size: 1.21875vw;
        /* justify-content: center; */
    }

    .announcement-view>h4 {
        font-size: 1.0416666666666667vw;
        /* justify-content: center; */
    }

    .announcement-view>h5 {
        font-size: 0.8645833333333334vw;
        /* justify-content: center; */
    }

    .announcement-view>h6 {
        font-size: 0.6979166666666666vw;
        /* justify-content: center; */
    }

    .announcement-view>p {
        font-size: 1.0416666666666667vw;
        margin-top: 0;
        margin-bottom: 0;
        /* justify-content: center; */
    }

    .centerlize-elements {
        align-items: center;
        justify-content: center;
    }


    .timer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, 25.6041666666666665vw);
        grid-gap: 5px;
        justify-content: center;

    }

    .timer-box>div {
        height: 3.6041666666666665vw;
        /* background: rgb(221, 86, 86);
        border-radius: 0.5208333333333334vw;
        border: 0.06510416666666667vw solid #fff; */
        color: #fff;
        font-family: Exo, arial, sans-serif;
        font-size: 2.0416666666666667vw;
        display: flex;
        align-items: center;
        justify-content: center;
        /* margin-bottom: 20px; */
    }
</style>
<div id="announcement-alerts">
    <?php echo $announcement['announcement'] ?>

</div>




@push('scripts')


<script>
    var announcementStartDate = <?php echo $announcement['announcementStartDate'] ?>;
    var announcementEndDate = <?php echo $announcement['announcementEndDate'] ?>;
    var TimerBackgroundStyle = '<?php echo $announcement['timer-background-color'] ?>';
    var TimerFontStyle = 'color: <?php echo $announcement['timer-font-color'] ?>';
    var withSeconds = <?php echo isset($announcement['with-seconds']) ? 'true' : 'false'; ?>;
    var withMinutes = <?php echo isset($announcement['with-minutes']) ? 'true' : 'false'; ?>;
    var withHours = <?php echo isset($announcement['with-hours']) ? 'true' : 'false'; ?>;
    var withDays = <?php echo isset($announcement['with-days']) ? 'true' : 'false'; ?>;
    var hasTimer = <?php echo isset($announcement['hasTimer']) ? 'true' : 'false'; ?>;
    var closeable = <?php echo isset($announcement['closeable']) ? 'true' : 'false'; ?>;
</script>

<script>
    if (closeable) {
        $('#announcement-view').prepend('<button type="button" onclick="closeAnnouncement()" style="position: absolute; top: 50%; right:1%;" class="btn btn-tool float-right"><i class="fas fa-times"></i></button>');
    }

    function closeAnnouncement() {
        if (closeable) {
            document.getElementById('announcement-alerts').innerHTML = "";
        }
    }
</script>

<script>
    if (hasTimer) {

        // Update the count down every 1 second
        var x = setInterval(function() {

            // get the element with id="timer-clock"
            var timerElement = document.getElementById("timer-clock");
            if (timerElement) {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = announcementEndDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                // Output the result in an element
                timerElement.innerHTML =
                    '<div class="timer-content"><div class="timer-box"><div style="' + TimerFontStyle + '" class="timer-box-div">' +
                    (withDays ? (days + "D") : '') + ((withHours || withMinutes || withSeconds) && withDays ? (" : ") : '') +
                    (withHours ? (hours + "H") : '') + ((withMinutes || withSeconds) && withHours ? (" : ") : '') +
                    (withMinutes ? (minutes + "M") : '') + ((withSeconds) && withMinutes ? (" : ") : '') +
                    (withSeconds ? (seconds + "S") : '') + '</div></div></div>';

                // If the count down is over, write some text
                if (distance < 0) {
                    // clearInterval(x);
                    timerElement.innerHTML = '<div class="timer-content"><div class="timer-box"><div style="' + TimerFontStyle + '" class="timer-box-div"> EXPIRED </div></div></div>';
                }
            }

        }, 1000);
    }
</script>

@endpush

