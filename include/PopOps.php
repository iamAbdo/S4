<link rel="stylesheet" href="assets/css/include/popOps.css">

<div id="PopOp">
    <div id="PopOp-content">
        <h1>Voulez-vous vraiment sortir du compte ?</h1>
        <button id="oui" onclick="confirmLogout()">Oui</button>
        <button id="non" onclick="cancelLogout()">Non</button>
    </div>
</div>

<script>
    function LogoutPopOp() {
        var modal = document.getElementById("PopOp");
        modal.style.display = "block";
    }

    function confirmLogout() {
        window.location.href = "signOut.php";
    }

    function cancelLogout() {
        var modal = document.getElementById("PopOp");
        modal.style.display = "none";
    }

</script>