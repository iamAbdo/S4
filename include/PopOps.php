<link rel="stylesheet" href="assets/css/include/popOps.css">

<div id="PopOp" class="PopOp">
    <div id="PopOp-content" class="PopOp-content">
        <h1>Voulez-vous vraiment sortir du compte ?</h1>
        <button id="oui" onclick="confirmLogout()">Oui</button>
        <button id="non" onclick="cancelLogout()">Non</button>
    </div>
</div>

<div id="LogoutPopOp" class="PopOp">
    <div id="PopOp-content" class="PopOp-content">
        <h1>Voulez-vous vraiment sortir du compte ?</h1>
        <button id="oui" onclick="confirmPopOp('signOut.php')">Oui</button>
        <button id="non" onclick="cancelPopOp('LogoutPopOp')">Non</button>
    </div>
</div>

<div id="nonDefiniPopOp" class="PopOp">
    <div id="PopOp-content" class="PopOp-content">
        <h1>Votre compte n'ai pas fini Voullier remplir Vous informations</h1>
        <button id="oui" onclick="confirmPopOp('editAccount.php')">Remplir</button>
        <button id="non" onclick="cancelPopOp('nonDefiniPopOp')">Annuler</button>
    </div>
</div>


<script>
    function LogoutPopOp() {
        var modal = document.getElementById("LogoutPopOp");
        modal.style.display = "block";
    }

    function nonDefiniPopOp() {
        var modal = document.getElementById("nonDefiniPopOp");
        modal.style.display = "block";
    }

    function confirmPopOp(link) {
        window.location.href = link;
    }

    function cancelPopOp(id) {
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }

</script>