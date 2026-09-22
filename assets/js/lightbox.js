/**
 * Lightbox viewer for Gallery and Results
 */

document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.createElement('div');
  overlay.className = 'lightbox-overlay';
  overlay.id = 'global-lightbox';
  overlay.style.display = 'none';
  overlay.innerHTML = `
    <div class="relative max-w-4xl max-h-[90vh] p-4 flex flex-col items-center">
      <button id="lightbox-close" class="absolute -top-10 right-2 text-white hover:text-red-400 text-3xl font-bold focus:outline-none" aria-label="Close Lightbox">&times;</button>
      <img id="lightbox-img" class="max-h-[78vh] max-w-full rounded-lg shadow-2xl object-contain border border-white/20 hidden">
      <div id="lightbox-caption" class="mt-3 text-white text-center font-medium max-w-xl text-sm md:text-base"></div>
    </div>
  `;
  document.body.appendChild(overlay);

  const imgEl = overlay.querySelector('#lightbox-img');
  const captionEl = overlay.querySelector('#lightbox-caption');
  const closeBtn = overlay.querySelector('#lightbox-close');

  function openLightbox(src, caption) {
    if (!src) return;
    imgEl.src = src;
    imgEl.alt = caption || 'Enlarged photo';
    imgEl.classList.remove('hidden');
    captionEl.textContent = caption || '';
    overlay.style.display = 'flex';
    requestAnimationFrame(() => {
      overlay.classList.add('active');
    });
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    overlay.classList.remove('active');
    setTimeout(() => {
      overlay.style.display = 'none';
      imgEl.removeAttribute('src');
      imgEl.removeAttribute('alt');
      imgEl.classList.add('hidden');
      captionEl.textContent = '';
      document.body.style.overflow = '';
    }, 200);
  }

  closeBtn.addEventListener('click', closeLightbox);
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeLightbox();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && overlay.classList.contains('active')) {
      closeLightbox();
    }
  });

  // Attach to clickable elements
  document.querySelectorAll('[data-lightbox]').forEach((item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      const src = item.dataset.lightbox || item.getAttribute('href') || item.querySelector('img')?.src;
      const caption = item.dataset.caption || item.querySelector('img')?.alt || '';
      if (src) openLightbox(src, caption);
    });
  });
});
