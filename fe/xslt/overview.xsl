<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <!--xmlns:n="./dtd.dtd" xmlns="http://www.w3.org/1999/xhtml" xmlns:svg="http://www.w3.org/2000/svg"-->
    <!--<xsl:output
            method="html"
            doctype-system="./dtd.dtd"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />-->
    <xsl:template match="/">
        <html>
            <head>
                <script lang="javascript" src="../../../fe/js/groups.js"/>
                <script lang="javascript" src="../../../fe/js/trigonometrics.js"/>
                <!--<link rel="stylesheet" type="text/css" href="../../../fe/css/groupview.css" />-->
                <title>Find your next Project</title>
            </head>
            <body>
                <xsl:for-each select="dataset/Projekte/ProjektView">
                    <!-- TODO correct path in backend architecture-->
                    <form action="../php/details.php"
                          method="POST">
                        <xsl:attribute name="name">
                            <xsl:value-of select="concat('toDetailPage',ProjektID)"/>
                        </xsl:attribute>
                        <input type="hidden" name="id">
                            <xsl:attribute name="value">
                                <xsl:value-of select="ProjektID"/>
                            </xsl:attribute>
                        </input>
                        <div>
                            <xsl:attribute name="onclick">
                                document.forms['toDetailPage<xsl:value-of select="ProjektID"/>'].submit();
                            </xsl:attribute>
                            <p><xsl:value-of select="ProjektName"/></p>
                        </div>
                    </form>
                </xsl:for-each>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>