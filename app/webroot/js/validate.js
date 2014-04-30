//dong mo form right
function showhide(i, j) {
    $(document).ready(function() {
        $(".dong" + j).hide();
        $(".mo" + j).click(function() {
            $(i).slideUp();
            $(".dong" + j).show();
            $(".mo" + j).hide();
        });

        $(".dong" + j).click(function() {
            $(i).slideDown();
            $(".dong" + j).hide();
            $(".mo" + j).show();
        });
    });

}



