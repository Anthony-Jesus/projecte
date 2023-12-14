<?php
function mostrar_menu () {

echo "<a href='funcio1.php'>Funcio1</a>";

}

function carregarArray($nomfitxer,&$arrayAsso)

{

$jsonString = file_get_contents($nomfitxer);
$arrayAsso = json_decode($jsonString, true);

}

function mostrartaula($videojocs)
{
echo "<table border='1'>";
echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
foreach($videojocs as $fila) {
    echo "<tr>";
    echo "<td>" . $fila['Nom'] . "</td>";
    echo "<td>" . $fila['Desenvolupador'] . "</td>";
    echo "<td>" . $fila['Plataforma'] . "</td>";
    echo "<td>" . $fila['Llançament'] . "</td>";
    echo "</tr>";
    }
    echo "</table>";
}

function asignarcodis($videojocs) {
    $contador = 1;
    foreach($videojocs as &$fila) {
        if(empty($fila['codi'])) {
            $fila['codi'] = $contador++;
            
        }
    }
    return $videojocs;
}

function mostrartaulacodi($videojocs) {
    
    echo "<table border='1'>";
    echo "<tr><th>codi</th><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
    
    $videojocs = asignarcodis($videojocs);
    foreach($videojocs as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['codi'] . "</td>";
        echo "<td>" . $fila['Nom'] . "</td>";
        echo "<td>" . $fila['Desenvolupador'] . "</td>";
        echo "<td>" . $fila['Plataforma'] . "</td>";
        echo "<td>" . $fila['Llançament'] . "</td>";
        echo "</tr>";
     }
    
    echo "</table>";

}

function afegirdataexpiracio($videojocs) {
    foreach($videojocs as &$fila) {
        $datallançament = $fila['Llançament'];
        $novadata = date('Y-m-d', strtotime($datallançament . '+5 years'));
        $fila['Expiracio'] = $novadata;
    }
    return $videojocs;
}

function mostrartaulaexpiracio($videojocs) {
    echo "<table border='1'>";
    echo "<tr><th>codi</th><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th><th>Expiracio</th></tr>";
    
    $videojocs = afegirdataexpiracio($videojocs);
    foreach($videojocs as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['codi'] . "</td>";
        echo "<td>" . $fila['Nom'] . "</td>";
        echo "<td>" . $fila['Desenvolupador'] . "</td>";
        echo "<td>" . $fila['Plataforma'] . "</td>";
        echo "<td>" . $fila['Llançament'] . "</td>";
        echo "<td>" . $fila['Expiracio'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    $nom_arxiu_expiracio = "JSON_Resultat_Data_Expiració.json";
    file_put_contents($nom_arxiu_expiracio, json_encode($videojocs, JSON_PRETTY_PRINT));
    echo "la taula expiracio esta guardat en $nom_arxiu_expiracio";
    echo "<br>";

}

/*function comprovarrepetits() {

}

function comprovarrepetitsampliada() {

}*/

$datainici = '2020-01-01';
$datafinal = '2021-12-30';
function eliminarvideojocs($videojocs,$datainici,$datafinal) {
    
    $videojocsfiltrats = array_filter($videojocs, function($fila) use ($datainici, $datafinal) {
    $datavideojoc = strtotime($fila['Llançament']);
    return $datavideojoc < strtotime($datainici) || $datavideojoc > strtotime($datafinal);
});
taulaeliminar($videojocsfiltrats);

}

function taulaeliminar($videojocs) {
    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
    foreach($videojocs as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['Nom'] . "</td>";
        echo "<td>" . $fila['Desenvolupador'] . "</td>";
        echo "<td>" . $fila['Plataforma'] . "</td>";
        echo "<td>" . $fila['Llançament'] . "</td>";
        echo "</tr>";

    }
    echo "<table>";

    $nom_arxiu_eliminat = "JSON_Resultat_eliminar.json";
    file_put_contents($nom_arxiu_eliminat, json_encode($videojocs, JSON_PRETTY_PRINT));
    echo "la taula eliminat esta guardat en $nom_arxiu_eliminat";
    echo "<br>";
}

function videojocmesmodernimesantic($videojocs) {
    $datarecent = '1900-01-01';
    $dataantic = '9999-12-31';
    $registre_recent = null;
    $registre_antic = null;

    foreach($videojocs as $fila) {
        $datallançament = $fila['Llançament'];

        if ($datallançament > $datarecent) {
            $datarecent = $datallançament;
            $registre_recent = $fila;
        }

        if ($datallançament < $dataantic) {
            $dataantic = $datallançament;
            $registre_antic = $fila;
        }
    }

    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";

        echo "<tr>";
        echo "<td>" . $registre_recent['Nom'] . "</td>";
        echo "<td>" . $registre_recent['Desenvolupador'] . "</td>";
        echo "<td>" . $registre_recent['Plataforma'] . "</td>";
        echo "<td>" . $registre_recent['Llançament'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $registre_antic['Nom'] . "</td>";
        echo "<td>" . $registre_antic['Desenvolupador'] . "</td>";
        echo "<td>" . $registre_antic['Plataforma'] . "</td>";
        echo "<td>" . $registre_antic['Llançament'] . "</td>";
        echo "</tr>";

    echo "</table>";
  
}

function ordenacioalfabeticadevideojocs($videojocs) {
    usort($videojocs, function($a, $b) {
        return strcmp($a['Nom'], $b['Nom']);
    });

    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
    foreach($videojocs as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['Nom'] . "</td>";
        echo "<td>" . $fila['Desenvolupador'] . "</td>";
        echo "<td>" . $fila['Plataforma'] . "</td>";
        echo "<td>" . $fila['Llançament'] . "</td>";
        echo "</tr>";

    }
    echo "<table>";

    $nom_arxiu_ordenat = "JSON_Resultat_ordenat_alfabetic.json";
    file_put_contents($nom_arxiu_ordenat, json_encode($videojocs, JSON_PRETTY_PRINT));
    echo "la taula ordenat esta guardat en $nom_arxiu_ordenat";
    echo "<br>";
}

function comptarelsvideojocsdecadaany($videojocs) {

    foreach($videojocs as $fila) {
        $anyllançament = date('Y', strtotime($fila['Llançament']));

        if(isset($contadorsperany[$anyllançament])) {
            $contadorsperany[$anyllançament]++;
        } else {
            $contadorsperany[$anyllançament] = 1;
        }
    }
    echo "<table border='1'>";
    echo "<tr><th>Any</th><th>Nombre</th>";

    foreach($contadorsperany as $any => $contador ) {
        echo "<tr>";
        echo "<td>$any</td>";
        echo "<td>$contador</td>";
        echo "</tr>";
    }
    echo "</table>";

}

?>  