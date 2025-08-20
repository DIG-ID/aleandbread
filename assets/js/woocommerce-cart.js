document.addEventListener('click', function(e) {
  const btn = e.target.closest('.ab-qty__btn'); 
  if (!btn) return;

  const wrap = btn.closest('.ab-qty'); 
  const input = wrap.querySelector('.ab-qty__input'); 
  if (!input) return;

  const step = parseFloat(input.step) || 1;
  const min = parseFloat(input.min) || 0;
  const max = isNaN(parseFloat(input.max)) ? Infinity : parseFloat(input.max);

  let v = parseFloat(input.value) || 0;
  v += btn.textContent.trim() === '+' ? step : -step;
  v = Math.max(min, Math.min(max, v));

  input.value = v;
  input.dispatchEvent(new Event('change', { bubbles: true }));
});
