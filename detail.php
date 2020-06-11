<!DOCTYPE html>
<html>

<head>
    <title>Ejemplo e-commerce</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=1024">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets/custom.css" type="text/css">
</head>

<body>
    <div id="page-container">
        <div class="header-container">
            <img src="assets/images/banner.jpg" />
        </div>
        <div id="content-wrap">
            <br>
            <div class="col-lg-8 main-section p-3 bg-white">
                <div class="row m-0">
                    <div class="col-lg-6 left-side-product-box pb-3">
                        <img id="product_img" src="<?php echo $_POST['img'] ?>" class="border p-3">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-side-pro-detail border p-3 m-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p id="product_title" class="m-0 p-0"> <?php echo $_POST['title'] ?> </p>
                                </div>
                                <div class="col-lg-12">
                                    <p id="product_price" class="m-0 p-0 price-pro"> <?php echo $_POST['price'] ?> </p>
                                    <hr class="p-0 m-0">
                                </div>
                                <div class="col-lg-3">
                                    <br>
                                    <h6>Cantidad :</h6>
                                    <input id="product_quantity" type="number" class="form-control text-center w-100" value="1">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button id="create_button" onclick="createOrder()" class="mp-button mp-button-create">Generar Orden</button>
                                            <button hidden id="cancel_button" onclick="cancelOrder()" class="mp-button mp-button-cancel">Cancelar Orden</button>
                                            <br><br>
                                            <h5 id="order_status"></h5>
                                            <!--Actualice aquí el estado de la órden-->
                                            <hr>
                                            <img src="assets/images/cfcccc049c4549fb851e9ef1433c3e9f11b3fe511e4b40ceb87fb85ce04a433f.png" class="border p-3" style="width: 80%;">
                                            <!--Completar src con URL de imagen de tu QR de pago-->
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
        <footer id="footer" class="bg-secondary">
            <div class="card-body text-left">
                <img src="assets/images/logo.png" style="width: 100px" />
                <h6 style="color: white; display:inline"> | Ejemplo de Integración</h6>
            </div>
        </footer>
    </div>

    <script>
        function createOrder() {

            $product_title = '<?php echo $_POST['title'] ?>';
            $product_price = <?php echo $_POST['price'] ?>;
            $product_quantity = $('#product_quantity').val();

            var parametros = {
                "item": {
                    "title": $product_title,
                    "currency_id": 'ARS',
                    "unit_price": $product_price,
                    "quantity": $product_quantity,
                    "description": "Producto de Mercado Pago",
                    "picture_url": "https://bit.ly/2lCRcEN"
                }
            };



            $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url: 'createOrder.php', //archivo que recibe la peticion
                type: 'post', //método de envio
                success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#order_status").html(response);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });

        }

        function cancelOrder() {
            //Invocar aquí al backend para cancelar la orden

        }

        /** Tip:
            Se sugiere utilizar las siguientes funciones para consultar periódicamente
            el backend y actualizar el estado de la orden en curso
        **/
        var pollInterval = undefined;

        function startStatusPolling() {
            pollInterval = setInterval(
                function() {
                    $.ajax({
                        url: "", //Completar con endpoint de backend y los parámetros necesarios para obtener el estado
                        dataType: 'json',
                        type: 'get',
                        success: function(data) {
                            //Actualizar estado actual en pantalla

                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                },
                3000
            );
        };

        function stopStatusPolling() {
            clearInterval(pollInterval);
        }
    </script>
</body>

</html>