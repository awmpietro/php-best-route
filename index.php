	<?php 
	/**
	 * Função melhorRota
	 * Algoritimo responsável por calcular a menor rota entre dois pontos e também a distância entre eles.
	 * @param array $rotas
	 * @param string $origem
	 * @param string $destino
	 * @return array (array menor rota e string distancia)
	 */
	public function melhorRota($rotas, $origem, $destino) {
	    $vertices = array();
	    $vizinhos = array();
	    $distancia = array();
	    $ant = array();
	    foreach ($rotas as $limite) {
	        array_push($vertices, $limite[0], $limite[1]);
	        $vizinhos[$limite[0]][] = array("fim" => $limite[1], "custo" => $limite[2]);
	        $vizinhos[$limite[1]][] = array("fim" => $limite[0], "custo" => $limite[2]);
	    }
	    $vertices = array_unique($vertices);
	    foreach ($vertices as $vertex) {
	        $distancia[$vertex] = INF;W
	        $ant[$vertex] = NULL;
	    }
	    $distancia[$origem] = 0;
	    $Q = $vertices;
	    $i = count($Q);
	    while (count($Q) > 0) {
	        $min = INF;
	        foreach ($Q as $vertex){
	            if ($distancia[$vertex] < $min) {
	                $min = $distancia[$vertex];
	                $u = $vertex;
	            }
	        }
	        $Q = array_diff($Q, array($u));
	        if ($distancia[$u] == INF or $u == $destino) {
	            break;
	        }
	        if (isset($vizinhos[$u])) {
	            foreach ($vizinhos[$u] as $arr) {
	                $alt = $distancia[$u] + $arr["custo"];
	                if ($alt < $distancia[$arr["fim"]]) {
	                    $distancia[$arr["fim"]] = $alt;
	                    $ant[$arr["fim"]] = $u;
	                }
	            }
	        }
	        $i--;
	        if($i <= 0){
	             return false;
	             break;
	        }
	    }
	    $melhorRota = array();
	    $u = $destino;
	    while (isset($ant[$u])) {
	        array_unshift($melhorRota, $u);
	        $u = $ant[$u];
	    }
	    array_unshift($melhorRota, $u);
	    return array($melhorRota, $distancia[$destino]);
	}
	/**
	* Exemplo de utilização do algoritimo.
	*/
	public function exemplo(){
		$rotas = array(
			//String Origem, String Destino, Float Distancia
			array('A', 'B', 10),
			array('B', 'C', 20),
			array('C', 'D', 30), 
			array('D', 'E', 40)
		);
		$origem = 'A';
		$destino = 'C';
		$resultado = melhorRota($rotas, $origem, $destino);
		$melhorRota = $resultado[0];
		$distancia = $resultado[1];
		echo "Melhor Rota: " . implode(" - ", $melhorRota) . "<br>";
		echo "Distância: " . $distancia;	
	}