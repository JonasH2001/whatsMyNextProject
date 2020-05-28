
<?php
//https://www.w3schools.com/xml/xsl_server.asp
//https://www.php.net/manual/de/xsl.installation.php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $id = 1;
    $xslt = new xsltProcessor;
    $dom = new DOMDocument();
    $dom->load("../../../fe/xslt/detailview.xsl");
    $xslt->importStylesheet($dom);
    $xmlData =
        '<?xml version="1.0" encoding="UTF-8"?>
        <dataset>
            <projects>
                <project id="1">
                    <topicID>1</topicID>
                    <groupID>1</groupID>
                    <name>Nudeln kochen</name>
                    <materials>
                        <material>
                            <name>Nudeln 500g</name>
                            <amount>1</amount>
                        </material>
                        <material>
                            <name>Wasser 1L</name>
                            <amount>1</amount>
                        </material>
                    </materials>
                    <tools>
                        <tool>
                            <name>Kochlöffel</name>
                        </tool>
                        <tool>
                            <name>Topf</name>
                        </tool>
                        <tool>
                            <name>Herd</name>
                        </tool>
                    </tools>
                    <description>Nudeln kochen ist einfach, sei kein idiot</description>
                    <values>
                        <fun>1</fun>
                        <scientific>5</scientific>
                        <costs>1</costs>
                        <complexity>1</complexity>
                        <requirements>2</requirements>
                        <knowledge>10</knowledge>
                    </values>
                    <picture>../../../fe/img/p1.jpeg</picture>
                    <feedback>
                        <rating>
                            <star1>4</star1>
                            <star2>12</star2>
                            <star3>12</star3>
                            <star4>65</star4>
                            <star5>190</star5>
                        </rating>
                        <comments>
                            <comment>
                                <id>1</id>
                                <username>ThomasKing11</username>
                                <text>Ich schaffe es nicht</text>
                                <likes>1000</likes>
                            </comment>
                        </comments>
                    </feedback>
                </project>
            </projects>
            <topics>
                <topic id="1">
                    <name>Audio und Hifi</name>
                    <color>red</color>
                    <groups>
                        <group id="1">
                            <name>Einstieg</name>
                        </group>
                        <group id="2">
                            <name>Nutzvoll</name>
                        </group>
                        <group id="3">
                            <name>Spielerisch</name>
                        </group>
                    </groups>
                </topic>
                <topic id="2">
                    <name>Microcontroller</name>
                    <color>blue</color>
                    <groups>
                        <group id="1">
                            <name>Einstieg</name>
                        </group>
                        <group id="2">
                            <name>Nutzvoll</name>
                        </group>
                        <group id="3">
                            <name>Spielerisch</name>
                        </group>
                    </groups>
                </topic>
                <topic id="3">
                    <name>Schaltungen</name>
                    <color>yellow</color>
                    <groups>
                        <group id="1">
                            <name>Einstieg</name>
                        </group>
                        <group id="2">
                            <name>Nutzvoll</name>
                        </group>
                        <group id="3">
                            <name>Spielerisch</name>
                        </group>
                    </groups>
                </topic>
                <topic id="4">
                    <name>Holzarbeiten</name>
                    <color>green</color>
                    <groups>
                        <group id="1">
                            <name>Einstieg</name>
                        </group>
                        <group id="2">
                            <name>Nutzvoll</name>
                        </group>
                        <group id="3">
                            <name>Spielerisch</name>
                        </group>
                    </groups>
                </topic>
                <topic id="5">
                    <name>Metallarbeiten</name>
                    <color>grey</color>
                    <groups>
                        <group id="1">
                            <name>Einstieg</name>
                        </group>
                        <group id="2">
                            <name>Nutzvoll</name>
                        </group>
                        <group id="3">
                            <name>Spielerisch</name>
                        </group>
                    </groups>
                </topic>
            </topics>
        </dataset>';
    $dom->loadXML($xmlData);
    print $xslt->transformToXml($dom);
    //echo "clicked on project with id: ".$id;
    /*$queryStr = "select * from project as p
            inner join material as m
            on p.id = m.project_id
            where p.id = $id";
    */
}

?>