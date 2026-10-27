
<head>
     <?php
    
 $prix_unitaire=0;
 $quantite=0;
 $prix_total=$prix_unitaire*$quantite;
 $nom='';
 $tel='';
 $sex='';
 $adresse='';
 $mail='';
 if(isset($_POST["enregistrer"])){
 $nom=$_POST["nom"];
 $tel=$_POST["tel"];
 $sex=$_POST["sex"];
 $adresse=$_POST["adresse"];
 $mail=$_POST["mail"];   
 $date=date('y-m-d');
  try{
     $sql=$connexion->prepare("INSERT INTO clients (nom,tel,sex,mail,adresse)VALUES(?,?,?,?,?)");
     $sql->execute([$nom,$tel,$sex,$mail,$adresse]);
     }catch(Exeption $e){
            echo "donnees enregistrer"; }
             }
                 
     ?>
</head>
<body>
    <!-- PANIER ONLINE GLAMS -->
<div id="cart-icon" onclick="showCart()" style="position:fixed; top:90px; right:20px; background:#e91e8c; color:white; padding:10px 20px; border-radius:25px; cursor:pointer; z-index:9999; font-weight:bold; box-shadow:0 2px 10px rgba(0,0,0,0.2)">
  🛒 Panier (<span id="cart-count">0</span>)
</div>

<div id="cart-panel" style="display:none; position:fixed; top:0; right:0; width:350px; height:100%; background:white; z-index:10000; padding:20px; box-shadow:-2px 0 10px rgba(0,0,0,0.3); overflow-y:auto">
  <h3>Ton Panier 🛍️</h3>
  <div id="cart-items"></div>
  <hr>
  <p><strong>Total: <span id="cart-total">0</span>$</strong></p>
  <button onclick="commanderWhatsApp()" style="width:100%; background:#25D366; color:white; padding:12px; border:none; border-radius:8px; cursor:pointer; font-size:16px">Commander sur WhatsApp</button>
  <button onclick="closeCart()" style="width:100%; margin-top:10px; background:#ccc; padding:8px; border:none; border-radius:8px; cursor:pointer">Fermer</button>
</div>

    <nav>
        <div style="display:flex; gap:30px;align-items:flex-start;">
 <div style="
  background-image: linear-gradient(rgba(232, 160, 184, 0.7), rgba(232, 160, 184, 0.7)), url('images/glam-bg.jpg.jpeg');
  background-size: cover;
  background-position: center;
  padding: 20px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height:500px;
  width: 100%;">
  
  <div style= "flex:1;">
                <ul>
                    <h1 class="titre-glam">Online Glams</h1>
                    <img src="images/WhatsApp Image 2026-10-21 at 08.09.09.jpeg"
                     style="height:40%;width:40%; border-radius: 60%;">
                </ul>
            </div>
            <div style= "flex:0.3;
            padding: 5px;
            border-radius: 5px;">
            <div class="identite_client">
                <h3>complet your identity her</h3>
                <form method="post">
                    <label for="nom">nom</label>
                    <input type="text" name="nom">
                    <br>
                    <br>
                    <label for="sex">sex</label>
                    <input type="text" name="sex">
                    <br>
                    <br>
                    <label for="tel">tel</label>
                    <input type="number" name="tel">
                    <br>
                    <br>
                    <label for="mail">mail</label>
                    <input type="text" name="mail">
                    <br>
                    <br>
                    <label for="adresse">adres</label>
                    <input type="text" name="adresse">
                    <br>
                    <br>
                    <button type="submit" name="enregistrer">save now</button>
                </div>
            </div>
        </form>
</div>
        </div>
        <h3 class="slogan-glam">stay glam , stay you <br>confidence is your best outif</h3>
        
    </nav>
</body>