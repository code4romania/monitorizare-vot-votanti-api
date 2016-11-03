<?php if (!isset($_POST["mesaj"])){ ?>
  <div class="form-group">
    <form action="" method="post">
      <input class="form-control" type="text" name="nume" placeholder="Numele tău" />
      <select required id="judet" class="form-control" name="judet" placeholder="Județul* ">
        <option value="AB">Alba</option>
        <option value="AR">Arad</option>
        <option value="AG">Argeș</option>
        <option value="BC">Bacău</option>
        <option value="BH">Bihor</option>
        <option value="BN">Bistrița-Năsăud</option>
        <option value="BT">Botoșani</option>
        <option value="BR">Brăila</option>
        <option value="BV">Brașov</option>
        <option value="B">București</option>
        <option value="BZ">Buzău</option>
        <option value="CL">Călărași</option>
        <option value="CS">Caraș-Severin</option>
        <option value="CJ">Cluj</option>
        <option value="CT">Constanța</option>
        <option value="CV">Covasna</option>
        <option value="DB">Dâmbovița</option>
        <option value="DJ">Dolj</option>
        <option value="GL">Galați</option>
        <option value="GR">Giurgiu</option>
        <option value="GJ">Gorj</option>
        <option value="HR">Harghita</option>
        <option value="HD">Hunedoara</option>
        <option value="IL">Ialomița</option>
        <option value="IS">Iași</option>
        <option value="IF">Ilfov</option>
        <option value="MM">Maramureș</option>
        <option value="MH">Mehedinți</option>
        <option value="MS">Mureș</option>
        <option value="NT">Neamț</option>
        <option value="OT">Olt</option>
        <option value="PH">Prahova</option>
        <option value="SJ">Salaj</option>
        <option value="SM">Satu Mare</option>
        <option value="SB">Sibiu</option>
        <option value="SV">Suceava</option>
        <option value="TR">Teleorman</option>
        <option value="TM">Timiș</option>
        <option value="TL">Tulcea</option>
        <option value="VL">Vâlcea</option>
        <option value="VS">Vaslui</option>
        <option value="VN">Vrancea</option>
      </select>
      <input required class="form-control" type="text" name="localitate" placeholder="Localitatea* " />
      <!-- <input class="form-control" type="text" name="tip_problema" placeholder="Tipul de problemă*" />-->
      <select required id="tip_problema" class="form-control" name="tip_problema" placeholder="Tipul de problemă*">
        <option value="Altele">Altele</option>
        <option value="Campanie electorală în ziua votului">Campanie electorală în ziua votului</option>
        <option value="Media & internet">Media & internet</option>
        <option value="Mită electorală">Mită electorală</option>
        <option value="Nereguli în funcționarea birourilor electorale">Nereguli în funcționarea birourilor electorale</option>
        <option value="Observatori acreditați">Observatori acreditați</option>
        <option value="Probleme legate de observatorii acreditați">Probleme legate de observatorii acreditați</option>
        <option value="Turism electoral">Turism electoral</option>
        <option value="Utilizarea fondurilor publice în scopuri electorale">Utilizarea fondurilor publice în scopuri electorale</option>
        <option value="Vot multiplu">Vot multiplu</option>
      </select>
      <div class="row">
        <div class="col-md-6">
          <input class="form-control" type="text" id="sectia" name="sectia" placeholder="Secția " />
        </div>
        <div class="col-md-6">
          <input id="prezenta" type="checkbox" name="prezenta">Nu sunt în secție
        </div>
      </div>
      <textarea required class="form-control" name="mesaj" placeholder="Dă-ne mai multe detalii despre ce s-a întâmplat"></textarea>
      <input type="file" class="filestyle" data-buttonBefore="true" data-buttonText="Încarcă imagine">
      <input type="submit" class="btn btn-primary btn-lg btn-block">
    </form>
  </div>
  <?php }
else
{
    conectare_db();
    $nume = mysqli_real_escape_string($conn, $_POST["nume"]);
    $judet = mysqli_real_escape_string($conn, $_POST["judet"]);
    $localitate = mysqli_real_escape_string($conn, $_POST["localitate"]);
    $sectia = mysqli_real_escape_string($conn, $_POST["sectia"]);
    $mesaj = mysqli_real_escape_string($conn, $_POST["mesaj"]);
    $tip_problema = mysqli_real_escape_string($conn, $_POST["tip_problema"]);
    scrie_sesizare($nume, $judet, $localitate, $sectia, $tip_problema, $mesaj);
    deconectare_db();
    ?>
    <?php } ?>