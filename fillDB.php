<?php

require_once "./connect.php";

function fillCategoriesTable() {
    global $db_host,$db_user,$db_name,$db_pass;
    $queries = [
        categoryQuery("CSMA/CD"),
        categoryQuery("Jednostki"),
        categoryQuery("Winsock"),
        categoryQuery("TokenRing"),
        categoryQuery("FrameRelay"),
        categoryQuery("Mosty"),
        categoryQuery("ISO/OSI"),
        categoryQuery("AS"),
        categoryQuery("VLAN"),
        categoryQuery("W2000"),
        categoryQuery("ATM"),
        categoryQuery("IPv4"),
        categoryQuery("IPv4 & IPv6"),
        categoryQuery("IP"),
        categoryQuery("sieci bezprzewodowe"),
        categoryQuery("ruting"),
        categoryQuery("TCP"),
        categoryQuery("TCP/IP"),
        categoryQuery("LAN"),
        categoryQuery("Ogólne"),

    ];
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');
        foreach ($queries as $query) {
            if (!$conn->query($query))
                throw new Exception("Bład przy kategoriach");
        }
        $conn->close();
    } catch(Exception $e) {
        echo $e;
    }
}

function fillQuestionsTable() {
    global $db_host,$db_user,$db_name,$db_pass;

    $queries = [
        questionQuery(1, "Czy po kolizjach liczba szczelin rośnie liniowo?"                 , 0),
        questionQuery(1, "Czy w 802.11 korzysta się z CSMA/CD?"                             , 0),
        questionQuery(2, "Czy liczba bodów = liczba bps?"                                   , 0),
        questionQuery(2, "Czy tłumienność 10db = 10 spadek mocy sygnału?"                   , 1),
        questionQuery(2, "Czy w 10BASET stosuje się pasmo podstawowe?"                      , 1),
        questionQuery(3, "Czy funkcja socket() zwraca deskryptor?"                          , 1),
        questionQuery(3, "Czy istnieje makro AF_TCP?"                                       , 0),
        questionQuery(3, "Czy pośredniczy jakaś biblioteka DLL?"                            , 1),
        questionQuery(3, "Czy Java.net jest odpowiednikiem Winsok?"                         , 1),
        questionQuery(4, "Czy stacja może odbierać gdy nie posiada tokenu?"                 , 1),
        questionQuery(4, "Czy Token Ring oferuje losowy dostęp do medium?"                  , 0),
        questionQuery(5, "Czy stosuje protokół sieci x.25 obejmuje warstwy 1-3?"            , 1),
        questionQuery(5, "Czy protokół HDLC był przed LAP-B?"                               , 1),
        questionQuery(6, "Czy przełączniki korzystają z algorytmu STA?"                     , 1),
        questionQuery(6, "Czy most działa w podwarstwie LLC?"                               , 1),
        questionQuery(6, "Czy wyznaczają domeny rozgłoszeniowe?"                            , 0),
        questionQuery(7, "Czy TCP/IP posiada warstwę sesji"                                 , 0),
        questionQuery(7, "Czy SAP\'y występują w warstwie łącza danych?"                     , 0),
        questionQuery(7, "Czy podwarstwa LLC w 802.3 występuje w modelu ISO/OSI?"           , 1),
        questionQuery(7, "Czy SAP to nazwa styku między warstwami?"                         , 0),
        questionQuery(7, "Czy TCP/IP posiada warstwę łącza danych?"                         , 0),
        questionQuery(8, "Czy IGP dotyczy rutingu wewnątrz AS-a?"                           , 1),
        questionQuery(8, "Czy BGP był poprzednikiem EGP?"                                   , 0),
        questionQuery(8, "Czy ruting BGP wykorzystuje wektor odległości?"                   , 1),
        questionQuery(8, "Czy numery AS-ów to liczby 2-bajtowe?"                            , 0),
        questionQuery(8, "Czy RIPE NCC obejmuje region USA?"                                , 0),
        questionQuery(9, "Czy można stworzyć w oparciu o adresy IP hostów?"                 , 1),
        questionQuery(9, "Czy są łączone procesem rutowania?"                               , 1),
        questionQuery(10, "Czy agent zasad IPsec korzysta z LDAP?"                          , 0),
        questionQuery(10, "Czy MTU jest przechowywane w Registry?"                          , 1),
        questionQuery(11, "Czy umożliwiają integrację usług data, voice, video?"            , 1),
        questionQuery(11, "Czy występuje warstwa adaptacji?"                                , 1),
        questionQuery(11, "Czy podwarstwa ATM dzieli i scala komórki?"                      , 1),
        questionQuery(11, "Czy dopuszcza korzystanie z sieci Ethernet?"                     , 1),
        questionQuery(11, "Czy przełączeniu podlegają porty i VPI/VCI?"                     , 1),
        questionQuery(11, "Czy 121.0.11.11 jest adresem klasy B?"                           , 0),
        questionQuery(11, "Czy sieci ATM mogą być przeźroczyste dla 802.3?"                 , 0),
        questionQuery(12, "Czy 121.0.11.11 jest adresem klasy B?"                           , 0),
        questionQuery(12, "Czy 255.255.255.192 umożliwia utworzenie 66 podsieci?"           , 0),
        questionQuery(12, "Czy pole TOS można ustawiać poleceniem ping?"                    , 1),
        questionQuery(12, "Czy połączenia P2P routera muszą tworzyć podsieci"               , 0),
        questionQuery(12, "Czy notacja 193.111.128.13/28 ma sens?"                          , 1),
        questionQuery(12, "Czy wyjściu modemowemu przydziela się adres IP?"                 , 1),
        questionQuery(13, "Czy nagłówek IPv6 zawiera pola opcji?"                           , 0),
        questionQuery(13, "Czy komunikaty ICMP są zawarte w datagramach UDP?"               , 0),
        questionQuery(13, "Czy pakiety IPv4 i IPv6 mogą działać na tym samym interfejsie?"  , 1),
        questionQuery(13, "Czy w IPv6 występuje adresowanie Anycast?"                       , 1),
        questionQuery(13, "Czy protokół IPv6 dopuszcza podnagłówki?"                        , 1),
        questionQuery(14, "Czy network ID 192.168.0.0/27, dopuszcza istnienie 64 podsieci?" , 0),
        questionQuery(14, "Czy CIDR wykorzystuje się w protokole RIPv1?"                    , 0),
        questionQuery(14, "Czy VLSM dopuszcza rekurencje w tworzeniu podsieci?"             , 1),
        questionQuery(14, "Czy jest fizycznie powiązany z interfejsem sieć?"                , 0),
        questionQuery(14, "Czy może być rozgłoszeniowy (broadcast)?"                        , 1),
        questionQuery(14, "Czy ma charakter (=zasięg) globalny?"                            , 1),
        questionQuery(20, "Czy funkcja bind() blokuje wykonanie wątku?"                     , 0),
        questionQuery(20, "Czy funkcja sendto() dotyczy protokołu UDP?"                     , 1),
        questionQuery(20, "Czy Czy RS232 to przykład implementacji warstwy 1-wszej?"        , 1),
        questionQuery(20, "Czy RIP1 wykorzystuje VLSM?"                                     , 0),
        questionQuery(20, "Czy polecenie Ping informuje o poprawnej pracy serwerów www?"    , 0),
        questionQuery(20, "Czy Czy Access Point sieci 802.11 jest mostem?"                  , 1),
        questionQuery(20, "Czy Ethereal podaje wartość Type ramki Ethernet?"                , 1),
        questionQuery(15, "Czy protokół ALOHA ma sprawność >25%?"                           , 0),
        questionQuery(15, "Czy Access point odpowiada logicznie mostowi?"                   , 1),
        questionQuery(15, "Czy super ramka dopuszcza dostęp bezkolizyjny?"                  , 1),
        questionQuery(15, "Czy stacja AP inicjuje połączenia ze stacjami?"                  , 0),
        questionQuery(15, "Czy wektor NAV wysyłany jest w trybie RTS/CTS?"                  , 1),
        questionQuery(15, "Czy stosowany jest algorytm CSMA/CD?"                            , 0),
        questionQuery(15, "Czy topologie sieci ad-hoc można przyrównać do magistrali?"      , 1),
        questionQuery(15, "Czy możliwe jest przekazywanie stacji pomiędzy ESS’ami?"         , 0),
        questionQuery(15, "Czy stosowany jest algorytm CSMA/CA?"                            , 1),
        questionQuery(16, "Czy będzie skuteczny bez tzw. drogi domyślnej „default”?"        , 0),
        questionQuery(16, "Czy rutery brzegowe wyk. met. dyst. –wektorową (xd)?"            , 1),
        questionQuery(16, "Czy pojecie \"Split horizon\" dotyczy prot. RIP?"                , 1),
        questionQuery(16, "Czy ruter zmienia adresy źródłowe na docelowe?"                  , 0),
        questionQuery(16, "Czy ruter zmienia adresy źródłowe lub docelowe?"                 , 1),
        questionQuery(16, "Czy \"Split Horizon\" dotyczy protokołu OSPF?"                   , 0),
        questionQuery(16, "Czy w OSPF stosuje się algorytm Dijkstry?"                       , 1),
        questionQuery(16, "Czy miedzy VLAN-ami jest konieczny?"                             , 1),
        questionQuery(17, "Czy wielkość okna może być > 65535?"                             , 0),
        questionQuery(17, "Czy w odpowiedzi ACK żąda się bajtów >= ISN+1?"                  , 1),
        questionQuery(17, "Czy lepiej gdy wielkość okna jest mniejsza?"                     , 0),
        questionQuery(17, "Czy algorytm Jacobsona służy ocenie RTT?"                        , 0),
        questionQuery(17, "Czy protokół http wykorzystuje TCP?"                             , 1),
        questionQuery(17, "Czy ednostka przesyłania TCP to segment?"                        , 1),
        questionQuery(17, "Czy przesuwne okno jest wspólne dla obydwu kanałów TCP?"         , 0),
        questionQuery(18, "Czy występują negatywne potwierdzenia?"                          , 1),
        questionQuery(18, "Czy przesuwne okno jest wspólne dla obydwu kanałów?"             , 0),
        questionQuery(18, "Czy wysłanie pakietu uruchamia \"timer\"?"                       , 1),
        questionQuery(18, "Czy TCP tworzy kanał FDx?"                                       , 1),
        questionQuery(18, "Czy wysłanie pakietu jest związane z licznikiem czasu?"          , 1),
        questionQuery(18, "Czy w poleceniu ping można określić TTL?"                        , 1),
        questionQuery(18, "Czy netstat podaje info dotyczące protokołu UDP?"                , 1),
        questionQuery(18, "Czy w poleceniu ping można zabronić fragmentacji?"               , 0),
        questionQuery(18, "Czy tracert wykorzystuje ICMP?"                                  , 1),
        questionQuery(19, "Czy 100BASE.T wykonuje kod Manchester?"                          , 0),
        questionQuery(19, "Czy „bod” to inaczej liczba bitów na sekundę?"                   , 0),
        questionQuery(19, "Czy porządek bitowy adr. MAC w m.t. jest stały?"                 , 1),
        questionQuery(19, "Czy hub to logiczny odpowiednik magistrali?"                     , 1),
        questionQuery(19, "Czy Ethernet II to po prostu 802.2 SNAP?"                        , 0),
        questionQuery(19, "Czy w TokenRing jest stacja monitor?"                            , 1),
        questionQuery(19, "Czy mosty wyznaczają zasięg sieci lokalnej?"                     , 0),
        questionQuery(19, "Czy w Gbit Ethernecie stosuje się protokół CSMA?"                , 1),
        questionQuery(19, "Czy zasięg sieci lokalnej pokrywa się z zasięgiem ramek rozgłoszeniowych IMHO?", 1),
        questionQuery(19, "Czy interfejs AUI wykorzystuje gniazdo RJ45?"                    , 0),
        questionQuery(19, "Czy przełącznik LAN realizuje funkcje mostu?"                    , 1),
        questionQuery(19, "Czy CSMA/CD realizuje \"exponential backoff\"?"                  , 1),
        questionQuery(19, "Czy 802.3 w tryfie Full Duplex wykorzystuje CSMA/CD?"            , 0),
        questionQuery(19, "Czy zast 10 regeneratorów klasy II dla uzyskania średnicy sieci 1000 m jest OK?", 0),
        questionQuery(19, "Czy 100 i 10 BASE mają tę samą warstwę MAC?"                     , 1),
        questionQuery(19, "Czy STA jest wykorzystywany w przełącznikach?"                   , 1),
        questionQuery(19, "Czy minimalna długość ramki 802.3 jest związana z algorytmem CSMA/CD?", 1),
        questionQuery(19, "Czy 802.1p/Q wykorzystuje się wewnątrz VLAN-ów?"                 , 1),
        questionQuery(19, "Czy adresy warstwy 3 mogą służyć do budowy VLAN-ów?"             , 1),
        questionQuery(19, "Czy sieci lokalne stanowią podstawę telekomunikacji?"            , 0),
        questionQuery(19, "Czy standard okablowania TIA/EIA obejmuje DIN?"                  , 0),
        questionQuery(19, "Czy CSMA/CD wykorzystuje pojecie szczeliny?"                     , 1),
        questionQuery(19, "Czy w 100BASE TX średnica sieci <= 100m?"                        , 0),
        questionQuery(19, "Czy 10000BASE F wykorzystuje CSMA/CD?"                           , 0),
        questionQuery(19, "Czy 802.1p/Q wykorzystuje się w VLAN-ach?"                       , 1),
        questionQuery(20, "Czy makra AF_INET i PF_INET można zamieniać?"                    , 1),
        questionQuery(20, "Czy 802.1p/Q wykorzystuje się w VLAN-ach?"                       , 1),
        questionQuery(20, "Czy sockadr_in() dopuszcza adresowanie IPv4?"                    , 1),
        questionQuery(20, "Czy program ping jest aplikacją typu C/S?"                       , 0),
        questionQuery(20, "Czy Ethereal korzysta z informacji zawartych w ramce MAC?"       , 1),
        questionQuery(20, "Czy w 802.11 asocjację inicjuje Access Point?"                  , 0),
        questionQuery(20, "Czy sieci x.25 obejmują warstwy 1-4 modelu ISO?"                 , 0),
        questionQuery(20, "Czy nagłówek TCP zawiera pole flagę SYN?"                        , 1),
        questionQuery(20, "Czy liczba bodów = liczba bps?"                                  , 0),
        questionQuery(20, "Czy T1 to europejski standard multipleksowania kanału?"          , 0),
        questionQuery(20, "Czy T1 to amerykański standard multipleksowania kanału?"         , 1),
        questionQuery(20, "Czy w 802.11 możliwa jest obsługa synchroniczna połączenia AP i stacji?", 1),
        questionQuery(20, "Czy w ATM występuje pojecie ścieżki VP?"                         , 1),
        questionQuery(20, "Czy w ATM występuje warstwa AAL?"                                , 1),
        questionQuery(20, "Czy FrameRelay wykorzystuje warstwę nr 3?"                       , 0),
        questionQuery(20, "Czy w 802.16 wykorzystuje się pasmo 2.4 GHz?"                    , 1),
        questionQuery(20, "Czy  NAT dopuszcza komunikacje hostów z 2 podsieci i o tym samym adresie 192.168.0.1?", 1),
        questionQuery(20, "Czy funkcja socket() jest blokująca?"                            , 0),
        questionQuery(20, "Czy JVM ma własny stos TCP/IP ?"                                 , 0),
        questionQuery(20, "Czy sockadr_in() big-endian jest wymagana ?"                     , 1),
        questionQuery(20, "Czy w Bluetooth występuje węzeł master?"                         , 1),
        questionQuery(20, "Czy kolejność Littre-endian jest w sieci wymagana?"              , 0),
        questionQuery(20, "Czy model NLOS w WiMAX wykorzystuje strefy Frenlsa?"             , 0),
        questionQuery(20, "Czy aplikacja ping wykorzystuje ICMP?"                           , 1),
        questionQuery(20, "Czy Access Point w sieci 802.11 pełni role mostu?"               , 1),
        questionQuery(20, "Czy w Mobile IP występuje agent domowy?"                         , 1),
    ];
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');
        foreach ($queries as $query) {
            if (!$conn->query($query))
                throw new Exception("Bład przy pytaniach " . $query);
        }
        $conn->close();
    } catch(Exception $e) {
        echo $e;
    }
}

