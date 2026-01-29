<?php
/* ===============================
   Servizio SOAP: Conversione Metri ↔ Pollici
   =============================== */

/* Classe con le operazioni disponibili */
class ConversionService {

    // Converte metri in pollici
    public function metersToInches($meters) {
        return $meters / 0.0254;
    }

    // Converte pollici in metri
    public function inchesToMeters($inches) {
        return $inches * 0.0254;
    }
}

/* ===== Gestione WSDL ===== */
if (isset($_GET['wsdl'])) {
    header("Content-Type: text/xml");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    ?>
<definitions name="ConversionService"
             targetNamespace="urn:examples:conversionservice"
             xmlns="http://schemas.xmlsoap.org/wsdl/"
             xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:tns="urn:examples:conversionservice"
             xmlns:xsd="http://www.w3.org/2001/XMLSchema">

  <message name="MetersToInchesRequest">
    <part name="meters" type="xsd:float"/>
  </message>
  <message name="MetersToInchesResponse">
    <part name="inches" type="xsd:float"/>
  </message>

  <message name="InchesToMetersRequest">
    <part name="inches" type="xsd:float"/>
  </message>
  <message name="InchesToMetersResponse">
    <part name="meters" type="xsd:float"/>
  </message>

  <portType name="Conversion_PortType">
    <operation name="metersToInches">
      <input message="tns:MetersToInchesRequest"/>
      <output message="tns:MetersToInchesResponse"/>
    </operation>
    <operation name="inchesToMeters">
      <input message="tns:InchesToMetersRequest"/>
      <output message="tns:InchesToMetersResponse"/>
    </operation>
  </portType>

  <binding name="Conversion_Binding" type="tns:Conversion_PortType">
    <soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>
    <operation name="metersToInches">
      <soap:operation soapAction="metersToInches"/>
      <input>
        <soap:body use="encoded" namespace="urn:examples:conversionservice"
                   encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
      </input>
      <output>
        <soap:body use="encoded" namespace="urn:examples:conversionservice"
                   encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
      </output>
    </operation>
    <operation name="inchesToMeters">
      <soap:operation soapAction="inchesToMeters"/>
      <input>
        <soap:body use="encoded" namespace="urn:examples:conversionservice"
                   encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
      </input>
      <output>
        <soap:body use="encoded" namespace="urn:examples:conversionservice"
                   encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
      </output>
    </operation>
  </binding>

  <service name="Conversion_Service">
    <documentation>Servizio di conversione metri e pollici</documentation>
    <port name="Conversion_Port" binding="tns:Conversion_Binding">
      <soap:address location="http://localhost/soap/conversion.php"/>
    </port>
  </service>
</definitions>
<?php
    exit;
}

/* ===== Gestione chiamata SOAP ===== */
try {
    $server = new SoapServer("http://localhost/soap/conversion.php?wsdl");
    $server->setClass("ConversionService");
    $server->handle();
} catch (SoapFault $f) {
    echo "Errore SOAP: ", $f->getMessage();
}
