document.addEventListener('click', (e) => {
  const btn = e.target.closest('.ab-qty__btn');
  if (!btn) return;

  const wrap  = btn.closest('.ab-qty');
  const input = wrap && wrap.querySelector('.ab-qty__input.qty');
  if (!input) return;

  const step = parseFloat(wrap.dataset.step || input.step || 1) || 1;
  const min  = input.min !== '' ? parseFloat(input.min) : -Infinity;
  const max  = input.max !== '' ? parseFloat(input.max) :  Infinity;
  let val    = parseFloat(input.value || 0) || 0;

  if (btn.classList.contains('ab-qty__btn--plus'))  val = Math.min(val + step, max);
  if (btn.classList.contains('ab-qty__btn--minus')) val = Math.max(val - step, min);

  input.value = Math.round(val * 1000) / 1000; // keep decimals safe

  // Tell Woo that quantity changed (Woo listens to both)
  input.dispatchEvent(new Event('input',  { bubbles: true }));
  input.dispatchEvent(new Event('change', { bubbles: true }));

  // If we're on the cart page, proactively enable the Update Cart button
  const form = input.closest('.woocommerce-cart-form');
  if (form) {
    const updateBtn = form.querySelector('button[name="update_cart"]');
    if (updateBtn) {
      updateBtn.disabled = false;
      updateBtn.removeAttribute('aria-disabled');
    }
  }
});

// Also handle manual typing/spinner so the button enables immediately
document.addEventListener('input', (e) => {
  const input = e.target.closest('.ab-qty__input.qty');
  if (!input) return;
  const form = input.closest('.woocommerce-cart-form');
  if (form) {
    const updateBtn = form.querySelector('button[name="update_cart"]');
    if (updateBtn) {
      updateBtn.disabled = false;
      updateBtn.removeAttribute('aria-disabled');
    }
  }
});