function fillExplanationsTable() {
    global $db_host,$db_user,$db_name,$db_pass;

    $queries = [
        /**10*/explanationQuery(10,
            "Odbierać może, tylko wysyłać nie"),
        /**16*/explanationQuery(16,
            "Jeśli dobrze rozumiem, to mosty łączą ze sobą domeny kolizyjne w obrębie domeny rozgłoszeniowej. Są granicami sieci kolizyjnych"),
        /**17*/explanationQuery(17,
            "ISO/OSI posiada warstwe sesji"),
        /**19*/explanationQuery(19,
            "LLC - wyższa podwarstwa warstwy łącza danych w modelu OSI według rodziny standardów IEEE 802. Warstwa LLC jest identyczna dla różnych fizycznych mediów wymiany danych (jak np. ethernet, token ring, WLAN)"),
        /**21*/explanationQuery(21,
            "TCP/IP składa się z warstw: <ul>
                    <li>Aplikacji</li>
                    <li>Transportowej</li>
                    <li>Internetu</li>
                    <li>Dostępu do sieci</li>
                </ul> Warstwa łącza danych jest w OSI"),
        /**25*/explanationQuery(25,
            "Kiedyś były 2bajtowe, teraz są 4"),
        /**32*/explanationQuery(32,
            "Model protokołu ATM dzieli składa sie z 3 warstw: <ul><li>Warstwa fizyczna</li><li>Warstwa ATM</li><li>Warstwa adaptacji ATM</li></ul>"),
        /**38*/explanationQuery(38,
            "Klasy adresów IP (pierwsze i ostatnie to adresy sieci i broadcast, nie można ich użyć do hosta): 
                <ul>
                    <li>A - 0.0.0.0 - 127.255.255.255</li>
                    <li>B - 128.0.0.0 - 191.255.255.255</li>
                    <li>C - 192.0.0.0 - 223.255.255.255</li>
                    <li>D - 224.0.0.0 - 239.255.255.255</li>
                    <li>D - 240.0.0.0 - 255.255.255.255</li>
                </ul>"),
        /**42*/explanationQuery(42,
            "/28 oznacza maskę na 28 bitach"),
        /**44*/explanationQuery(44,
            "IPv4 zawiera pole opcji, ale nie jest ono wymagane"),
        /**46*/explanationQuery(46,
            "Jeżeli przez interfejs sieciowy rozumiemy kartę sieciową, no to jak najbardziej, jeszcze jak."),
        /**50*/explanationQuery(50,
            "CIDR to metoda przyszialania adresów IP, a RIP służy do obliczania najlepszej trasy do celu podczas routingu"),
        /**52*/explanationQuery(52,
            "Wydaje mi się, że tylko logicznie"),
        /**57*/explanationQuery(57,
            "RS232 to po prostu rodzaj złącze, a warstwa pierwsza to warstwa fizyczna"),
        /**58*/explanationQuery(58,
            "RIP2 chyba wykorzystuje"),
        /**59*/explanationQuery(59,
            "Ping może nie zwrócić nic jeżeli admini danej domeny tak se ustawili, co nie znaczy, że serwer nie działa"),
        /**65*/explanationQuery(65,
            "AP (Access Point) urządzenie zapewniające hostom dostęp do sieci komputerowej za pomocą bezprzewodowego nośnika transmisyjnego. Punkt dostępowy jest zazwyczaj mostem łączącym bezprzewodową sieć lokalną (WLAN) z siecią lokalną (LAN)."),
        /**67*/explanationQuery(67,
            "CSMA/CD działa w oparciu o wykrycie kolizji czy jakoś tak, a w WLAN kolizje są niewykrywalne. Używa się CSMA/CA"),
        /**69*/explanationQuery(69,
            "Mogę pomiędzy BBSami, ale muszą być w jednym ESS"),
        /**70*/explanationQuery(70,
            "CSMA/CD i CSMA/CA różną się tym, że CD ogarnia kolizje po jej zajściu, natomiast CA stara się do takowej nie dopuścić. Ten pierwszy jest wykorzystywany głównie przy sieciach kablowych, a CA w bezprzewodowych"),
        /**73*/explanationQuery(73,
            "Split Horizon is a method of preventing routing loops by prohibiting a router from advertising a loop back. It is used in several protocols: <ul><li>RIP</li><li>IGRP</li><li>EIGRP</li><li>VPLS</li><li>Babel</li></ul>"),
        /**76*/explanationQuery(76,
            "Split Horizon is a method of preventing routing loops by prohibiting a router from advertising a loop back. It is used in several protocols: <ul><li>RIP</li><li>IGRP</li><li>EIGRP</li><li>VPLS</li><li>Babel</li></ul>"),
        /**79*/explanationQuery(79,
            "Max 2^16-1 (chyba)"),
        /**81*/explanationQuery(81,
            "Chyba chodzi o to, że im większe okno, tym więcej można na raz wysłać"),
        /**92*/explanationQuery(92,
            "Netstat to wszystko pokazuje chyba"),
        /**94*/explanationQuery(94,
            "Tracert (Traceroute) wykorzystuje protokoły ICMP oraz UDP"),
        /**96*/explanationQuery(96,
            "bod oznacza liczbę zmian sygnału na sekundę, przy czym jedna zmiana sygnału może nieść ze sobą info o 4 bitach"),
        /**99*/explanationQuery(99,
            "Ethernet to 802.3, Ethernet II chyba też"),
        /**104*/explanationQuery(104,
            "AUI to jest rodzaj złącza, jakieś brzydkie duże, a RJ45 to \"klasyczny\" dzisiaj kabel od neta"),
        /**105*/explanationQuery(105,
            "Przełącznik LAN (switch) okraśla się jako wieloportowy most"),
        /**106*/explanationQuery(106,
            "Binary Exponential Backoff – algorytm wykorzystywany przez metodę CSMA/CD w sieci Ethernet."),
        /**107*/explanationQuery(107,
            "CSMA/CD to system wykrywania kolizji, działa w każdym trybie, poza full-duplex, bo w full duplex nie może być kolizji"),
        /**114*/explanationQuery(114,
            "Są jeszcze sieci personalne"),
        /**116*/explanationQuery(116,
            "Szczelina to jakaś tam umowna wartość czasowa"),
        /**118*/explanationQuery(118,
            "10000BASE F to 10Gigabit Ethernet i on leci po full-duplexie, a co za tym idzie nie ma wsparcia dla CSMA/CD, bo, jeśli dobrze kumam, CSMA/CD to system wykrywania kolizji, a w full duplexie ich nie ma"),
        /**119*/explanationQuery(119,
            "IEEE 802.1Q is the networking standard that supports virtual LANs (VLANs) on an Ethernet network."),
        /**120*/explanationQuery(120,
            "Wg jakiegoś typka ze Stack Overflow można używać AF_INET zamiast PF_INET zawsze"),
        /**123*/explanationQuery(123,
            "W pingu nie ma skrzynek"),
        /**126*/explanationQuery(126,
            "Obejmuje warstwy 1-3"),
        /**127*/explanationQuery(127,
            "Flagi nagłówka TCP: 
            <ul>
                <li>NS</li>
                <li>CWR</li>
                <li>ECE</li>
                <li>URG</li>
                <li>ACK</li>
                <li>PSH</li>
                <li>RST</li>
                <li>SYN</li>
                <li>FIN</li>
            </ul>"),
        /**128*/explanationQuery(128,
            "bod oznacza liczbę zmian sygnału na sekundę, przy czym jedna zmiana sygnału może nieść ze sobą info o 4 bitach"),
        /**130*/explanationQuery(130,
            "USA & Japan"),
        /**132*/explanationQuery(132,
            "ATM to standard komunikacji, przesyłający pakiety przez wirtualne łącza, a VP to wietualna ścieżka"),
        /**134*/explanationQuery(134,
            "Tylko pierwsze 2"),
        /**136*/explanationQuery(136,
            "NAT zamienia nasze adresy lokalne (prywatne, np. 192.168.1.10) na publiczne"),
        /**141*/explanationQuery(141,
            "Little-Endian to kolejność zapisu bitów, w której najmniej znaczący bit jest zapisywany na pierwszym miejscu z lewej, czyli tak jak araby"),
        /**144*/explanationQuery(144,
            "AP zazwyczaj jest mostem łączącym WLAN z LANem"),
    ];

    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');
        foreach ($queries as $query) {
            if (!$conn->query($query)) {
                echo $query;
                throw new Exception("Bład przy explanations");
            }
        }
        $conn->close();
    } catch(Exception $e) {
        echo $e;
    }

}

function categoryQuery($name) {
    return "INSERT INTO categories VALUES(NULL, '$name')";
}

function questionQuery($category, $text, $answer) {
    return "INSERT INTO questions VALUES(NULL, $category, '$text', $answer)";
}

function explanationQuery($question, $text) {
    return "INSERT INTO explanations VALUES(NULL, $question, '$text')";
}

function createTables() {
    global $db_host,$db_user,$db_name,$db_pass;

    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');

        //create tables
        if (!$conn->query("DROP TABLE IF EXISTS explanations")) {
            throw new Exception("Drop explanations");
        }
        if (!$conn->query("DROP TABLE IF EXISTS questions")) {
            throw new Exception("Drop questions");
        }
        if (!$conn->query("DROP TABLE IF EXISTS categories")) {
            throw new Exception("Drop cetegories");
        }
        if (!$conn->query("CREATE TABLE categories (
                                  id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  name VARCHAR(64))")) {
            throw new Exception("create categories");
        }
        if (!$conn->query("CREATE TABLE questions (
                                  id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  category_id INT(3) UNSIGNED,
                                  text VARCHAR(1000),
                                  answer TINYINT(1),
                                  FOREIGN KEY (category_id) REFERENCES categories(id))")) {
            throw new Exception("create questions");
        }
        if (!$conn->query("CREATE TABLE explanations (
                                  id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  question_id INT(3) UNSIGNED,
                                  text VARCHAR(1000) DEFAULT 'Brak podpowiedzi',
                                  FOREIGN KEY (question_id) REFERENCES questions(id))")) {
            throw new Exception("create explanations");
        }


        $conn->close();
    } catch (Exception $e) {
        echo $e;
    }
}

createTables();
fillCategoriesTable();
fillQuestionsTable();
fillExplanationsTable();