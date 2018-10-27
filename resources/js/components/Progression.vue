<template>
    <div class="row" style="margin-top:30px; margin-bottom:10px;">
        <div class="col-xs-12">
            <div class="flex-well-container">
                <div class="well well-lg" style="width:100%">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            60%
                        </div>
                        <img src="http://placehold.it/100">
                    </div>

                </div><!--end well-->

            </div><!--end flex-well-container-->
        </div><!--end col-xs-12-->
    </div><!--end row-->
</template>

<script>
    export default {
        name: "Progression"
    }
</script>

<style scoped>
    /*to customize the play now button*/
    .progress {
        position: relative;
    }

    .progress img {
        position: absolute;
        left: calc(60% - 50px); /* percentage - 1.5 x width of image*/
    }

    .btn-play{
        height: 70px;
        border-radius: 0px;
        background-color: #359966;
        border-color: #359966;
        color: white;
    }

    .
        /*reduce the bottom margin of progress bar to zero*/
    .progress{
        margin-bottom: 0px;
    }
    .flex-well-container{
        display: flex;
        width:100%;
    }
    /*set the radius of the well to zero*/
    .well-lg{
        border-radius: 0;
    }
</style>
