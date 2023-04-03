<script>
    function passwordHideShowFunction() {
        var givenPassword = document.getElementById("inputPassword");
        if (givenPassword.type === "password") {
            givenPassword.type = "text";
        } else {
            givenPassword.type = "password";
        }

        var givenPassword = document.getElementById("inputPassword2");
        if (givenPassword.type === "password") {
            givenPassword.type = "text";
        } else {
            givenPassword.type = "password";
        }
    }
</script>
