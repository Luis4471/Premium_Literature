<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles/stylecartao.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Adicionando a biblioteca Inputmask para a máscara de entrada -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7/inputmask.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Dados de cartão de crédito</span></div>
            <div class="content">
                <div class="card">
                    <div class="card__info">
                        <div class="card__logo">MasterCard</div>
                        <div class="card__chip">
                            <svg class="card__chip-lines" role="img" width="20px" height="20px" viewBox="0 0 100 100"
                                aria-label="Chip">
                                <g opacity="0.8">
                                    <polyline points="0,50 35,50" fill="none" stroke="#000" stroke-width="2"></polyline>
                                    <polyline points="0,20 20,20 35,35" fill="none" stroke="#000" stroke-width="2">
                                    </polyline>
                                    <polyline points="50,0 50,35" fill="none" stroke="#000" stroke-width="2"></polyline>
                                    <polyline points="65,35 80,20 100,20" fill="none" stroke="#000" stroke-width="2">
                                    </polyline>
                                    <polyline points="100,50 65,50" fill="none" stroke="#000" stroke-width="2">
                                    </polyline>
                                    <polyline points="35,35 65,35 65,65 35,65 35,35" fill="none" stroke="#000"
                                        stroke-width="2"></polyline>
                                    <polyline points="0,80 20,80 35,65" fill="none" stroke="#000" stroke-width="2">
                                    </polyline>
                                    <polyline points="50,100 50,65" fill="none" stroke="#000" stroke-width="2">
                                    </polyline>
                                    <polyline points="65,65 80,80 100,80" fill="none" stroke="#000" stroke-width="2">
                                    </polyline>
                                </g>
                            </svg>
                            <div class="card__chip-texture"></div>
                        </div>
                        <div class="card__type">debit</div>
                        <div class="card__number">
                            <span class="card__digit-group">0123</span>
                            <span class="card__digit-group">4567</span>
                            <span class="card__digit-group">8901</span>
                            <span class="card__digit-group">2345</span>
                        </div>
                        <div class="card__valid-thru" aria-label="Valid thru">Valid<br>thru</div>
                        <div class="card__exp-date"><time datetime="2038-01">01/38</time></div>
                        <div class="card__name" aria-label="Dee Stroyer">Jk Huger</div>
                        <div class="card__vendor" role="img" aria-labelledby="card-vendor">
                            <span id="card-vendor" class="card__vendor-sr">Mastercard</span>
                        </div>
                        <div class="card__texture"></div>
                    </div>
                </div>
                <form id="cartao-form" action="" method="post">
                    <div class="row">
                        <i class="fas fa-user"></i>
                        <input type="text" id="ncartao" name="ncartao" placeholder="Nº do cartão" required>
                    </div>
                    <div class="row">
                        <i class="fas fa-lock"></i>
                        <input type="text" id="ccv" name="ccv" placeholder="CCV" required>
                    </div>
                    <div class="row">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="text" id="validade" name="validade" placeholder="Validade (MM/AA)" required>
                    </div>
                    <div class="row button">
                        <input type="submit" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>