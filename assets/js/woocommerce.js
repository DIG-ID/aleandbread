document.addEventListener('click', (e) => {
  const btn = e.target.closest('.ab-qty__btn');
  if (!btn) return;

  const wrap = btn.closest('.ab-qty');
  const input = wrap.querySelector('.ab-qty__input');
  const step  = parseFloat(wrap.dataset.step || input.step || 1) || 1;
  const min   = input.min !== '' ? parseFloat(input.min) : -Infinity;
  const max   = input.max !== '' ? parseFloat(input.max) :  Infinity;
  let val     = parseFloat(input.value || 0) || 0;

  if (btn.classList.contains('ab-qty__btn--plus'))  val = Math.min(val + step, max);
  if (btn.classList.contains('ab-qty__btn--minus')) val = Math.max(val - step, min);

  input.value = (Math.round(val * 1000) / 1000); // keep decimals safe
  input.dispatchEvent(new Event('change', { bubbles: true }));
});