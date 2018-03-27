<?php
    if(isset($db))
    {
        mysqli_close(db::mysqli);
    }
    else if(isset($user))
    {
        mysqli_close(db::mysqli);
    }
?>

<script>

    function myFunction(input) {
        var x = document.getElementById(input);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

</script>
<script>$(".nav a").on("click", function(){   $(".nav").find(".active").removeClass("active");   $(this).parent().addClass("active");}); </script>
	</body>
</html>