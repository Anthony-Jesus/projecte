<!DOCTYPE html>
<html>

<body>
<?php
include "funcions.php";
mostrar_menu ();
echo "<br>";

//Funcionalitat 1:Mostrar
echo "<br>";
echo "Funcio 1:Mostrar";
echo "<br>";
$videojocs=array();
carregarArray("games.json", $videojocs);
print_r($videojocs);
echo "<br>";

//Funcionalitat 1:Mostrar taula
echo "<br>";
echo "Funcio 1:Mostrar taula";
echo "<br>";
mostrartaula($videojocs);


//Funcionalitat 2:Afegir codi
echo "<br>";
echo "Funcio 2:Afegir codi";
echo "<br>";
carregarArray("games.json_codi.json", $videojocs);
mostrartaulacodi($videojocs);
echo "<br>";


//Funcionalitat 3:eliminar videojocs
echo "<br>";
echo "Funcio 3:Eliminar";
echo "<br>";
eliminarvideojocs($videojocs,$datainici,$datafinal);


//Funcionalitat 4: Afegir data expiració
echo "<br>";
echo "Funcio 4:Afegir data expiració";
echo "<br>";
mostrartaulaexpiracio($videojocs);



//Funcionalitat 8: Videojoc més modern i més antic
echo "<br>";
echo "Funcionalitat 8: Videojoc més modern i més antic";
echo "<br>";
videojocmesmodernimesantic($videojocs);
echo "<br>";


//Funcionalitat 9: Ordenació alfabètica de videojocs 
echo "<br>";
echo "Funcionalitat 9: Ordenacio alfabetica de videojocs";
echo "<br>";
ordenacioalfabeticadevideojocs($videojocs);

//Funcionalitat 10: Comptar els videojocs de cada any
echo "<br>";
echo "Funcionalitat 10: Comptar els videojocs de cada any";
comptarelsvideojocsdecadaany($videojocs);
echo "<br>";



?> 
</body>
</html>