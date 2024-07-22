<form action="<?=$action?>" method="POST" class="mt-3">
    <div class="form-group">
        <label for="username" class="mr-5">pseudo: </label><input type="text" id="username" name="username" placeholder="votre pseudo" value = "<?=isset($_POST["username"]) ? $_POST["username"] : ""?>" required>
        <br>
        <label for="password" class="mr-2">mot de passe: </label><input type="password" id="password" name="password" placeholder="votre mot de passe" required>
    </div>
    <button class="btn btn-primary">valider</button>
</form>