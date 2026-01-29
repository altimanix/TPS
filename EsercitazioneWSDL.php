<?php
/* =========================
   SEZIONE SOAP + WSDL
   ========================= */

class ConversionService {

    public function metersToInches($value) {
        return $value / 0.0254;
    }

    public function inchesToMeters($value) {
        return $value * 0.0254;
    }
}

/* Se viene richiesto il WSDL */
if (isset($_GET['wsdl'])) {
    header("Content-Type: text/xml");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    ?>
<definitions name="ConversionService"
             targetNamespace="http://localhost/conversione.php"
             xmlns="http://schemas.xmlsoap.org/wsdl/"
             xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:xsd="http://www.w3.org/2001/XMLSchema">

  <message name="ConvertRequest">
    <part name="value" type="xsd:float"/>
  </message>

  <message name="ConvertResponse">
    <part name="result" type="xsd:float"/>
  </message>

  <portType name="ConversionPortType">
    <operation name="metersToInches">
      <input message="tns:ConvertRequest"/>
      <output message="tns:ConvertResponse"/>
    </operation>
    <operation name="inchesToMeters">
      <input message="tns:ConvertRequest"/>
      <output message="tns:ConvertResponse"/>
    </operation>
  </portType>

  <binding name="ConversionBinding" type="tns:ConversionPortType">
    <soap:binding style="rpc"
        transport="http://schemas.xmlsoap.org/soap/http"/>
  </binding>

  <service name="ConversionService">
    <port name="ConversionPort" binding="tns:ConversionBinding">
      <soap:address location="http://localhost/conversione.php"/>
    </port>
  </service>

</definitions>
<?php
    exit;
}

/* Gestione chiamata SOAP */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = new SoapServer("http://localhost/conversione.php?wsdl");
    $server->setClass("ConversionService");
    $server->handle();
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Conversione Metrico ↔ Pollici</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #74b9ff, #a29bfe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            font-size: 16px;
        }

        button {
            background: #6c5ce7;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #5a4bcf;
        }

        .result {
            margin-top: 15px;
            font-weight: bold;
            color: #2d3436;
        }

        .wsdl {
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Conversione Metrico ↔ Pollici</h2>

    <form method="post">
        <input type="number" name="value" step="any" placeholder="Inserisci valore" required>

        <select name="operation">
            <option value="metersToInches">Metri → Pollici</option>
            <option value="inchesToMeters">Pollici → Metri</option>
        </select>

        <button type="submit">Converti</button>
    </form>

    <div class="result">
        <?php
        if (isset($_POST['value'])) {
            $client = new SoapClient("http://localhost/conversione.php?wsdl");
            $value = $_POST['value'];
            $op = $_POST['operation'];
            $res = $client->$op($value);
            echo "Risultato: " . round($res, 4);
        }
        ?>
    </div>

    <div class="wsdl">
        <a href="?wsdl" target="_blank">Visualizza WSDL</a>
    </div>
</div>

</body>
</html>
