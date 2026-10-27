let cart = JSON.parse(localStorage.getItem('online_glams_cart')) || [];

function addToCart(id, name, price, img) {
    let found = cart.find(p => p.id === id);
    if (found) found.qty++;
    else cart.push({ id, name, price, img, qty: 1 });
    saveCart();
}

function saveCart() {
    localStorage.setItem('online_glams_cart', JSON.stringify(cart));
    document.getElementById('cart-count').innerText = cart.reduce((a, b) => a + b.qty, 0);
    renderCart();
}

function renderCart() {
    let container = document.getElementById('cart-items');
    let total = 0;
    container.innerHTML = '';
    cart.forEach((p, index) => {
        total += p.price * p.qty;
        container.innerHTML += `
      <div style="display:flex; gap:10px; margin:10px 0; border-bottom:1px solid #eee; padding-bottom:10px">
        <img src="${p.img}" width="50" height="50" style="object-fit:cover">
        <div style="flex:1">
          <strong>${p.name}</strong><br>${p.price}$ x ${p.qty}
        </div>
        <button onclick="removeItem(${index})" style="background:red; color:white; border:none; border-radius:50%; width:25px; height:25px; cursor:pointer">X</button>
      </div>`;
    });
    document.getElementById('cart-total').innerText = total;
}

function removeItem(i) { cart.splice(i, 1); saveCart(); }
function showCart() { document.getElementById('cart-panel').style.display = 'block'; }
function closeCart() { document.getElementById('cart-panel').style.display = 'none'; }

function commanderWhatsApp() {
    if (cart.length == 0) return alert('Panier vide');
    let msg = "Bonjour On Line Glams! Je veux commander:\n\n";
    let total = 0;
    cart.forEach(p => {
        msg += '- ${p.name} x${p.qty} = ${p.price * p.qty}$\n';
        total += p.price * p.qty;
    });
    msg += '\nTotal: ${total}$\nLivraison à Goma';
    window.open('https://wa.me/243993363829?text=${encodeURIComponent(msg)}', '_blank');
}

saveCart();