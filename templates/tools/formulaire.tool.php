<br>
<br>
<br>
<?php
    require './src/dbConnect.php';
    $database = new Database($connection);

    $formations = $database->getAllFormation();

    if(isset($_GET['id'])){
        $res = $database->getByID($_GET['id']);
    }
?>
<main class="flex-shrink-0">
  <div class="container rounded bg-light">
      <div class="h4 pb-2 mb-4  border-bottom border-secondary text-center">
        <?php echo $_GET['page'] === 'formajout' ? 'Ajouter' : 'Modifier'; ?>
      </div>
      <div class="row g-5 ">
          <div class="col-md-12 col-lg-12">
              <form action="#" method="post">
                  <div class="row ">
                      <div class="col-sm-4">
                          <label for="surname" class="form-label">Nom<span class=" <?php echo (isset($_POST['submit'])? empty($_POST['surname']) ?  "text-danger" :  "":  ""); ?>">*</span> :</label>
                          <input type="text" class="form-control <?php echo isset($_POST['submit']) && empty($_POST['surname']) ? 'is-invalid' : ''; ?>" id="surname" name="surname" value="<?php echo (!empty($_POST['surname']) ? $_POST['surname'] : (isset($res[0]['surname']) ? $res[0]['surname']:''));?>" placeholder="Nom..." >
                      </div>
                      <div class="col-sm-4">
                          <label for="name"  class="form-label">Prénom<span class=" <?php echo (isset($_POST['submit'])? empty($_POST['name']) ?  "text-danger" :  "":  ""); ?>">*</span> :</label>
                          <input type="text" id="name" class="form-control   <?php echo isset($_POST['submit']) && empty($_POST['name']) ? 'is-invalid' : ''; ?>" name="name" placeholder="Prénom..." value="<?php echo !empty($_POST['name']) ? $_POST['name'] :(isset($res[0]['name']) ? $res[0]['name']:'');?>" >
                          <br/>
                      </div>
                      <div class="col-4">
                          <label for="birthDay" class="form-label">Date de naissance<span class=" <?php echo (isset($_POST['submit'])? empty($_POST['birthDay']) ?  "text-danger" :  "":  ""); ?>">*</span> :</label>
                          <input type="date" id="birthDay" class="form-control <?php echo isset($_POST['submit']) && empty($_POST['birthDay']) ? 'is-invalid' : ''; ?> " name="birthDay" value="<?php echo !empty($_POST['birthDay']) ? $_POST['birthDay'] :(isset($res[0]['birthday']) ? $res[0]['birthday']:'');?>">
                          <br/>
                      </div>
                      
                      <div class="col-6">
                          <label for="email" class="form-label">Email<span class=" <?php echo (isset($_POST['submit'])? empty($_POST['email']) ?  "text-danger" :  "":  ""); ?>">*</span> :</label>
                          <input type="email" id="email" class="form-control <?php echo isset($_POST['submit']) && empty($_POST['email']) ? 'is-invalid' : ''; ?>" name="email" placeholder="test@example.com" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : (isset($res[0]['email']) ? $res[0]['email']:'');?>">
                          <br/>
                      </div>

                      <div class="col-6">
                        <label for="phone">Numéro de Téléphone<span class=" <?php echo (isset($_POST['submit'])? empty($_POST['phone']) ?  "text-danger" :  "":  ""); ?>">*</span> :</label>
                        <div class="input-group mt-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="phone">+33</span>
                          </div>
                          <input type="text" class="form-control <?php echo isset($_POST['submit']) && empty($_POST['phone']) ? 'is-invalid' : ''; ?>" id="phone" name="phone" placeholder="00 00 00 00 00" value="<?php echo !empty($_POST['phone']) ? $_POST['phone'] :( isset($res[0]['phone']) ? $res[0]['phone']:'');?>" >
                        </div>
                        <br/>
                      </div>
                      <div class="col-8">
                          <label for="address" class="form-label">Adresse :</label>
                          <input type="text" id="address" class="form-control" name="address" placeholder="Adresse..." value="<?php echo !empty($_POST['address']) ? $_POST['address'] : (isset($res[0]['address']) ? $res[0]['address']:'')?>">
                          <br/>
                      </div>
                      <div class="col-2">
                          <label for="postalcode" class="form-label">Code postal :</label>
                          <input type="text" id="postalcode" class="form-control" name="postalcode"  placeholder="Code postal..." value="<?php echo !empty($_POST['postalcode']) ? $_POST['postalcode'] :( isset($res[0]['postalcode']) ? $res[0]['postalcode']:'')?>">
                          <br/>
                      </div>
                      <div class="col-2">
                          <label for="city" class="form-label">Ville :</label>
                          <input type="text" id="city" class="form-control" name="city" placeholder="Ville..." value="<?php echo !empty($_POST['city']) ? $_POST['city'] :( isset($res[0]['city']) ? $res[0]['city']:'')?>">
                          <br/>
                      </div>
                        <div class="col-6">
                            <label for="formation" class="form-label">Formation<span class=" <?php echo (isset($_POST['submit'])? empty($_POST['formation']) ?  "text-danger" :  "":  ""); ?>">*</span> :</label>
                            <select name="formation" id="formation" class="form-select <?php echo isset($_POST['submit']) && empty($_POST['formation']) ? 'is-invalid' : ''; ?>">
                                <option disabled selected hidden>Sélectionnez la formation souhaitée</option>
                                <?php
                                    foreach ($formations as $formation) {
                                        echo "<option value='{$formation['id_formation']}' " .
                                        ( !empty($_POST['formation']) && $_POST['formation'] == $formation['id_formation'] ? 'selected' :
                                          (isset($res[0]['formation_id']) && $res[0]['formation_id'] == $formation['id_formation'] ? 'selected' : '' )
                                        ) . ">{$formation['nom_formation']}</option>";
                                    }
                                ?>
                            </select>
                            <br/>
                        </div>
                      <div class="col-12">
                          <label for="description" class="form-label">Description :</label>
                          <textarea id="description" class="form-control" name="description" ><?php echo !empty($_POST['description']) ? $_POST['description'] :( isset($res[0]['description']) ? $res[0]['description'] : '')?>
                          </textarea>
                          <br/>
                      </div>  
                  </div>
                  <input type="submit" class="w-100 btn btn-primary btn-lg mr-3 mb-3" name="submit" value="Envoyer">
              </form>
          </div>
      </div>
  </div>
</main>
