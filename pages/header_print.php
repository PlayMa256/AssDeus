    <style type="text/css">
        @page{
            margin: 0;
        }
        #wrapper{
            float:left;

            height: 100px;

        }
        #logo{
            float:left;
        }
        #logo > img{

            height: 100px;
        }
        #content{
            float:left;
            width:550px;

            height: 100px;
            text-align: center;

        }
        #content p{
            font-size:12pt;
            margin:1px auto 3px;
        }
        #content span{
            font-size:18pt;
        }
        #data{
            float: left;
        }
        #data p{
            float:left;
            font-size: 15pt;
            vertical-align: 50%;

        }

    </style>
<div id="wrapper">
    <div id="logo">
       <img src="../images/logo%20igreja.png" alt="" />
    </div>
    <!--<div style="clear: both"></div>-->
    <div id="content">
        <span class="titulo">Igreja Assembl&eacute;ia de Deus</span>
        <p>Rua Moacir do amaral, 767 - Vila Kallil - Cosm&oacute;polis</p>
        <p>Cep:13150-000</p>
        <p style="text-decoration: underline">www.adcosmopolis.com.br</p>
    </div>
    <div id="data"><p><?php echo date("d/m/Y");?></p></div>
</div>
