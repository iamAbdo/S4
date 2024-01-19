<link rel="stylesheet" href="assets/css/include/popOps.css">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Popup</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>


    <!-- Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to log out?</p>
            <div class="button-container">
                <button onclick="confirmLogout()">Yes</button>
                <button onclick="cancelLogout()">No</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<script>
    function LogoutPopOp() {
        var modal = document.getElementById("logoutModal");
        modal.style.display = "block";
    }

    function confirmLogout() {
        window.location.href = "logout.php";
    }

    function cancelLogout() {
        var modal = document.getElementById("logoutModal");
        modal.style.display = "none";
    }

</script>