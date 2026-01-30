function filterDocs() {
  const q = (document.getElementById('q').value || '').toLowerCase().trim();
  const items = document.querySelectorAll('#lista-dokumenteve .gjerat');

  items.forEach((it) => {
    const text = it.innerText.toLowerCase();
    it.style.display = text.includes(q) ? '' : 'none';
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('q');
  if (!input) return;

  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      filterDocs();
    }
  });
});