# Le-bon-coin
//hassane

just a place to put trashy code


*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;}

body{
  margin: 0;
  padding: 0;
  background-color: #E2B3CE;
  background-image: url("uploads/html/Deco.png");
  background-repeat: no-repeat;
  background-size: 80% auto;
  background-position: left top;
  z-index:0;
  
}
footer{
background-color: aqua;
z-index: 15;}
header {
  z-index: 20;}
main{
  height: 2000px}
nav{
  background-color: rgb(255, 255, 255);

  position: absolute;
  top: 0%;
  right: 0%;
  z-index: 25;
  display: flex;
  gap: 50px; /* space between links */
  justify-content: flex-end;
  padding: 0px 20px;}



.cormorant {
  font-family: "Cormorant", serif;
  font-optical-sizing: auto;
  font-weight: bold;
  font-style: normal;}
  
  .plushie{
  position: absolute;
  right: 0%;        
  height: auto;
  z-index: 5;
}

.cadre {
  display: flex;
  align-items: center
  max-height: 1920;       
  z-index: 10;    /* centre horizontalement */
}
.logo{
  position: absolute;
  right: 0%;
  width: 490px;
  height: auto;
  z-index: 15;
}


.plushiebackground{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
   /* 100% de la hauteur de l'écran */
  background-image: url("uploads/html/homeplushy.jpg");
  background-repeat: no-repeat;
  background-size: contain; /* ou contain selon ce que tu veux */
  z-index: -1; 
}
.backgroundcadre {
  background-image: url("uploads/html/cadre.png");
  background-repeat: no-repeat;
  background-size: 100% 100%;
  padding-bottom: 50%; /* adjust this % to match the image ratio */
  position: relative;
  z-index: 10;}


  <body class="cormorant">
    <div class="plushiebackground">
      <div  class="backgroundcadre">
        <header>
          <nav>
            <a href="navrecherche.html"><h1>Favoris</h1></a>
            <a href="navrecherche.html"><h1>Mes Recherches</h1></a>
            <h1>        </h1>
            <a href="navconnexion.html"><h1>Connexion</h1></a>
          </nav>
        </header>
        <img class="logo" src="uploads/html/Logo.png" alt="logo" draggable="false">
          
          
        
      

        <main>

        </main>
        
        <footer>
          test
        </footer> 
      </div>
    </div>
  </body>
  