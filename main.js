document.addEventListener("DOMContentLoaded", function () {
  const cartIcon = document.getElementById("cart-icon");
  const closeCart = document.getElementById("close-cart");
  const cart = document.querySelector(".cart");

  // Verificar se os elementos existem e registrar eventos
  if (cartIcon) {
    cartIcon.onclick = () => {
      console.log("Cart icon clicked");
      cart.classList.add("active");
    };
  } else {
    console.error("Cart icon not found");
  }

  if (closeCart) {
    closeCart.onclick = () => {
      console.log("Close cart icon clicked");
      cart.classList.remove("active");
    };
  } else {
    console.error("Close cart icon not found");
  }

  // Função para mostrar SweetAlert para mensagens de erro
  function showAlert(type, title, text) {
    Swal.fire({
      icon: type,
      title: title,
      text: text,
    });
  }

  // Função para validação do formulário de registro
  function validateRegisterForm(event) {
    console.log("Validating form...");
    event.preventDefault(); // Impede o envio do formulário para validação

    var nome = document.getElementById("nome").value;
    var apelido = document.getElementById("apelido").value;
    var email = document.getElementById("email").value;
    var telefone = document.getElementById("telefone").value;
    var password = document.getElementById("password").value;
    var rpassword = document.getElementById("rpassword").value;

    var telefoneRegex = /^[9][0-9]{8}$/;
    var nomeApelidoRegex = /^[a-zA-ZÀ-ú\s]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!telefoneRegex.test(telefone)) {
      console.log("Telefone inválido");
      showAlert(
        "error",
        "Oops...",
        "O número de telefone deve ter 9 dígitos e começar com 9."
      );
      return; // Não continua com o envio do formulário
    }

    if (!nomeApelidoRegex.test(nome) || !nomeApelidoRegex.test(apelido)) {
      showAlert(
        "error",
        "Oops...",
        "O nome e o apelido não devem conter números ou caracteres especiais."
      );
      return; // Não continua com o envio do formulário
    }

    if (!emailRegex.test(email)) {
      showAlert("error", "Oops...", "O email deve ser válido.");
      return; // Não continua com o envio do formulário
    }

    if (password !== rpassword) {
      showAlert("error", "Oops...", "As senhas não coincidem.");
      return; // Não continua com o envio do formulário
    }

    // Se todos os campos forem válidos, o formulário será enviado
    event.target.submit();
  }

  // Adicionar evento de submit ao formulário de registro
  var registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", validateRegisterForm);
  }

  // Verificar se a função addCartClicked está sendo chamada corretamente
  var addCartButtons = document.querySelectorAll(".add-cart");
  addCartButtons.forEach((button) => {
    button.removeEventListener("click", addCartClicked); // Remover evento de clique existente
    button.addEventListener("click", function (event) {
      event.stopPropagation(); // Evitar a propagação do evento para evitar duplicações
      addCartClicked(event);
    });
  });

  // Função para verificar se o usuário está logado
  function isLoggedIn() {
    return userLoggedIn === true;
  }

  // Função para adicionar produto ao carrinho
  function addCartClicked(event) {
    if (!isLoggedIn()) {
      showAlert(
        "info",
        "Iniciar Sessão",
        "Por favor, inicie sessão para adicionar produtos ao carrinho."
      );
      return;
    }

    var titulo = event.currentTarget.getAttribute("data-titulo");
    var preco = event.currentTarget.getAttribute("data-preco");
    var caminho_imagem = event.currentTarget.getAttribute(
      "data-caminho-imagem"
    );

    // Agora você pode usar esses valores como desejar
    console.log(titulo, preco, caminho_imagem);

    // Chamar a função para adicionar o produto ao carrinho
    addProductToCart(titulo, preco, caminho_imagem);
  }

  // Função para adicionar produto ao carrinho
  function addProductToCart(title, price, productImg) {
    var cartItems = document.querySelector(".cart-content");
    var cartItemsTitles = cartItems.querySelectorAll(".cart-product-title");
    var isDuplicate = false;

    for (var i = 0; i < cartItemsTitles.length; i++) {
      if (
        cartItemsTitles[i] &&
        cartItemsTitles[i].innerText &&
        cartItemsTitles[i].innerText.trim() === title.trim()
      ) {
        isDuplicate = true;
        break;
      }
    }

    if (isDuplicate) {
      showAlert(
        "info",
        "Livro Já Adicionado",
        "Você já adicionou este livro ao seu carrinho."
      );
      return;
    }

    // Se o item não estiver no carrinho, adicioná-lo
    var cartShopBox = document.createElement("div");
    cartShopBox.classList.add("cart-box");

    // Criar a tag de imagem apenas se productImg estiver definido
    var imgElement = document.createElement("img");
    imgElement.classList.add("cart-img");
    if (productImg) {
      imgElement.src = productImg;
      imgElement.alt = "";
    } else {
      // Adicionar uma classe de estilo para quando a imagem não estiver presente
      imgElement.classList.add("no-img");
    }

    var cartBoxContent = `
              <div class="img-container">${imgElement.outerHTML}</div>
              <div class="detail-box">
                  <div class="cart-product-title">${title ? title : "N/A"}</div>
                  <div class="cart-price">${price ? price + "€" : "N/A"}</div>
                  <input type="number" value="1" class="cart-quantity">
              </div>
              <i class='bx bxs-trash-alt cart-remove'></i>`;

    cartShopBox.innerHTML = cartBoxContent;
    cartItems.append(cartShopBox);

    // Adicionando event listeners apenas se os elementos existirem
    var removeButton = cartShopBox.querySelector(".cart-remove");
    if (removeButton) {
      removeButton.addEventListener("click", removeCartItem);
    }

    var quantityInput = cartShopBox.querySelector(".cart-quantity");
    if (quantityInput) {
      quantityInput.addEventListener("change", quantityChanged);
    }

    updatetotal(); // Atualizar o total após adicionar um produto

    // Exibir um SweetAlert de informação ao adicionar um livro ao carrinho
    showAlert(
      "info",
      "Livro Adicionado",
      "Você adicionou um livro ao seu carrinho."
    );
  }

  // Função para remover item do carrinho
  function removeCartItem(event) {
    var buttonClicked = event.target;
    var cartBox = buttonClicked.parentElement;
    cartBox.remove();
    updatetotal();
  }

  // Função para alterar quantidade
  function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
      input.value = 1;
    }
    updatetotal();
  }

  // Função para atualizar o total
  function updatetotal() {
    var cartContent = document.querySelector(".cart-content");

    // Verificar se cartContent é nulo antes de prosseguir
    if (cartContent) {
      var cartBoxes = cartContent.querySelectorAll(".cart-box");
      var total = 0;

      for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.querySelector(".cart-price");
        var quantityElement = cartBox.querySelector(".cart-quantity");

        // Adicionando verificação para garantir que os elementos sejam encontrados
        if (priceElement && quantityElement) {
          var price = parseFloat(priceElement.innerText.replace("€", ""));
          var quantity = quantityElement.value;
          total = total + price * quantity;
        }
      }

      total = Math.round(total * 100) / 100;
      var totalPriceElement = document.querySelector(".total-price");

      // Adicionando verificação para garantir que o elemento seja encontrado
      if (totalPriceElement) {
        totalPriceElement.innerText = total + "€";
      }

      // Desativar o botão de prosseguir se o carrinho estiver vazio
      var buyButton = document.querySelector(".btn-buy");
      if (buyButton) {
        buyButton.disabled = cartBoxes.length === 0;
      }
    }
  }

  // Função para adicionar eventos de clique às imagens dos livros
  function addClickEventToBooks() {
    const bookImages = document.querySelectorAll(".product-img");
    bookImages.forEach((image) => {
      image.addEventListener("click", function () {
        const title = this.nextElementSibling.textContent;
        const description =
          this.nextElementSibling.nextElementSibling.textContent;
        const price =
          this.nextElementSibling.nextElementSibling.nextElementSibling
            .textContent;

        showAlert("info", title, `${description}\nPreço: ${price}`);
      });
    });
  }

  addClickEventToBooks();
});
